<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCourseRequest extends FormRequest
{
    public function rules()
    {
        return [
            'type' => 'required|in:online,offline',
            'for' => 'required|in:managers,employees',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cover' => 'nullable',

            'features' => 'required|string',

            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'location_title' => 'nullable',
            'location_type' => 'nullable',
            'location' => 'nullable',

            'company_name' => 'nullable|string',
            'company_desc' => 'nullable|string',
            'company_logo' => 'nullable',

            'image' => 'nullable',
            'pdf' => 'nullable',
            'excel' => 'nullable',
            'word' => 'nullable',
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
