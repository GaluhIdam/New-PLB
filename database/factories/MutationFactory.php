<?php

namespace Database\Factories;

use App\Models\Mutation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mutation>
 */
class MutationFactory extends Factory
{
    protected $model = Mutation::class;

    public function definition()
    {
        return [
            'item_code' => $this->faker->unique()->randomNumber(5),
            'item_name' => $this->faker->randomElement(['BUSHING', 'AXLE', 'SETSCREW', 'BUSH', 'CAP']),
            'unit' => $this->faker->randomElement(['EA', 'SET',]),
            'beginning_balance' => $this->faker->randomFloat(2, 0, 100),
            'in_bc_16' => $this->faker->randomFloat(2, 0, 100),
            'in_bc_40' => $this->faker->randomFloat(2, 0, 100),
            'in_bc_27' => $this->faker->randomFloat(2, 0, 100),
            'out_bc_28' => $this->faker->randomFloat(2, 0, 100),
            'out_bc_41' => $this->faker->randomFloat(2, 0, 100),
            'out_bc_27' => $this->faker->randomFloat(2, 0, 100),
            'adjustment' => $this->faker->randomFloat(2, 0, 100),
            'book_balance' => $this->faker->randomFloat(2, 0, 100),
            'inventory_taking' => $this->faker->randomFloat(2, 0, 100),
            'difference' => $this->faker->randomFloat(2, 0, 100),
            'created_at' => Carbon::now(),
        ];
    }
}
