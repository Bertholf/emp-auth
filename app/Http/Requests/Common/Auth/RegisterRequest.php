<?php

namespace App\Http\Requests\Common\User;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class RegisterRequest extends Request
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
            'name_first' => 'required',
            'name_last' => 'required',
            'name_slug' => 'required|min:3|max:20|unique:users',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')],
            'password' => 'required|min:6|confirmed',
            'agreement' => 'required',
            'g-recaptcha-response' => 'required_if:captcha_status,true|captcha',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'g-recaptcha-response.required_if' => trans('common.validation.required', ['attribute' => 'captcha']),
        ];
    }
}
