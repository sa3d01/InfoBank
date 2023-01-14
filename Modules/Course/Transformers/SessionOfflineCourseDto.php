<?php

namespace Modules\Course\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SessionOfflineCourseDto extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (int)$this['id'],
            'title' => $this->title ?? "",
            'description' => $this->description ?? "",
            'duration' => (int)$this->duration,
        ];
    }
}
