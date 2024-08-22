<?php

namespace App\Actions\Inventory;

use App\Exceptions\ItemLimitException;
use App\Models\Inventory;

class AddItemAction
{

    /**
     * @throws ItemLimitException
     */
    public function __invoke(
        array $data = []
    )
    {
        if (auth()->user()->inventories()->count() >= 5) {
            throw new ItemLimitException('Добавлено максимальное количество элементов.');
        }
        return Inventory::create([
            'user_id' => auth()->id(),
            'item_id' => $data['item_id'],
            'position' => $data['position'],
        ]);
    }

}
