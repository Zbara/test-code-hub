<?php

namespace App\Http\Requests\Inventory;

use App\Http\Requests\FormRequest;

class AddItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'item_id' => ['required', 'integer', 'exists:items,id'],
            'position' => ['required', 'integer', 'min:1', 'max:5'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
