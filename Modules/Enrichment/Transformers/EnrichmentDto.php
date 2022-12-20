<?php

namespace Modules\Enrichment\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrichmentDto extends JsonResource
{
    public function toArray($request)
    {
        $dt = Carbon::parse($this->created_at);
        return [
            'id' => (int)$this['id'],
            'title' => $this->title ?? "",
            'description' => $this->description ?? "",
            'media_link' => $this->media_link ?? "",
            'image' => $this->image??"",
            'pdf' => $this->pdf??"",
            'created_at' => $dt?$dt->format('d/m/Y h:i a'):"",
        ];
    }
}
