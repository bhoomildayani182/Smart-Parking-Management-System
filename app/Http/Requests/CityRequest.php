<?php

namespace App\Http\Requests;

use App\Constants\IBDConstants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CityRequest extends FormRequest
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
        $state = $this->state_id;
        if($this->isMethod('POST')){
            return[
                'name' => ['required', 'string', 'unique:city,name'],
                'name' => ['required', 'string', 
                    Rule::unique('city')->where(function ($query) use ($state) {
                        return $query->where('state_id', $state)->whereNull('deleted_at');
                    })
                ],
                'state_id' => ['required', Rule::exists('states', 'id')],
                'status' => Rule::in(array_keys(IBDConstants::Status))
            ];
        }
        $id = $this->route('city')->id;
        if($this->isMethod('PUT')){
            return [
                'name' => ['required', 'string', 
                    Rule::unique('city')->where(function ($query) use ($state, $id) {
                        return $query->where('state_id', $state)->whereNull('deleted_at')->where('id', '!=' ,$id);
                    })
                ],
                'state_id' => ['required', Rule::exists('states', 'id')],
                'status' => Rule::in(array_keys(IBDConstants::Status))
            ];
        }
    }
}
