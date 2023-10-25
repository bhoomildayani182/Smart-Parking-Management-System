<?php

namespace App\Http\Requests;

use App\Constants\IBDConstants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EntryBookingRequest extends FormRequest
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
            return [
                'slot_id' => 'required|exists:slot,id',
                'vehicle_model_id' => 'required|exists:vehicle_model,id',
                'vehicle_number' => 'required|string',
                'parking_space_id' => ['required', 'integer', Rule::exists('parking_slot_details', 'id')->where(function ($query) {
                                            $query->where('is_booked', 0);
                                        })],
                'payment_mode' => 'required|string',
                'name' => 'array',
                'mobile' => 'array',
                'address' => 'array',
                'state_id' => 'array',
                'city_id' => 'array',
                'document_type' => 'array',
                'document_number' => 'array',
                'document' => 'array',
                'name.*' => 'required|string',
                'mobile.*' => 'required|string',
                'address.*' => 'required|string',
                'state_id.*' => ['required', Rule::exists('states', 'id')],
                'city_id.*' => ['required', Rule::exists('city', 'id')],
                'document_type.*' => 'required|string',
                'document_number.*' => 'required|string',
                'document.*' => 'required|mimes:jpeg,png,pdf|max:2048',
            ];
        }

        if($this->isMethod('PUT')){
            return [
                'slot_id' => 'required|exists:slot,id',
                'vehicle_model_id' => 'required|exists:vehicle_model,id',
                'vehicle_number' => 'required|string',
                'parking_space_id' => ['required', 'integer', Rule::exists('parking_slot_details', 'id')],
                'payment_mode' => 'required|string',
                'driver_name' => 'required|string',
                'driver_mobile' => 'required|string',
                'driver_address' => 'required|string',
                'driver_state_id' => ['required', Rule::exists('states', 'id')],
                'driver_city_id' => ['required', Rule::exists('city', 'id')],
                'driver_document_type' => 'required|string',
                'driver_document_number' => 'required|string',
                'driver_document' => 'mimes:jpeg,png,pdf|max:2048',
                'name' => 'required|array',
                'mobile' => 'required|array',
                'address' => 'required|array',
                'state_id' => 'required|array',
                'city_id' => 'required|array',
                'document_type' => 'required|array',
                'document_number' => 'required|array',
                'new_document' => 'sometimes|array',
                'document' => 'sometimes|array',
                'name.*' => 'required|string',
                'mobile.*' => 'required|string',
                'address.*' => 'required|string',
                'state_id.*' => ['required', Rule::exists('states', 'id')],
                'city_id.*' => ['required', Rule::exists('city', 'id')],
                'document_type.*' => 'required|string',
                'document_number.*' => 'required|string',
                'document.*' => 'sometimes|mimes:jpeg,png,pdf|max:2048',
                'new_document.*' => 'sometimes|mimes:jpeg,png,pdf|max:2048',
            ];
        }


    }
}
