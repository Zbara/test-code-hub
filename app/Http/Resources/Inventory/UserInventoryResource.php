<?php

namespace App\Http\Resources\Inventory;

use App\Http\Resources\Api\User\UserResource;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Inventory */
class UserInventoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'position' => $this->position,
            'user_id' => $this->user_id,
            'item_id' => $this->item_id,
            'item' => new ItemsResource($this->whenLoaded('item')),
        ];
    }
}
