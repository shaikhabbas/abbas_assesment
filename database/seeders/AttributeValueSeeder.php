<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AttributeValue;

class AttributeValueSeeder extends Seeder
{
    public function run()
    {
        AttributeValue::create([
            'attribute_id' => 1, // Department
            'project_id' => 1, // Project ID
            'value' => 'IT',
        ]);

        AttributeValue::create([
            'attribute_id' => 2, // Start Date
            'project_id' => 1, // Project ID
            'value' => '2025-03-01',
        ]);

        AttributeValue::create([
            'attribute_id' => 3, // End Date
            'project_id' => 1, // Project ID
            'value' => '2025-05-01',
        ]);
    }
}
