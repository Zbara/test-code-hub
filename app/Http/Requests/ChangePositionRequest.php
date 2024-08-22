<?php

namespace App\Http\Requests;

class ChangePositionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'item_id' => ['required', 'exists:items,id'],
            'position' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
