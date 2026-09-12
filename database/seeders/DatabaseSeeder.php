<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            SchoolClassSeeder::class,
            SubjectSeeder::class,
            UserSeeder::class,
            NotificationSeeder::class,
        ]);
    }
}
