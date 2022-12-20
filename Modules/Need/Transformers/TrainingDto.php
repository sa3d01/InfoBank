<?php

namespace Modules\Need\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TrainingDto extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (int)$this['id'],
            'name' => $this->name ?? "",
        ];
    }
}
