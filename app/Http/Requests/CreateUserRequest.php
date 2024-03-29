<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name'          => 'required|string',
            'surname'       => 'required|string',
            'lastname'      => 'nullable|string',
            'birthday'      => 'nullable|date_format:d/m/Y',
            'parent_name'   => 'filled|string',
            'gender'        => 'required|boolean',
            'phone_number'  => 'filled|string|size:17',
            'address'       => 'filled|string',
            'email'         => 'required|string|email|unique:users',
            'password'      => 'required|string|min:6|confirmed',
            'image'         => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
