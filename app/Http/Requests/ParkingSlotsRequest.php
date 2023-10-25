<?php

namespace App\Http\Requests;

use App\Constants\IBDConstants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParkingSlotsRequest extends FormRequest
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
                'zone' => ['required', 'string'],
                'section' => ['required', 'string'],
                'parking_slot' => ['required', 'numeric'],
                'name' => ['required', 'string'],
                'parking_id' => ['required', 'numeric', Rule::exists('parking', 'id')]
            ];
        }
        if($this->isMethod('PUT')){
            return [
                'zone' => ['required', 'string'],
                'section' => ['required', 'string'],
                'parking_slot' => ['required', 'numeric'],
                'name' => ['required', 'string'],
                'parking_id' => ['required', 'numeric']
            ];
        }
    }
}
