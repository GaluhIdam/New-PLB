<?php

namespace Database\Factories;

use App\Models\HoardingTime;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HoardingTime>
 */
class HoardingTimeFactory extends Factory
{
    protected $model = HoardingTime::class;

    public function definition()
    {
        return [
            'bc_16_code' => $this->faker->numerify('001###'),
            'registration_date' => $this->faker->date('Y_m_d'),
            'registration_number' => $this->faker->randomNumber(6, true),
            'submission_number' => $this->faker->numerify('03900#####'),
            'date_of_filing' => $this->faker->date('Y_m_d'),
            'item_code' => $this->faker->numerify('##-###-##', '00-###-####', '00-####', ' 0-#-######### '),
            'item_name' => $this->faker->randomElement(['CAP', 'TOP KIT', 'SETSCREW', 'BUSH', 'FITTING SWIVEL', 'SHIM', 'TOW BAR', 'CIRCUIT', 'MAIN BATTERY', 'SEAL', 'FAN', 'PACKING', 'ARINC', 'FUEL FILTER']),
            'unit' => $this->faker->randomElement(['EA', 'SET', 'CA', 'CT', 'CS', 'DR', 'DMT']),
            'total' => $this->faker->randomFloat(1, 20, 30),
            'status' => $this->faker->randomElement(['OK', 'AVLB', 'REQ', 'REJ', 'CNL']),
        ];
    }
}
