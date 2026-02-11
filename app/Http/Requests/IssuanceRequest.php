<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IssuanceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'responsibility_center_code' => 'nullable',
            'date_released' => 'nullable',
            'remarks' => 'nullable',
            'item_id' => 'nullable',
            'sku' => 'nullable',
            'quantity' => 'nullable',
            'cost' => 'nullable',
            'requested_quantity' => 'nullable',
            'individual_receiver' => 'nullable'
        ];
    }
}
