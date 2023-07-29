<?php
// src/models/Series.php

namespace App\Models;

use App\Models\SeriesMeta;
use App\Models\Database;

class Series {
    protected $id;
    protected $postname;
    protected $status;
    protected $image;
    protected $title;
    protected $views_weeks;
    protected $views_month;
    protected $views_all;
    protected $created_at;
    protected $updated_at;
    
    // tambahan
    
    protected $tri_last_ch;
    protected $slug;
    protected $type;
    protected $lastCh;
    
    
    // meta dll
    
    protected $meta;
    protected $chapters;
    protected $genres;
    
    // chapter menu
    
    protected $chChapter;
    protected $chChapters;
    
    public function __construct($id, $postname, $status, $image, $title, $views_weeks, $views_month, $views_all, $created_at, $updated_at ) {
        $this->id = $id;
        $this->postname = $postname;
        $this->status = $status;
        $this->image = $image;
        $this->title = $title;
        $this->views_weeks = $views_weeks;
        $this->views_month = $views_month;
        $this->views_all = $views_all;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getLink() {
        return $this->postname;
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function getImage() {
        return $this->image;
    }

    public function getTitle() {
        return $this->title;
    }
    
    public function getViewsWeeks() {
        return $this->views_weeks;
    }
    
    public function getViewsMonth() {
        return $this->views_month;
    }
    
    public function getViewsAll() {
        return $this->views_all;
    }
    
    public function getCreateAt() {
        return $this->created_at;
    }
    
    public function getUpdateAt() {
        return $this->updated_at;
    }
    
    public function getSlug() {
        return $this->slug;
    } 

    public function setSlug($slug) {
        $this->slug = $slug;
    }
    
    public function get3LastChapter() {
        return $this->tri_last_ch;
    }

    public function set3LastChapter($tri_last_ch) {
        $this->tri_last_ch = $tri_last_ch;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function setTypeManga($type) {
        $this->type = $type;
    }
    
    public function getLastCh() {
        return $this->lastCh;
    }
    
    public function setLastch($ch) {
        $this->lastCh = $ch;
    }
    
    public function getMeta() {
        return $this->meta;
    }
    
    public function setMeta($meta) {
        $this->meta = $meta;
    }
    
    public function getChapters() {
        return $this->chapters;
    }
    
    public function setChapters($chapters) {
        $this->chapters = $chapters;
    }
    
    public function getGenres() {
        return $this->genres;
    }
    
    public function setGenres($genres) {
        $this->genres = $genres;
    }
    
    
    // Chapter Menu
    
    public function getChChapter() {
        return $this->chChapter;
    }
    
    public function setChChapter($ch) {
        $this->chChapter = $ch;
    }
    
    public function getChChapters() {
        return $this->chChapters;
    }
    
    public function setChChapters($ch) {
        $this->chChapters = $ch;
    }

}