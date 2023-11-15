<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\branch_info;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        branch_info::factory()
                     ->count(10)
                     ->create();
    }
}
