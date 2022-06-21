<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MutationPeriodic>
 */
class MutationPeriodicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'registration_date' => $this->faker->date('Y_m_d'),
            'registration_number' => $this->faker->randomNumber(6, true),
            'submission_number' => $this->faker->numerify('03900#####'),
            'submission_date' => $this->faker->date('Y_m_d'),
            'item_code' => $this->faker->numerify('##-###-##', '00-###-####', '00-####', ' 0-#-######### '),
            'item_name' => $this->faker->randomElement(['CAP', 'TOP KIT', 'SETSCREW', 'BUSH', 'FITTING SWIVEL', 'SHIM', 'TOW BAR', 'CIRCUIT', 'MAIN BATTERY', 'SEAL', 'FAN', 'PACKING', 'ARINC', 'FUEL FILTER']),
            'unit' => $this->faker->randomElement(['EA', 'SET',]),
            'beginning_balance' => $this->faker->randomFloat(2, 0, 100),
            'code_bc_16_in' => $this->faker->randomFloat(2, 0, 100),
            'code_bc_16_out' => $this->faker->randomFloat(2, 0, 100),
            'code_bc_27_in' => $this->faker->randomFloat(2, 0, 100),
            'code_bc_27_in' => $this->faker->randomFloat(2, 0, 100),
            'code_bc_28_out' => $this->faker->randomFloat(2, 0, 100),
            'code_bc_28_out' => $this->faker->randomFloat(2, 0, 100),
            'code_bc_30_out' => $this->faker->randomFloat(2, 0, 100),
            'code_bc_30_out' => $this->faker->randomFloat(2, 0, 100),
            'code_bc_40_out' => $this->faker->randomFloat(2, 0, 100),
            'code_bc_40_out' => $this->faker->randomFloat(2, 0, 100),
            'code_bc_41_out' => $this->faker->randomFloat(2, 0, 100),
            'code_bc_41_out' => $this->faker->randomFloat(2, 0, 100),
            'adjustment' => $this->faker->randomFloat(2, 0, 100),
            'book_balance' => $this->faker->randomFloat(1, 20, 30),
            'inventory_taking' => $this->faker->randomFloat(2, 0, 100),
            'difference' => $this->faker->randomFloat(2, 0, 100),
            'created_at' => Carbon::now(),
        ];
    }
}
