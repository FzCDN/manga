<?php 

namespace App\Models;

class SeriesGenre {
  
  protected $id;
  protected $series_id;
  protected $genre_id;
  
  public $series;
  public $seriesData;
  
  public function __construct($id, $series_id, $genre_id ) {
        $this->id = $id;
        $this->series_id = $series_id;
        $this->genre_id = $genre_id;
  }
  
  public function getSeriesId() {
    return $this->series_id;
  }
  
  public function getGenreId() {
    return $this->genre_id;
  }
  
  public function getGenName() {
     return $this->series;
   }
   
   public function setGenData($series) {
     $this->series = $series;
   }
   
   public function getSeriesData() {
     return $this->seriesData;
   }
   
   public function setSeriesData($data) {
     $this->seriesData = $data;
   }
   

}