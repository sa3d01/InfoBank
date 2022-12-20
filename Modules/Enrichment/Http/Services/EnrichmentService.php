<?php

namespace Modules\Enrichment\Http\Services;

use App\Traits\ApiResponseTrait;
use Modules\Enrichment\Entities\Enrichment;
use Modules\Enrichment\Entities\Faq;
use Modules\Enrichment\Transformers\EnrichmentCollectionDto;
use Modules\Enrichment\Transformers\EnrichmentDto;
use Modules\Enrichment\Transformers\FaqDto;

class EnrichmentService
{
    use ApiResponseTrait;

    public function getSomeEnrichments(): EnrichmentCollectionDto
    {
        return new EnrichmentCollectionDto(Enrichment::whereBanned(false)->latest()->take(5)->get());
    }

    public function getAllEnrichments(): EnrichmentCollectionDto
    {
        return new EnrichmentCollectionDto(Enrichment::whereBanned(false)->latest()->paginate());
    }

    public function getAllFaqs($request)
    {
        $faqs = Faq::whereBanned(false);
        if ($request->has('sub')) {
            $faqs = $faqs->where('question', 'like', '%' . $request['sub'] . '%')
                ->orWhere('answer', 'like', '%' . $request['sub'] . '%');
        }
        return FaqDto::collection($faqs->latest()->get());
    }

    public function showEnrichment($id): EnrichmentDto
    {
        return new EnrichmentDto(Enrichment::find($id));
    }

}
