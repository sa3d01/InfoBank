<?php

namespace Modules\Course\Transformers\Online;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OnlineCourseCollectionDto extends ResourceCollection
{
    use ApiResponseTrait;

    public function toArray($request)
    {
        $collection=$this->collection;
        foreach ($collection as $ob){
            $ob->client_id=$this->client_id;
        }
        return [
            'status' => 1,
            'data' => OnlineCourseDto::collection($collection),
        ];
    }
}
