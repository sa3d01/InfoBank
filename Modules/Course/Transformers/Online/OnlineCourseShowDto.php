<?php

namespace Modules\Course\Transformers\Online;

use App\Traits\ClientRequestTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Course\Entities\Subscribe;

class OnlineCourseShowDto extends JsonResource
{
    use ClientRequestTrait;

    public function toArray($request)
    {
        $dt = Carbon::parse($this->created_at);
        $subscribed=false;
        $subscribed_status="not_subscribed";
        $watching_progress=0;
        try{
            $client=$this->getUserIdByToken(request()->header("Authorization"));
            $subscribe=Subscribe::where(['client_id'=>$client['profile_client']['id'],'course_id'=>$this->id])->first();
            if($subscribe){
                $subscribed=true;
                $watching_progress=$this->getSubscribedClientProgress($client['profile_client']['id']);
                if($watching_progress!=100 && $subscribe->status=='completed'){
                    $subscribe->update(['status'=>'in_progress']);
                }elseif($watching_progress==100 && $subscribe->status!='completed'){
                    $subscribe->update(['status'=>'completed']);
                }
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
            'duration'=>round($this->sessions->sum('duration')/60,1),
            'subscribes_count'=>$this->subscribes->count(),

            'features' => $this->features ?? "",


            'company_name' => $this->company_name ?? "",
            'company_description' => $this->company_description ?? "",
            'company_logo' => $this->company_logo,

            'chapters'=>ChapterOnlineCourseDto::collection($this->chapters),

            'subscribed'=>$subscribed,
            'subscribed_status'=>$subscribed_status,
            'watching_progress'=>$watching_progress,
        ];
    }
}
