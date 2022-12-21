<?php

namespace Modules\Admin\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:110',
            'email' => 'email|max:90|unique:admins,email,' . $this->id,
            'password' => 'required|string|min:6|max:15',
            'password_confirm' => 'required|same:password',
            'avatar' => 'nullable|image',
        ];
    }


}
