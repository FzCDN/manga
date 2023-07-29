<?php
// src/models/SeriesRecommendations.php

namespace App\Models;

class SeriesRecommendations {
       
    private $id;
    private $series_id;
    private $order_by;
    private $create_at;
    private $update_at;
    
    private $series;
    private $meta;
    private $lastch;
    
    public function __construct($id, $series_id, $order_by, $create_at, $update_at) {
        $this->id = $id;
        $this->series_id = $series_id;
        $this->order_by = $order_by;
        $this->create_at = $create_at;
        $this->update_at = $update_at;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getSeriesID() {
        return $this->series_id;
    }
    
    public function getOrderBy() {
        return $this->order_by;
    }
    
    public function getCreateAt() {
        return $this->create_at;
    }
    
    public function getUpdateAt() {
        return $this->update_at;
    }
    
    public function getSeries() {
        return $this->series;
    }
    
    public function setSeries($series) {
        $this->series = $series;
    }
    
    public function getMeta() {
        return $this->meta;
    }
    
    public function setMeta($meta) {
        $this->meta = $meta;
    }
    
       
    public function getLastch() {
        return $this->lastch;
    }
    
    public function setLastch($lastch) {
        $this->lastch = $lastch;
    }
    
}
