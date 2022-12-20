<?php

namespace Modules\Enrichment\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexEnrichmentDto extends JsonResource
{
    public function toArray($request)
    {
        $dt = Carbon::parse($this->created_at);
        return [
            'id' => (int)$this['id'],
            'title' => $this->title ?? "",
            'description' => substr($this->description, 0, 70),
            'media_link' => $this->media_link ?? "",
            'created_at' => $dt?$dt->format('d/m/Y h:i a'):"",
        ];
    }
}
