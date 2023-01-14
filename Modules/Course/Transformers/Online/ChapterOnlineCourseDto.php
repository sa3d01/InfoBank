<?php

namespace Modules\Course\Transformers\Online;

use Illuminate\Http\Resources\Json\JsonResource;

class ChapterOnlineCourseDto extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (int)$this['id'],
            'title' => $this->title ?? "",
            'sessions' => SessionOnlineCourseDto::collection($this->sessions),
        ];
    }
}
