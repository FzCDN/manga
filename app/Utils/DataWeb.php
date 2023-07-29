<?php

namespace App\Utils;

use App\Utils\Database;
use App\Utils\Helper;

class DataWeb {
    private static $instance;
    private $db;

    private function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DataWeb();
        }

        return self::$instance;
    }

    public function get_data($data_name, $default_value = '') {
       $query = "SELECT data_key FROM data_web WHERE data_name = :data_name";
       $stmt = $this->db->prepare($query);
       $stmt->bindParam(':data_name', $data_name);
       $stmt->execute();

       if ($stmt->rowCount() > 0) {
          $row = $stmt->fetch();
          return $row['data_key'];
       } else {
          return $default_value;
       }
    }

    public function update_data($option_name, $option_value) {
       $gmtTime = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
       $time = $gmtTime->format('Y-m-d H:i:s');
       
       $checkQuery = "SELECT COUNT(*) FROM data_web WHERE data_name = :data_name";
       $checkStmt = $this->db->prepare($checkQuery);
       $checkStmt->bindParam(':data_name', $option_name);
       $checkStmt->execute();
       $count = $checkStmt->fetchColumn();
       
       if ($count > 0) {
           $query = "UPDATE data_web SET data_key = :data_key, updated_at = :updated_at WHERE data_name = :data_name";
       } else {
           $query = "INSERT INTO data_web (data_name, data_key, updated_at) VALUES (:data_name, :data_key, :updated_at)";
       }
       
       $stmt = $this->db->prepare($query);
       $stmt->bindParam(':data_name', $option_name);
       $stmt->bindParam(':data_key', $option_value);
       $stmt->bindParam(':updated_at', $time);
       
       try {
          $stmt->execute();
       } catch (PDOException $e) {
          echo "Error: Failed to update data. Duplicate entry for data_name.";
       }
   }

}
