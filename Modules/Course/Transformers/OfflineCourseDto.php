<?php

namespace Modules\Course\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OfflineCourseDto extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (int)$this['id'],
            'title' => $this->title ?? "",
            'cover' => $this->cover,
            'company_name' => $this->company_name ?? "",
            'company_logo' => $this->company_logo,
            'rate'=>$this->rate(),
        ];
    }
}
