<?php

namespace App\Actions;

class CompareValues {

    public function run (array $ticket, array $draw) {
        $output = array_intersect($ticket, $draw);
        sort($output);
        return $output;
    }
}
