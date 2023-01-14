<?php

namespace Modules\Course\Transformers;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OfflineCourseCollectionDto extends ResourceCollection
{
    use ApiResponseTrait;

    public function toArray($request)
    {
        return [
            'status' => 1,
            'data' => OfflineCourseDto::collection($this->collection),
        ];
    }
}
