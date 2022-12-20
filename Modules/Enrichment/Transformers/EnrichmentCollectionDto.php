<?php

namespace Modules\Enrichment\Transformers;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EnrichmentCollectionDto extends ResourceCollection
{
    use ApiResponseTrait;

    public function toArray($request)
    {
        return [
            'status' => 1,
            'data' => IndexEnrichmentDto::collection($this->collection),
        ];
    }
}
