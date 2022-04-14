<?php

namespace App\Actions;

use App\Models\DrawType;

class NumberGenerator {

    public function run (int $id, int $amount_of_values) {

        $draw_type = DrawType::where('id',$id)->first();
        $volume = $draw_type->volume;
        $min = $draw_type->min_of_values;
        $max = $draw_type->max_of_values;

        if ($amount_of_values < $min || $amount_of_values > $max) {
            return; // THROW AN EXCEPTION
        }

        $all_values = [];
        $values = [];
        for ($i=1; $i<=$volume; $i++) {
            array_push($all_values, $i);
        }

        for ($n=0; $n<$amount_of_values; $n++) {
            $randomIndex = array_rand($all_values);
            array_push($values, $all_values[$randomIndex]);
            unset($all_values[$randomIndex]);
        }
        sort($values);
        return $values;
    }

}
