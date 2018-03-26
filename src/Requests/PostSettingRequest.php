<?php

namespace Dosarkz\LaravelAdmin\Requests;


use Illuminate\Foundation\Http\FormRequest;

class PostSettingRequest extends FormRequest
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
        $rules = [];

        if(isset($this->old_password) or isset($this->password))
        {
            $rules = [ 'old_password' => 'required',
                'password' => 'required|confirmed'
            ];
        }

        return $rules;
    }
}
