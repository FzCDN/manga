<?php
// src/models/ChapterData.php

namespace App\Models;

class ChapterData {

    private $id;
    private $chapter_id;
    private $content;
    private $created_at;
    
    public function __construct($id, $chapter_id, $content, $created_at) {
        $this->id = $id;
        $this->chapter_id = $chapter_id;
        $this->content = $content;
        $this->created_at = $created_at;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getChapterId() {
        return $this->chapter_id;
    }
    
    public function getContent() {
        return $this->content;
    }
    
    public function getCreateAt() {
        return $this->created_at;
    }
    
}
