<?php

namespace Modules\Admin\Http\Requests;

use App\Utils\PreparePhone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateBrandRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'commercial_name' => 'nullable|max:255',
            'commercial_num' => 'nullable|max:255',
            'start_contract' => 'nullable|date',
            'end_contract' => 'nullable|date|after:start_contract',
            'website' => 'nullable|max:255',
            'insta' => 'nullable|max:255',
            'snap' => 'nullable|max:255',
            'twitter' => 'nullable|max:255',
            'brand_owner_id' => 'required|numeric|exists:brand_owners,id',
            'location_id' => 'required|numeric|exists:locations,id',
            'mobile' => 'nullable|max:255',
            'phone' => 'nullable|max:255',
            'image' => 'nullable|image',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
