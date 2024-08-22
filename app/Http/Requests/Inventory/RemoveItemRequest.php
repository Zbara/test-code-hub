<?php

namespace App\Http\Requests\Inventory;

use App\Http\Requests\FormRequest;
use Auth;

class RemoveItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'item_id' => ['required', 'exists:inventories,id,user_id,' . Auth::id()],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
