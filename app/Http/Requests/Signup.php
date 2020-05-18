<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Signup extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'email' => 'required | email | unique:users',
            'password' => 'required | min:6'
        ];
    }

    public function messages()
    {
        return [
          'name.required' => 'وارد کردن فیلد نام اجباری است.',
          'email.email' => 'ایمیل وارد شده معتبر نمیباشد.',
          'email.unique' => 'ایمیل وارد شده تکراری است.',
          'email.required' => 'لطفا ایمیل خود را وارد کنید.',
          'password.required' => 'لطفا رمز عبور خود را وارد کنید.',
          'password.min' => 'رمز عبور حداقل باید 6 کاراکتر باشد.',
        ];
    }
}
