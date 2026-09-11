<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    public function run(): void
    {
        SchoolClass::firstOrCreate(['name' => 'X-IPA-1']);
        SchoolClass::firstOrCreate(['name' => 'X-IPA-2']);
        SchoolClass::firstOrCreate(['name' => 'XI-IPA-1']);
    }
}
