<?php

namespace Modules\Course\Transformers;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentOfflineCourseCollectionDto extends ResourceCollection
{
    use ApiResponseTrait;

    public function toArray($request)
    {
        return [
            'status' => 1,
            'data' => CommentOfflineCourseDto::collection($this->collection),
        ];
    }
}
