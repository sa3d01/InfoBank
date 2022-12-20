<?php

namespace Modules\Need\Http\Requests;


class StoreNeedRequestApi extends BaseRequestApi
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_name'          => 'required|min:3|string|max:255',
            'client_phone'          => 'required|min:8|max:255',
            'place_id'         => 'required',
            'training_id'         => 'required|exists:trainings,id',
            'title_training_id'         => 'required|exists:trainings,id',
        ];
    }
}
