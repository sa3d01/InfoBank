<?php

namespace Modules\Course\Transformers\Online;

use Illuminate\Http\Resources\Json\JsonResource;

class SessionOnlineCourseDto extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (int)$this['id'],
            'title' => $this->title ?? "",
            'description' => $this->description ?? "",
            'duration' => (int)$this->duration,
            'media_link' => $this->media_link??"",
        ];
    }
}
