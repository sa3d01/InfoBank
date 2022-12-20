<?php

namespace Modules\Enrichment\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class FaqDto extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (int)$this['id'],
            'question' => $this->question ?? "",
            'answer' => $this->answer ?? "",
        ];
    }
}
