<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // This seeder demonstrates how 'hasbel', 'potongan', 'meter', 'pcs' values
        // could be generated or used. As per the user's request, these are not
        // being stored as columns in the 'stock_satuan' table.
        // If these values need to be persisted, a new table (e.g., 'stock_item_details')
        // with appropriate columns and a foreign key to 'stock' would be required.

        $sampleAttributes = [
            'hasbel' => 100.50,
            'potongan' => 10.00,
            'meter' => 5.25,
            'pcs' => 10,
        ];

        // Example of how you might use these values, e.g., for logging or further processing
        // \Illuminate\Support\Facades\Log::info('Sample Stock Attributes: ', $sampleAttributes);

        // If you intended to store these in a table, you would do something like:
        // \App\Models\StockItemDetail::create([
        //     'stock_id' => 1, // Assuming a stock item exists
        //     'hasbel' => $sampleAttributes['hasbel'],
        //     'potongan' => $sampleAttributes['potongan'],
        //     'meter' => $sampleAttributes['meter'],
        //     'pcs' => $sampleAttributes['pcs'],
        // ]);
    }
}