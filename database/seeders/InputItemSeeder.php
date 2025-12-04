<?php

namespace Database\Seeders;

use App\Models\InputItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InputItemSeeder extends Seeder
{
    protected $input_item;

    public function __construct()
    {
        $this->input_item = new InputItem();
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initialInputItems = [
            [
                'id' => '1',
                'name' => 'Live Chicken-B'
            ],
            [
                'id' => '2',
                'name' => 'Live Chicken-S'
            ],
        ];

        foreach ($initialInputItems as $item) {
            $newItem = $this->input_item->getById($item['id']);
            if (!$newItem) {
                $create_item = $this->input_item->create([
                    'id' => $item['id'],
                    'name' => $item['name'],
                ]);
            }
        }
    }
}
