<?php

namespace App\Http\Requests;

use App\Constants\IBDConstants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StateRequest extends FormRequest
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
        $country = $this->country_id;
        if($this->isMethod('POST')){
            return[
                'name' => ['required', 'string', 
                    Rule::unique('states')->where(function ($query) use ($country) {
                        return $query->where('country_id', $country)->whereNull('deleted_at');
                    })
                ],
                'country_id' => ['required', Rule::exists('countries', 'id')],
                'status' => Rule::in(array_keys(IBDConstants::Status))
            ];
        }
        if($this->isMethod('PUT')){
            $id = $this->route('state')->id;
            return [
                'name' => ['required', 'string', 
                    Rule::unique('states')->where(function ($query) use ($country, $id) {
                        return $query->where('country_id', $country)->whereNull('deleted_at')->where('id', '!=' ,$id);
                    })
                ],
                'country_id' => ['required', Rule::exists('countries', 'id')],
                'status' => Rule::in(array_keys(IBDConstants::Status))
            ];
        }
    }
}
