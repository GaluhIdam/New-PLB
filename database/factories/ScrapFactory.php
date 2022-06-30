<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Scrap;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Scrap>
 */
class ScrapFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $country = array('ID', 'US', 'MY', 'SG');
        return [
            'material_document_code_gr' => $this->faker->numerify('500#######'),
            'material_document_item_gr' => $this->faker->numberBetween(1, 3),
            'follow_up_document_code' => $this->faker->numerify('500#######'),
            'subsequent_document_code' => $this->faker->numberBetween(1, 2),
            'inbound_number' => $this->faker->numberBetween(8, 10),
            'posting_date_gr' => $this->faker->unique()->dateTimeBetween('-4 years', 'now'),
            'posting_time_gr' => $this->faker->time($format = 'H:i:s', $max = 'now'),
            'purchase_order_gr' => $this->faker->numerify('04500#####'),
            'purchase_document_item' => $this->faker->numberBetween(10, 60),
            'purchase_order_type' => $this->faker->randomElement(['NB', 'ZGS']),
            'billing_lading_101' => $this->faker->numerify('157-####-####', '160-########'),
            'billing_of_lading' => $this->faker->numerify('157-####-####', '160-########'),
            'vendor_code' => $this->faker->numerify('00000#####', '######'),
            'vendor_name' => $this->faker->randomElement(['VENDOR A', 'VENDOR B', 'VENDOR C', 'VENDOR D', 'VENDOR E', 'VENDOR F', 'VENDOR G', 'VENDOR H', 'VENDOR I', 'VENDOR J', 'VENDOR K', 'VENDOR L', 'VENDOR M', 'VENDOR N', 'VENDOR O', 'VENDOR P', 'VENDOR Q', 'VENDOR R', 'VENDOR S', 'VENDOR T', 'VENDOR U', 'VENDOR V', 'VENDOR W', 'VENDOR X', 'VENDOR Y', 'VENDOR Z']),
            'vendor_country' => $this->faker->randomElement($country),
            'for_tr_data_number' => $this->faker->numerify('0000######'),
            'prel_document_number' => $this->faker->numerify('16-0#####', '23-0#####'),
            'date_prel_document' => $this->faker->dateTimeBetween('-4 years', 'now'),
            'invoice_number' => $this->faker->numerify('#######-00', '##########'),
            'invoice_date' => $this->faker->dateTimeBetween('-4 years', 'now'),
            'movement_type' => $this->faker->randomElement(['963', '711', '964', 'Z04', 'P61']),
            'movement_type_description' => $this->faker->randomElement(['Unplanned Issue EXP', 'Goods Issue GPP', 'Unplan FIT of REP', 'Reversal-Upnla EXP', 'GI InvDiff Warehouse']),
            'user_code' => $this->faker->randomElement(['G582082', 'S146012', 'S337018', 'SSMADM', 'S337002']),
            'type' => $this->faker->randomElement(['OUTBOUND', 'REVERSAL', 'INBOUND']),
            'material_document' => $this->faker->numerify('49072#####'),
            'material_item' => $this->faker->numberBetween(1, 2),
            'material_code' => $this->faker->numerify('10-###-##', '1-####-###-0', '10-####-####'),
            'material_description' => $this->faker->randomElement(['LATCH ASSY', 'LIGHT ASSY', 'STATIC DISCHARGE']),
            'batch_number' => $this->faker->numerify('0002######'),
            'plant_code' => $this->faker->randomElement(['GAH4', 'CGK3', 'GASS', 'GADC', 'GAH2']),
            'storage_location' => $this->faker->randomElement(['2100', '2070', '1000', '2010', '2050', '2050']),
            'revision_description' => $this->faker->randomElement(['REV1', 'REV2', 'REV3', 'REV4', 'REV5']),
            'function_location_revision' => $this->faker->randomElement(['PK-GGC', 'HS-PPA', 'VH-VOM', 'RP-C3263']),
            'wbs_element' => $this->faker->randomElement(['F-411000-008', 'H-003220', 'H-002938']),
            'wbs_description' => $this->faker->randomElement(['TZG-MOTORIZED-TL', 'STATION HANGAR2', 'HS-PPA BANGKOK AIR 12YR+ADD APR 21']),
            'function_location_order' => $this->faker->randomElement(['PK-GMU', 'PK-GGC', 'VH-VOM', 'RP-C3263']),
            'aircraft_registration_fix' => $this->faker->randomElement(['N/A', 'N/A', 'N/A', 'N/A', 'N/A']),
            'costumer_order' => $this->faker->randomElement(['GIA00', 'CTV00', 'CTV01', 'BKP01', 'CEB01']),
            'costumer_name' => $this->faker->randomElement(['PT. GARUDA INDONESIA', 'CITILINK INDONESIA', 'CASTLELAKE', 'CEBU AIR', 'BANGKOK AIRWAYS']),
            'costumer_country' => $this->faker->randomElement($country),
            'costumer_fix' => $this->faker->randomElement(['GIA00', 'CTV00', 'CTV01', 'BKP01', 'CEB01']),
            'costumer_name_fix' => $this->faker->randomElement(['PT. GARUDA INDONESIA', 'CITILINK INDONESIA', 'CASTLELAKE', 'CEBU AIR', 'BANGKOK AIRWAYS']),
            'costumer_country_fix' => $this->faker->randomElement($country),
            'order_movement' => $this->faker->numerify('000#########'),
            'order_number' => $this->faker->numerify('000#########'),
            'order_description' => $this->faker->randomElement(['ORDER A', 'ORDER B', 'ORDER C', 'ORDER D', 'ORDER E', 'ORDER F', 'ORDER G', 'ORDER H', 'ORDER I', 'ORDER J', 'ORDER K', 'ORDER L', 'ORDER M', 'ORDER N', 'ORDER O', 'ORDER P', 'ORDER Q', 'ORDER R', 'ORDER S', 'ORDER T', 'ORDER U', 'ORDER V', 'ORDER W', 'ORDER X', 'ORDER Y', 'ORDER Z']),
            'recepient' => $this->faker->firstNameMale(),
            'posting_date' => $this->faker->dateTimeBetween('-4 years', 'now'),
            'amount_in_local_currency' => $this->faker->randomFloat(2, -1, -200),
            'currency' => $this->faker->randomElement(['USG', 'USD', 'IDR']),
            'created_date' => $this->faker->dateTimeBetween('-4 years', 'now'),
            'created_time' => $this->faker->time('H:i:s'),
            'type_bc' => $this->faker->randomElement(['BC30', 'BC28', 'EX27']),
            'download_form' => $this->faker->randomElement(['BC30', 'BC28', 'EX27']),
            'delivery' => $this->faker->numerify('0390######'),
            'submission_number' => $this->faker->creditCardNumber(),
            'submission_date' => $this->faker->dateTimeBetween('-4 years', 'now'),
            'registration_number' => $this->faker->numerify('001###'),
            'registration_date' => $this->faker->dateTimeBetween('-4 years', 'now'),
            'created_at' => Carbon::now(),
        ];
    }
}