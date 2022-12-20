<?php

namespace Modules\Need\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NeedDto extends JsonResource
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
        $obj['date'] = Carbon::parse($this['created_at'])->format('d/m/Y');
        $obj['time'] = Carbon::parse($this['created_at'])->format('h:i a');
        return $obj;
    }
}
