<?php 

namespace App\Models;

class WebData {
      
      protected $id;
      protected $data_name;
      protected $data_key;
      protected $update_at;
      
      public function __construct($id, $data_name, $data_key, $update_at ) {
          $this->id = $id;
          $this->data_name = $data_name;
          $this->data_key = $data_key;
          $this->update_at = $update_at;
      }
    
      public function getId() {
          return $this->id;
      }
      
      public function getDataName() {
          return $this->data_name;
      }
      
      public function getDataKey() {
          return $this->data_key;
      }
      
      public function getUpdateAt() {
          return $this->update_at;
      }
      
}