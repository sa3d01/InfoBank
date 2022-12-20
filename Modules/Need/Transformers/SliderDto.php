<?php

namespace Modules\Need\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderDto extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (int)$this['id'],
            'topic' => $this->topic ?? "",
            'title' => $this->title ?? "",
            'description' => $this->description ?? "",
            'image' => $this->image,
        ];
    }
}
