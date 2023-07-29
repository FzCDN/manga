<?php

namespace App\Models;

class SeriesMeta {
    
    //meta data
    protected $id;
    protected $series_id;
    protected $alternatif;
    protected $released;
    protected $author;
    protected $artist;
    protected $type;
    protected $rating;
    protected $status;
    protected $deskripsi;
    
    // tamabhan
    protected $seriesName;
    protected $setLastch;

    public function __construct($id, $series_id, $alternatif, $released, $author, $artist, $type, $rating, $status, $deskripsi) {
    $this->id = $id;
    $this->series_id = $series_id;
    $this->alternatif = $alternatif;
    $this->released = $released;
    $this->author = $author;
    $this->artist = $artist;
    $this->type = $type;
    $this->rating = $rating;
    $this->status = $status;
    $this->deskripsi = $deskripsi;
    }

    public function getId() {
       return $this->id;
    }
    
    public function getSeriesId() {
       return $this->series_id;
    }
    
    public function getAlternatif() {
       return $this->alternatif;
    }
    
    public function getReleased() {
       return $this->released;
    }
    
    public function getAuthor() {
       return $this->author;
    }
    
    public function getArtist() {
       return $this->artist;
    }
    
    public function getType() {
       return $this->type;
    }
    
    public function getRating() {
       return $this->rating;
    }
    
    public function getStatus() {
       return $this->status;
    }
    
    public function getDeskripsi() {
       return $this->deskripsi;
    }
    
    public function setseriesName($name) {
       $this->seriesName = $name;
    }
    
    public function getseriesName() {
       return $this->seriesName;
    }
    
    public function setLastch($name)  {
       $this->setLastch = $name;
    }
    
    public function getLastCh() {
       return $this->setLastch;
    }
    
}
