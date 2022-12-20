<?php

namespace Modules\Need\Http\Controllers;

use App\Http\Controllers\BaseApiController;
use Exception;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;
use Modules\Need\Http\Requests\StoreNeedRequestApi;
use Modules\Need\Http\Services\NeedService;
use Softonic\GraphQL\ClientBuilder;

class NeedController extends BaseApiController
{
    protected NeedService $needService;

    #[Pure] public function __construct()
    {
        $this->needService = new NeedService();
    }
    public function sliders(){
        return $this->successResponse($this->needService->getSliders());
    }
    public function contents(){
        return $this->successResponse($this->needService->getContents());
    }
    public function trainingCategories(){
        return $this->successResponse($this->needService->getTrainingCategories());
    }
    public function trainingsTitles(){
        return $this->successResponse($this->needService->getTrainingTitles());
    }
    public function needs(Request $request){
        return $this->successResponse($this->needService->getNeeds($request));
    }
    public function show($id){
        return $this->successResponse($this->needService->show($id));
    }
    public function store(StoreNeedRequestApi $request){
        return $this->successResponse($this->needService->store($request));
    }
    public function cancel($id){
        return $this->successResponse($this->needService->cancel($id));
    }

}
