<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

use App\Controllers\SeriesController;

// Mengambil argumen dari command line
$link = $argv[1] ?? null;
$images = $argv[2] ?? null;
$author = $argv[3] ?? null;
$artist = $argv[4] ?? null;
$genres = $argv[5] ?? null;
$release = $argv[6] ?? null;
$status = $argv[7] ?? null;

// Memeriksa apakah argumen link ada
if ($link === null) {
    echo "Link is required.\n";
    exit(1);
}

$scrapingController = new SeriesController();

try {
    // Memasukkan data ke dalam array
    $data = [
        'images' => $images,
        'author' => $author,
        'artist' => $artist,
        'genres' => $genres,
        'release' => $release,
        'status' => $status
    ];

    // Menghubungkan dan memasukkan data ke dalam scrape
    $scrapingController->scrape($link, $data);

    echo 'Done' . "\n";
    exit;
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
    exit(1);
}
