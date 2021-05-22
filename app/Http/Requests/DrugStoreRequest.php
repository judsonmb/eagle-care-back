<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DrugStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
            'dosage' => 'required|integer|digits_between:1,3',
            'price' => 'sometimes',
            'schedule_id' => 'required|exists:App\Models\Schedule,id',
            'person_id' => 'required|exists:App\Models\Person,id',
            'period' => 'required|integer|digits_between:1,3'
        ];
    }
}
