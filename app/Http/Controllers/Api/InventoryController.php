<?php

namespace App\Http\Controllers\Api;

use App\Actions\Inventory\AddItemAction;
use App\Actions\Inventory\DeleteItemAction;
use App\Exceptions\ItemLimitException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePositionRequest;
use App\Http\Requests\Inventory\AddItemRequest;
use App\Http\Requests\Inventory\RemoveItemRequest;
use App\Http\Resources\Inventory\ItemsResource;
use App\Http\Resources\Inventory\UserInventoryResource;
use App\Models\Inventory;
use App\Models\Item;
use App\Services\SortPositionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Инвентарь
 */
class InventoryController extends Controller
{
    /**
     * Получение все элентов которые доступные в инвентяре
     *
     * @return AnonymousResourceCollection
     */
    public function getItems()
    {
        return ItemsResource::collection(
            Item::query()->get()
        );
    }

    /**
     * Инвентарь пользователя
     *
     * @return AnonymousResourceCollection
     */
    public function getInventory()
    {
        return UserInventoryResource::collection(
            Inventory::query()
                ->where('user_id', auth()->id())
                ->with([
                    'item'
                ])
                ->orderBy('position')
                ->get()
        );
    }

    /**
     * Добавление нового элемента
     *
     * @param AddItemRequest $request
     * @param AddItemAction $addItem
     * @return UserInventoryResource
     * @throws ItemLimitException
     */
    public function addItem(
        AddItemRequest $request,
        AddItemAction $addItem
    )
    {
        $inventory = $addItem($request->validated());

        return UserInventoryResource::make(
            Inventory::query()
                ->with([
                    'item'
                ])
                ->find($inventory->id)
        );
    }

    /**
     * Удаление элемента
     *
     * @param RemoveItemRequest $request
     * @param DeleteItemAction $deleteItem
     * @return JsonResponse
     */
    public function deleteItem(
        RemoveItemRequest $request,
        DeleteItemAction $deleteItem
    )
    {
        $deleteItem($request->validated());

        return response()->json(null, 204);
    }

    public function changePosition(
        ChangePositionRequest $request,
    )
    {
        $inventory = Inventory::query()
            ->find($request->item_id);

        $inventory->update([
            'position' => $request->position,
        ]);

        (new SortPositionService())->sort($request->item_id);
    }
}
