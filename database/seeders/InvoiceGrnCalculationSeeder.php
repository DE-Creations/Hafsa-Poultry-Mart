<?php

namespace Database\Seeders;

use App\Models\InvoiceGrnCalculation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceGrnCalculationSeeder extends Seeder
{
    protected $invoiceGrnCalculation;

    public function __construct()
    {
        $this->invoiceGrnCalculation = new InvoiceGrnCalculation();
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initialData = [
            [
                'id' => '1',
                'invoice_total' => '0.00',
                'grn_total' => '0.00',
            ],
        ];

        foreach ($initialData as $data) {
            $newData = $this->invoiceGrnCalculation->getById($data['id']);
            if (!$newData) {
                $create_data = $this->invoiceGrnCalculation->create([
                    'id' => $data['id'],
                    'invoice_total' => $data['invoice_total'],
                    'grn_total' => $data['grn_total'],
                ]);
            }
        }
    }
}
