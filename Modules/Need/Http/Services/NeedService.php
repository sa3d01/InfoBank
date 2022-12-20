<?php

namespace Modules\Need\Http\Services;

use App\Traits\ApiResponseTrait;
use App\Traits\ClientRequestTrait;
use Exception;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Modules\Need\Entities\Content;
use Modules\Need\Entities\Need;
use Modules\Need\Entities\Place;
use Modules\Need\Entities\Slider;
use Modules\Need\Entities\Training;
use Modules\Need\Transformers\ContentDto;
use Modules\Need\Transformers\NeedDto;
use Modules\Need\Transformers\SingleNeedDto;
use Modules\Need\Transformers\SliderDto;
use Modules\Need\Transformers\TrainingDto;
use Softonic\GraphQL\ClientBuilder;

class NeedService
{
    use ApiResponseTrait,ClientRequestTrait;

    public function getSliders()
    {
        return SliderDto::collection(Slider::whereBanned(false)->latest()->get());
    }

    public function getContents()
    {
        return ContentDto::collection(Content::latest()->get());
    }

     public function getTrainingCategories(){
        return TrainingDto::collection(Training::where(['type'=>'category','banned'=>false])->latest()->get());
     }

     public function getTrainingTitles(){
        return TrainingDto::collection(Training::where(['type'=>'title','banned'=>false])->latest()->get());
     }

     public function getNeeds($request){
         $client=$this->getUserIdByToken(request()->header("Authorization"));
         $needs=Need::where('client_id',$client['profile_client']['id']);
         if ($request->has('status') && $request['status'] != null) {
             $needs = $needs->where('status', $request['status']);
         }
         if ($request->has('sub')) {
             $training_ids=Training::where('name', 'like', '%' . $request['sub'] . '%')->pluck('id')->toArray();
             $place_ids=Place::where('name', 'like', '%' . $request['sub'] . '%')->pluck('id')->toArray();
             $needs = $needs->whereIn('training_id',$training_ids)
                 ->orWhereIn('title_training_id', $training_ids)
                 ->orWhereIn('place_id', $place_ids);
         }
        return NeedDto::collection($needs->latest()->get());
     }
     public function show($id){
         $need=Need::findOrFail($id);
         return new SingleNeedDto($need);
     }

     public function cancel($id){
        $need=Need::findOrFail($id);
        $client=$this->getUserIdByToken(request()->header("Authorization"));
        $client_id=$client['profile_client']['id'];
        if ($client_id!=$need->client_id || $need->status!="binding"){
             $this->errorResponse("لا يمكنك الغاء هذا الطلب");
        }
        $need->update([
            'status'=>'cancelled'
        ]);
        $need->fresh();
        return new NeedDto($need);
     }

     public function store($request){
        $client=$this->getUserIdByToken(request()->header("Authorization"));
        $this->updatePlaces();
        $need=$request->all();
        $need['client_id']=$client['profile_client']['id'];
        $need=Need::create($need);
        $need->fresh();
        return new NeedDto($need);
     }

    public function places(){
        $client = ClientBuilder::build(
            'https://api.info-bank.co/graphql',
        );
        $query = <<<'QUERY'
                    query places {
                        places {
                          nodes {
                            id
                            name{
                              value
                            }
                          }
                        }
                      }
                    QUERY;

        $variables = [
            ""=>""
        ];
        try {
            $response = $client->query($query, $variables);
            if ($response->hasErrors()) {
                $response = $response->getErrors();
            } else {
                $response = $response->getData();
            }
        } catch (ConnectException | Exception | RequestException $e) {
            $response = $e;
        }
        return $response;
    }

    private function updatePlaces(){
        try {
            $places=$this->places();
            foreach ($places['places']['nodes'] as $place){
                $data['id']=$place['id'];
                $data['name']=$place['name'][0]['value'];
                Place::firstOrCreate($data);
            }
        }catch (Exception ){

        }
     }


}
