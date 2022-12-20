<?php

namespace Modules\Enrichment\Http\Controllers;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;
use Modules\Enrichment\Http\Services\EnrichmentService;
use Modules\Enrichment\Transformers\EnrichmentCollectionDto;

class EnrichmentController extends BaseApiController
{
    protected EnrichmentService $enrichmentService;

    #[Pure] public function __construct()
    {
        $this->enrichmentService = new EnrichmentService();
    }

    function index(): EnrichmentCollectionDto
    {
        return $this->enrichmentService->getAllEnrichments();
    }

    function slider(): EnrichmentCollectionDto
    {
        return $this->enrichmentService->getSomeEnrichments();
    }

    function faqs(Request $request)
    {
        return $this->successResponse($this->enrichmentService->getAllFaqs($request));
    }

    function show($id)
    {
        return $this->successResponse($this->enrichmentService->showEnrichment($id));
    }
}
