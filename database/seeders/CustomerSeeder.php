<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    protected $customer;

    public function __construct()
    {
        $this->customer = new Customer();
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initialCustomers = [
            [
                'id' => '1',
                'name' => 'Walking Customer',
            ],
        ];

        foreach ($initialCustomers as $customer) {
            $newCustomer = $this->customer->getById($customer['id']);
            if (!$newCustomer) {
                $create_customer = $this->customer->create([
                    'id' => $customer['id'],
                    'name' => $customer['name'],
                ]);
            }
        }
    }
}
