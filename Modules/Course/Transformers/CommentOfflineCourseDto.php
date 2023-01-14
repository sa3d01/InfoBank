<?php

namespace Modules\Course\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentOfflineCourseDto extends JsonResource
{
    public function toArray($request)
    {
        $dt = Carbon::parse($this->created_at);
        return [
            'id' => (int)$this['id'],
            'rate' => (int)$this->rate,
            'comment' => $this->comment ?? "",
            'created_at' => $dt?$dt->format('d/m/Y h:i a'):"",
        ];
    }
}
