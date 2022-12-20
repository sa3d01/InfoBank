<?php

namespace Modules\Need\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentDto extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name ?? "",
            'description' => $this->description ?? "",
            'image' => $this->image,
        ];
    }
}
