<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\Item;
use Database\Factories\InventoryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::factory()->count(10)->create();
    }
}
