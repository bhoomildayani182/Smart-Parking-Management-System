<?php

namespace App\Http\Requests;

use App\Constants\IBDConstants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class userRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'mobile_number' => ['required', 'digits:10'],
            'email' => ['required', 'email'],
            'address' => ['required', 'string'],
            'city_id' => ['required', Rule::exists('city', 'id')],
            'state_id' => ['required', Rule::exists('states', 'id')],
            'pincode' => ['required', 'digits:6'],
            'role_id' => ['required'],
            'default_parking_id' => ['required', Rule::exists('parking', 'id')],
            'is_active' => ['required', Rule::in(array_keys(IBDConstants::Status))]
        ];
    }
}
