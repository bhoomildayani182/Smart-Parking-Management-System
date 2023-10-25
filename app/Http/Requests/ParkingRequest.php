<?php

namespace App\Http\Requests;

use App\Constants\IBDConstants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParkingRequest extends FormRequest
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
        if($this->isMethod('POST')){
            return[
                'parking_name' => ['required', 'string'],
                'address' => ['required', 'string'],
                // 'country_id' => ['required', Rule::exists('countries', 'id')],
                'state_id' => ['required', Rule::exists('states', 'id')],
                'city_id' => ['required', Rule::exists('city', 'id')],
                'pincode' => ['required','digits:6'],
                'manager_name' => ['required', 'string'],
                'manager_mobile_number' => ['required', 'digits:10'],
                'manager_email' => ['required', 'string'],
                'document' => 'required|mimes:jpeg,png,pdf|max:2048',
                'status' => ['required', Rule::in(array_keys(IBDConstants::Status))]
            ];
        }

        if($this->isMethod('PUT')){
            return[
                'parking_name' => ['required', 'string'],
                'address' => ['required', 'string'],
                // 'country_id' => ['required', Rule::exists('countries', 'id')],
                'state_id' => ['required', Rule::exists('states', 'id')],
                'city_id' => ['required', Rule::exists('city', 'id')],
                'pincode' => ['required','digits:6'],
                'manager_name' => ['required', 'string'],
                'manager_mobile_number' => ['required', 'digits:10'],
                'manager_email' => ['required', 'string'],
                'document' => 'sometimes|mimes:jpeg,png,pdf|max:2048',
                'status' => ['required', Rule::in(array_keys(IBDConstants::Status))]
            ];
        }
    }
}
