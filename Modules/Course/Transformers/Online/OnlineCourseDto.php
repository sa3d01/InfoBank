<?php

namespace Modules\Course\Transformers\Online;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Course\Entities\Subscribe;

class OnlineCourseDto extends JsonResource
{
    public function toArray($request)
    {
        $subscribed=false;
        $subscribed_status="not_subscribed";
        $watching_progress=0;
        try{
            $subscribe=Subscribe::where(['client_id'=>$this->client_id,'course_id'=>$this->id])->first();
            if($subscribe){
                $subscribed=true;
                $watching_progress=$this->getSubscribedClientProgress($this->client_id);
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
            'cover' => $this->cover,
            'company_name' => $this->company_name ?? "",
            'company_logo' => $this->company_logo,
            'rate'=>$this->rate(),
            'watching_progress'=>$watching_progress,
            'subscribed'=>$subscribed,
            'subscribed_status'=>$subscribed_status
        ];
    }
}
