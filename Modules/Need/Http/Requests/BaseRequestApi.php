<?php

namespace Modules\Need\Http\Requests;

use App\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequestApi extends FormRequest
{
    use ApiResponseTrait;

    public function authorize(): bool
    {
        return true;
    }


    protected function failedValidation(Validator $validator)
    {
        $this->validationResponse($validator);
    }
}
