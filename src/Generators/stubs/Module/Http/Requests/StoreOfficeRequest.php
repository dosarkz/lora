<?php

namespace App\Modules\Office\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfficeRequest extends FormRequest
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
        $rules  = [
            'title' => 'required|string|max:10',
             'floor' => 'required',
            'area' => 'required',
             'auxiliary_area' => 'required|numeric',
            'coefficient_auxiliary_area' => 'required|numeric',
            'status_id' => 'required'
        ];

        return $rules;
    }
}
