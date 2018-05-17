<?php

namespace App\Modules\SuperUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSuperUserRequest extends FormRequest
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
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'role_id' => 'required'
        ];
    }
}
