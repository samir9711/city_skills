<?php

namespace App\Http\Requests\Model\Auth;

use App\Http\Requests\Basic\BasicRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends BasicRequest
{
    public function rules(): array
    {
        return [
            'name'          => ['required','string'],

            'phone'         => ['required','string','max:30'],
            'email'         => ['nullable','email','max:255'],
            'password'      => ['nullable','string','min:6','max:100'],
            'gender'        => ['nullable',Rule::in(['male','female'])],
            //'country'       => ['required','string'],
            'city'          => ['nullable','string'],
            'birth_date'    => ['nullable','date_format:Y-m-d'],

            // قناة إرسال OTP
            'otp_delivery_method'      => ['nullable', Rule::in(['sms','whatsapp','email'])],


            'token_device' => ['nullable','string'],
        ];
    }

    public function messages(): array
    {
        return [

            'name.required' => __('validation.custom.first_name.required'),


            'phone.required'      => __('validation.custom.phone.required'),
            'phone.max'           => __('validation.custom.phone.max'),


        ];
    }


    protected function prepareForValidation(): void
    {
        if ($this->has('phone')) {
            $this->merge([
                'phone' => preg_replace('/[\s-]+/', '', (string) $this->input('phone')),
            ]);
        }
    }
}
