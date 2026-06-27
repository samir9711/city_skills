<?php

namespace App\Http\Requests\Model;

use App\Http\Requests\Basic\BasicRequest;use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends BasicRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female',
            'birth_date' => 'nullable|date',
            'residence' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'email_verified_at' => 'nullable|date_format:Y-m-d H:i:s',
            'email_status' => 'nullable|boolean',
            'activated_at' => 'nullable|date_format:Y-m-d H:i:s',
            'password' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
            'otp_delivery_method' => 'nullable|in:sms,whatsapp,email',
            'remember_token' => 'nullable|string|max:100',
        ];
    }


}
