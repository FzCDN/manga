<?php

namespace App\Utils;

use App\Utils\Database;

class Settings {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public static function getSiteSettings() {
        $query = "SELECT * FROM site_settings";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        return $result;
    }
}
