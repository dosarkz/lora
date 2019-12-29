<?php

namespace Dosarkz\Lora\Modules\SuperUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSuperUserRequest extends FormRequest
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
            'name' => 'required',
            'username' => 'required|unique:super_users',
            'email' => 'required',
            'password' => 'required|confirmed',
            'role_id' => 'required'
        ];
    }
}
