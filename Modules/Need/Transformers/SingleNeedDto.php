<?php

namespace Modules\Need\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleNeedDto extends JsonResource
{
    public function toArray($request)
    {
        $obj['id'] = (int)$this['id'];
        $obj['client_name'] = $this['client_name'];
        $obj['client_phone'] = $this['client_phone'];
        $obj['place'] = new PlaceDto($this->place);
        $obj['training'] = new TrainingDto($this->training);
        $obj['title_training'] = new TrainingDto($this->title_training);
        $obj['status'] = $this['status'];
        $news = [];
        if ($this['status'] == 'rejected') {
            $rejection_timestamp = strtotime($this['news']['created_at']);
            $obj['rejection_reason'] = $this['news']['reason'];
            $obj['rejection_date'] = Carbon::parse($rejection_timestamp)->format('d/m/Y');
            $obj['rejection_time'] = Carbon::parse($rejection_timestamp)->format('h:i a');
        } elseif ($this['status'] != 'binding' && $this['news'] != null) {
            try {
                foreach ($this['news'] as $new) {
                    $new_timestamp = strtotime($new['created_at']);
                    $new_arr['title'] = $new['title'];
                    $new_arr['content'] = $new['content'];
                    $new_arr['date'] = Carbon::parse($new_timestamp)->format('d/m/Y');
                    $new_arr['time'] = Carbon::parse($new_timestamp)->format('h:i a');
                    $news[] = $new_arr;
                }
                $obj['news'] = $news;
            } catch (\Exception) {
                $obj['news'] = $news;
            }
        }else{
            $obj['news'] = $news;
        }
        $obj['date'] = Carbon::parse($this['created_at'])->format('d/m/Y');
        $obj['time'] = Carbon::parse($this['created_at'])->format('h:i a');

        return $obj;
    }
}
