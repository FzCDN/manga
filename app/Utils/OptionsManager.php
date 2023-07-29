<?php

namespace App\Utils;

use Illuminate\Database\Capsule\Manager as Capsule;

class OptionsManager {
    
    public function get_option($option_name, $default_value = '') {
        $query = "SELECT option_value FROM options WHERE option_name = :option_name";
        $result = Capsule::select($query, ['option_name' => $option_name]);

        if (!empty($result)) {
            return $result[0]->option_value;
        } else {
            return $default_value;
        }
    }

    public function update_option($option_name, $option_value) {
        Capsule::table('options')
            ->updateOrInsert(
                ['option_name' => $option_name],
                ['option_value' => $option_value]
            );
    }

}
