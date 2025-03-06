<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attribute;

class AttributeSeeder extends Seeder
{
    public function run()
    {
        Attribute::create(['name' => 'Department', 'type' => 'text']);
        Attribute::create(['name' => 'Start Date', 'type' => 'date']);
        Attribute::create(['name' => 'End Date', 'type' => 'date']);
    }
}
