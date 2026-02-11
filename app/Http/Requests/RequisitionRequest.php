<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequisitionRequest extends FormRequest
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
            'ref_no' => 'nullable',
            'entity_name' => 'nullable',
            'fund_cluster' => 'nullable',
            'responsibility_center_code' => 'nullable',
            'date_requested' => 'required',
            'date_needed' => 'required',
            'purpose' => 'nullable',
            'remarks' => 'nullable',
            'item_id' => 'required',
            'sku' => 'required',
            'quantity' => 'required',
        ];
    }
}
