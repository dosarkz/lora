<?php

namespace App\Modules\Office\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationOfficeRequest extends FormRequest
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
            'office_id' => 'required',
             'name' => 'required',
            'company' => 'required',
            'message'   =>  'required'
        ];

        return $rules;
    }
}
