<?php

namespace Database\Seeders;

use App\Models\OutputItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OutputItemSeeder extends Seeder
{
    protected $output_item;

    public function __construct()
    {
        $this->output_item = new OutputItem();
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initialOutputItems = [
            [
                'id' => '1',
                'name' => 'Chicken-B',
                'description' => 'Big Chicken',
            ],
            [
                'id' => '2',
                'name' => 'Chicken-S',
                'description' => 'Small Chicken',
            ],
        ];

        foreach ($initialOutputItems as $item) {
            $newItem = $this->output_item->getById($item['id']);
            if (!$newItem) {
                $create_item = $this->output_item->create([
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'description' => $item['description'],
                ]);
            }
        }
    }
}
