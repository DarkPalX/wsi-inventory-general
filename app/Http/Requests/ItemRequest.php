<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemRequest extends FormRequest
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
        $itemId = $this->route('item') ? $this->route('item')->id : null;
        $maxFileUrlSize = env('FILE_URL_SIZE') * 1024;
        $maxPrintFileUrlSize = env('PRINT_FILE_URL_SIZE') * 1024;
        $maxImageCoverSize = env('IMAGE_COVER_SIZE') * 1024;

        return [
            // 'sku' => 'required|string|max:50',
            'barcode' => [
                'required',
                'string',
                'max:255',
                Rule::unique('items', 'barcode')->ignore($itemId),
            ],
            'name' => 'required|string|max:255',
            // 'location' => 'nullable|string|max:255',
            'category_id' => 'nullable|integer|exists:item_categories,id',
            'image_cover' => 'nullable|file|mimes:png,jpg',
            // 'image_cover' => 'nullable|file|mimes:png,jpg|max:'. $maxImageCoverSize,
            // 'price' => 'nullable|numeric|min:0',
            'minimum_stock' => 'nullable|numeric|min:0',
            'type_id' => 'required|numeric'
        ];
    }
}
