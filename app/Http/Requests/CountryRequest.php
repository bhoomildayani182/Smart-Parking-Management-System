<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryRequest extends FormRequest
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
                'name' => ['required', 'string', Rule::unique('countries')->where(function ($query) {
                    $query->whereNull('deleted_at');
                })],
                'status' => ['required']
            ];
        }
        $id = $this->route('country')->id;
        if($this->isMethod('PUT')){
            return [
                'name' => ['required', 'string', Rule::unique('countries')->where(function ($query) {
                    $query->whereNull('deleted_at');
                })->ignore($id, 'id')],
                'status' => ['required']
            ];
        }
    }
}
