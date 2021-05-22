<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DrugUpdateRequest extends FormRequest
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
            'id' => 'exists:App\Models\Drug,id',
            'name' => 'required',
            'dosage' => 'required|integer|max:3',
            'price' => 'sometimes',
            'schedule_id' => 'required|exists:App\Models\Schedule,id',
            'person_id' => 'required|exists:App\Models\Person,id',
            'period' => 'required|integer|max:3'
        ];
    }
}
