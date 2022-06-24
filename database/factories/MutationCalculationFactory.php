<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MutationCalculation>
 */
class MutationCalculationFactory extends Factory
{
    public function definition()
    {

        return [
            'item_code' =>  $this->faker->numerify('##-###-##'),
            'item_name' => $this->faker->randomElement(['CAP', 'TOP KIT', 'SETSCREW', 'BUSH', 'FITTING SWIVEL', 'SHIM', 'TOW BAR', 'CIRCUIT', 'MAIN BATTERY', 'SEAL', 'FAN', 'PACKING', 'ARINC', 'FUEL FILTER']),
            'unit' =>  $this->faker->randomElement(['EA', 'SET', 'CA', 'CT', 'CS', 'DR', 'DMT']),
            'first_balance' => $this->faker->randomFloat(2, 0, 100),
            'income_bc16' => $this->faker->randomFloat(2, 0, 100),
            'income_bc40' => $this->faker->randomFloat(2, 0, 100),
            'income_bc27' => $this->faker->randomFloat(2, 0, 100),
            'cost_bc28' => $this->faker->randomFloat(2, 0, 100),
            'cost_bc41' => $this->faker->randomFloat(2, 0, 100),
            'cost_bc27' => $this->faker->randomFloat(2, 0, 100),
            'cost_bc30' => $this->faker->randomFloat(2, 0, 100),
            'adjustment' => $this->faker->randomFloat(2, 0, 100),
            'book_balance' => $this->faker->randomFloat(1, 20, 30),
            'stock_opname' => $this->faker->randomFloat(2, 0, 100),
            'difference' => $this->faker->randomFloat(2, 0, 100),
            'date' => $this->faker->date('Y_m_d'),
        ];
    }
}
