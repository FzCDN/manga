<?php

namespace App\Utils;

class Config
{
    public static function updateConfig($newConfig) {
        $configFile = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/config.php');
        
        foreach ($newConfig as $key => $value) {
            $pattern = "/define\('$key', '(.*)'\);/";
            $replacement = "define('$key', '$value');";
            $configFile = preg_replace($pattern, $replacement, $configFile);
        }
        
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/config.php', $configFile);
    }
}
