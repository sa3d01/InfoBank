<?php

namespace Modules\Course\Transformers\Online;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentOnlineCourseCollectionDto extends ResourceCollection
{
    use ApiResponseTrait;

    public function toArray($request)
    {
        return [
            'status' => 1,
            'data' => CommentOnlineCourseDto::collection($this->collection),
        ];
    }
}
