<?php

namespace App\Actions\Inventory;

use App\Models\Inventory;
use App\Services\SortPositionService;

class DeleteItemAction
{
    public function __invoke(
        array $data = []
    ): void
    {
        $inventory = Inventory::query()
            ->where('user_id', auth()->id())
            ->where('id', $data['item_id'])
            ->first();

        if ($inventory) {
            $inventory->delete();

            (new SortPositionService())->sort();
        }
    }
}
