<?php

namespace Modules\Course\Transformers;

use App\Traits\ClientRequestTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Course\Entities\Subscribe;

class OfflineCourseShowDto extends JsonResource
{
    use ClientRequestTrait;

    public function toArray($request)
    {
        $dt = Carbon::parse($this->created_at);
        $subscribed=false;
        $subscribed_status="not_subscribed";
        try{
            $client=$this->getUserIdByToken(request()->header("Authorization"));
            $subscribe=Subscribe::where(['client_id'=>$client['profile_client']['id'],'course_id'=>$this->id])->first();
            if($subscribe){
                $subscribed=true;
                $subscribed_status=$subscribe->status;
            }
        }catch(Exception $e){
        }
        return [
            'id' => (int)$this['id'],
            'title' => $this->title ?? "",
            'rate'=>$this->rate(),
            'created_at' => $dt?$dt->format('d/m/Y h:i a'):"",
            'description' => $this->description ?? "",

            'for' => $this->for,
            'cover' => $this->cover,

            'sessions_count'=>$this->sessions->count(),
            'duration'=>$this->sessions->sum('duration')/60,
            'subscribes_count'=>$this->subscribes->count(),

            'features' => $this->features ?? "",
            'location'=>[
                'location_title'=>$this->location_title,
                'location_type'=>$this->location_type,
                'location'=>$this->location,
            ],

            'company_name' => $this->company_name ?? "",
            'company_description' => $this->company_description ?? "",
            'company_logo' => $this->company_logo,
            'chapters'=>ChapterOfflineCourseDto::collection($this->chapters),
            'subscribed'=>$subscribed,
            'subscribed_status'=>$subscribed_status
        ];
    }
}
