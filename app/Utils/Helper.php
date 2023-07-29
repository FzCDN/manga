<?php
namespace App\Utils;

class Helper {
    public static function slugify($text) {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9-]/', '-', $text);
        $text = preg_replace('/-+/', '-', $text);
        return $text;
    }

    public static function reconstructTitle($url) {
        $urlComponents = explode('/', $url);
        $slug = end($urlComponents);
        $title = str_replace('-', ' ', $slug);
        return ucwords($title);
    }
}
