<?php

namespace App\Models;

class Genres {
   protected $id;
   protected $title;
   protected $postname;
   
   // tambahan
   protected $series;
   protected $series_data;
   
   public function __construct($id, $title, $postname) {
        $this->id = $id;
        $this->title = $title;
        $this->postname = $postname;
   }
   
   public function getId() {
     return $this->id;
   }
   
   public function getTitle() {
     return $this->title;
   }
   
   public function getLink() {
     return $this->postname;
   }
   
   public function getSeriesData() {
      return $this->series;
   }
   
   public function setSeriesData($series) {
     $this->series = $series;
   }
   
   public function getGenData() {
      return $this->series_data;
   }
   
   public function setGenData($series) {
     $this->series_data = $series;
   }
   
}