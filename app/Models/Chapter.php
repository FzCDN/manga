<?php

namespace App\Models;

class Chapter {
    protected $id;
    protected $series_id;
    protected $postname;
    protected $title;
    protected $created_at;
    
    protected $slug;
    protected $next_ch;
    protected $prev_ch;
    protected $nextslug;
    protected $prevslug;
    
    protected $chData;
    
    protected $series;
    
    public function __construct($id, $series_id, $postname, $title, $created_at ) {
        $this->id = $id;
        $this->image = $series_id;
        $this->postname = $postname;
        $this->title = $title;
        $this->views_weeks = $created_at;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getSeriesId() {
        return $this->series_id;
    }
    
    public function getLink() {
        return $this->postname;
    }

    public function getTitle() {
        return $this->title;
    }
    
    public function getCreateAt() {
        return $this->created_at;
    }
    
    public function setCreateAt($created_at) {
        $this->created_at = $created_at;
    }
    
    public function getSlug() {
        return $this->slug;
    } 

    public function setSlug($slug) {
        $this->slug = $slug;
    }
    
    public function getNextChapter() {
        return $this->next_ch;
    }
    
    public function setNextChapter($next_ch) {
        $this->next_ch = $next_ch;
    }
    
    public function getNextSlug() {
        return $this->nextslug;
    }

    public function setNextSlug($nextslug) {
        $this->nextslug = $nextslug;
    }
    
    public function getPrevChapter() {
        return $this->prev_ch;
    }
    
    public function setPrevChapter($prev_ch) {
        $this->prev_ch = $prev_ch;
    }
    
    public function getPrevSlug() {
        return $this->prevslug;
    }

    public function setPrevSlug($prevslug) {
        $this->prevslug = $prevslug;
    }
    
    
    // Data Chapter
    
    public function getchData() {
        return $this->chData;
    }
    
    public function setchData($chData) {
        $this->chData = $chData;
    }
    
    public function getSeries() {
        return $this->series;
    }
    
    public function setSeries($series) {
        $this->series = $series;
    }
    
}
