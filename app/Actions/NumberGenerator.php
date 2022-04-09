<?php

namespace App\Actions;

use App\Models\DrawType;

class NumberGenerator {

    public function generate (int $draw_type_id, int $amount_of_values) {

        $draw_type = Draw::find($draw_type_id);
        $volume = $draw_type->draw_type_volume;
        $min = $draw_type->draw_type_min_of_values;
        $max = $draw_type->draw_type_max_of_values;

        if ($amount_of_values < $min || $amount_of_values > $max) {
            return;
        }

        $all_values = [];
        $values = [];
        for ($i=1; $i<=$volume; $i++) {
            $values = array_push($all_values, $i);
        }

        for ($n=0; $n<$amount_of_values; $n++) {
            $randomIndex = array_rand($all_values);
            $values = array_push($values, $all_values[$randomIndex]);
            unset($all_values[$randomIndex]);
        }
        return sort($values);
    }

}
