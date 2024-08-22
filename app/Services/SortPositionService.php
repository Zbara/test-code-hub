<?php

namespace App\Services;

use App\Models\Inventory;

class SortPositionService
{
    public function sort(
        int $ignoreId = 0
    ): void
    {
        $inventories = Inventory::query()
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->where('user_id', auth()->id())
            ->orderBy('position')
            ->get();

        foreach ($inventories as $index => $item) {
            $item->update(['position' => $index + 1]);
        }
    }
}
