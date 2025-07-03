<?php

namespace Database\Seeders;

use App\Models\BagsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BagSeeder extends Seeder
{
    protected $bag;

    public function __construct()
    {
        $this->bag = new BagsCategory();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initialBags = [
            [
                'id' => '1',
                'name' => 'Small',
                'count' => 100,
            ],
            [
                'id' => '2',
                'name' => 'Medium',
                'count' => 100,
            ],
            [
                'id' => '3',
                'name' => 'Large',
                'count' => 100,
            ],
            [
                'id' => '4',
                'name' => 'Jumbo',
                'count' => 100,
            ],
        ];

        foreach ($initialBags as $bag) {
            $newBag = $this->bag->getById($bag['id']);
            if (!$newBag) {
                $create_bag = $this->bag->create([
                    'id' => $bag['id'],
                    'name' => $bag['name'],
                    'count' => $bag['count'],
                ]);
            }
        }
    }
}
