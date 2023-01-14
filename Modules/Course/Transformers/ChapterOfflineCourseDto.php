<?php

namespace Modules\Course\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ChapterOfflineCourseDto extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (int)$this['id'],
            'title' => $this->title ?? "",
            'sessions' => SessionOfflineCourseDto::collection($this->sessions),
        ];
    }
}
