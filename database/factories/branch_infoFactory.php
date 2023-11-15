<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\branch_info;




class branch_infoFactory extends Factory
{
//     /**
//      * Define the model's default state.
//      *
//      * @return array
//      */

        public function definition()
        {
            return [
                'branch_name' => $this->faker->state(),
                'status'=>1,
                'admin_id'=>1,
            ];
        }
}
