<?php
// src/controllers/SeriesController.php

namespace App\Controllers;

use App\Models\Series;
use App\Models\SeriesMeta;
use App\Models\Chapter;
use App\Models\ChapterData;
use App\Utils\Database;
use App\Utils\Helper;
use App\Models\SeriesRecommendations;

use App\Models\Genres;
use App\Models\SeriesGenre;
use App\Models\SeriesPopular;

use Illuminate\Database\Capsule\Manager as Capsule;

class SeriesController extends CoreController { 
    
    public function typeManga($type, $pageNumber = 1) {
         
        if (!is_numeric($pageNumber)) {
           $pageNumber = 1;
        }
        
        $validTypes = ['manga', 'manhwa', 'manhua'];
        $type = strtolower($type);

        if (!in_array($type, $validTypes)) {
           $this->render404();
           exit; 
        }
        
        $type = ucfirst($type);
        $itemsPerPage = 30;
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $series = $this->getTypeSeries($type, $offset, $itemsPerPage);
        $pop = $this->getPop();
        
        $totalRows = $this->getTotalRowsType($type);
        $totalPages = ceil($totalRows / $itemsPerPage);
        $hasNextPage = $pageNumber < $totalPages;
        $hasPrevPage = $pageNumber > 1;
        
        $this->view('type-list', ['type' => $type, 'pop' => $pop, 'series' => $series, 'currentPage' => $pageNumber, 'totalPages' => $totalPages, 'hasNextPage' => $hasNextPage, 'hasPrevPage' => $hasPrevPage ]);
        exit;
    }

    public function ajaxSearch() {
        if (isset($_POST['action']) && $_POST['action'] === 'searchkomik') {
            $key = $_POST['search'];
            $series = $this->getSeriesSearch($key);
            
            $searchResults = array();
            
            foreach ($series as $seriesItem) {
                $seriesData = array(
                    'title' => $seriesItem->getTitle(),
                    'permalink' => '/' . SERIES_LINK . '/' . $seriesItem->getLink(),
                    'thumbnail' => $seriesItem->getImage(),
                    'genres' => array(),
                );
            
            
                foreach ($seriesItem->getGenres() as $genre) {
                    $seriesData['genres'][] = array(
                       'name' => $genre->getGenName()->getTitle(),
                    );
                 }
            
              $searchResults[] = $seriesData; 
            
            }
            
          header('Content-Type: application/json');
          echo json_encode($searchResults);
        }
    }
    
    public function homepage($pageNumber = 1) {
         
        if (!is_numeric($pageNumber)) {
           $pageNumber = 1;
        }
         
        if (isset($_GET['s'])) {
            $key = $_GET['s'];
            $series = $this->getSeriesSearch($key);
            $this->view('search', ['series' => $series, 'key' => $key]);
            exit;
        }
        
        $itemsPerPage = 30;
        
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $series = $this->getAllSeries($offset, $itemsPerPage);
        $req = $this->getReq();
        $pop = $this->getPop();
        
        $totalRows = $this->getTotalRows();
        $totalPages = ceil($totalRows / $itemsPerPage);
        $hasNextPage = $pageNumber < $totalPages;
        $hasPrevPage = $pageNumber > 1;
        
        $this->view('homepage', ['pop' => $pop, 'series' => $series, 'req' => $req, 'currentPage' => $pageNumber, 'totalPages' => $totalPages, 'hasNextPage' => $hasNextPage, 'hasPrevPage' => $hasPrevPage ]);
        exit;
    }
    
    public function genreNames($title, $pageNumber = 1) {
       if (!is_numeric($pageNumber)) {
           $pageNumber = 1;
       } 
       
       $pageNumber = max(1, $pageNumber);
       $itemsPerPage = 30;
       
       if (!$title) {
        $this->render404();
        exit; 
       }
       
       $offset = ($pageNumber - 1) * $itemsPerPage;
       $genre = $this->getAllGenres($title, $offset, $itemsPerPage);
       
       if (!$genre) {
          $this->render404();
          exit; 
       }
       
       $totalRows = $this->getTotalGenresRows($genre->getId());
       $totalPages = ceil($totalRows / $itemsPerPage);
       $hasNextPage = $pageNumber < $totalPages;
       $hasPrevPage = $pageNumber > 1;
       
       $pop = $this->getPop();
       
       $this->view('genre', ['pop' => $pop, 'genre' => $genre, 'currentPage' => $pageNumber, 'totalPages' => $totalPages, 'hasNextPage' => $hasNextPage, 'hasPrevPage' => $hasPrevPage ]);
    }
    
           
    public function seriesDetail($title) {
    
       if (REDIS_CACHE === 'yes') {
          $cacheKey = 'series:' . $title;
          $series = $this->redis->get($cacheKey);
          
          if ($series !== false && $series !== null) {
             $series = unserialize($series);
             
             $this->view('series_detail', ['series' => $series]);
             exit;
          }
       
       }
       
       $series = $this->getByTitle($title);
       
       if ($series !== null) {
          if (REDIS_CACHE === 'yes') {
             $this->redis->set($cacheKey, serialize($series));
             $this->redis->expire($cacheKey, 1000);
          }
          
          $this->view('series_detail', ['series' => $series]);
          exit;
       } else {
          $this->render404();
          exit;
       }
    
    }
    
    public function viewChapter($titles, $chaptertitle) {
    
        $cacheKey = 'chapter:' . $titles . ':' . $chaptertitle;
        
        if (REDIS_CACHE === 'yes') {
          $series = $this->redis->get($cacheKey);
        
          if ($series !== false && $series !== null) {
           $series = unserialize($series); 
             if ($series !== false) {
                if( $series->getChChapter() !== null) {
                  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['id_manga']) &&  $_POST['id_manga']) {
                       if (trim($_POST['id_manga']) === trim($series->getId())) {
                          $content = $series->getChChapter()->getchData()->getContent();
                          header('Content-Type: application/json');
                          http_response_code(200);
                          echo $content;
                          exit;   
                       } else {
                          $this->render404();
                          exit;   
                       }
                     } else {
                       $this->render404();
                       exit;   
                     }   
                  } else {
                    $this->view('chapter', ['series' => $series]);
                    exit;
                  } 
                }
             }   
          }
        }
        
        $series = $this->getChapterDataBytitle($titles, $chaptertitle);
        
        if ($series !== null) {
           if( $series->getChChapter() !== null) {
              if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['id_manga']) &&  $_POST['id_manga']) {
                    if (trim($_POST['id_manga']) === trim($series->getId())) {
                       $content = $series->getChChapter()->getchData()->getContent();
                       header('Content-Type: application/json');
                       http_response_code(200);
                       echo $content;
                       exit;   
                    } else {
                       $this->render404();
                       exit;   
                    }
                 } else {
                    $this->render404();
                    exit;   
                 }   
              } else {
                if (REDIS_CACHE === 'yes') {
                   $this->redis->set($cacheKey, serialize($series));
                }
                
                $this->view('chapter', ['series' => $series]);
                exit;
              }
           } else {
              $this->render404();
              exit;
           }
        } else {
           $this->render404();
           exit;
        }
        
        
    }
    
    public function bookMark() {
       $this->view('bookmark');
    }
    
    public function seriesDetailEdit($title) {
       if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
            $series = $this->getByTitleEdit($title);
            $this->edit('series', ['series' => $series]);
            exit;
        } else {
            $this->render404();
            exit;
        }
    }

    public function seriesDetailEditPost() {
       if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
          if (isset($_POST['id_manga']) && $_POST['id_manga'] !== null && $_POST['title'] !== null) {
          
             $id = $_POST['id_manga'];
             $type = $_POST['type'];
             $title = $_POST['title'];
             $image = $_POST['images'];
             $artist = $_POST['artist'] ?? null;
             $rating = $_POST['rating'] ?? null;
             $author = $_POST['author'] ?? null;
             $status = $_POST['status'] ?? null;
             $release = $_POST['release'] ?? null;
             $alternative = $_POST['alternative'] ?? null;
             $description = $_POST['description'] ?? null;
             
             $status_post = $_POST['status_post'] ?? 'draft';
             
             $updateSeries = $this->updateSeries($id, $title, $image, $status_post);
             
             if ($updateSeries) {
               $updateMeta = $this->updateMetaSeries($id, $alternative, $release, $author, $artist, $type, $rating, $status, $description);
               if ($updateMeta) {
                 $respon = ['result' => 'success', 'data' => $updateMeta];
               } else {
                 $respon = ['error' => 'Meta data is incomplete, or there is data that is not readable.'];
               }
             } else {
               $respon = ['error' => 'Series data is incomplete, or there is data that is not readable.'];
             }
          } else {
             $respon = ['error' => 'data is incomplete, or there is data that is not readable.'];
          }
       } else {
          $respon = ['error' => 'Login is required.'];
       }
       
       header('Content-Type: application/json');
       echo json_encode($respon);
    }
    
    public function seriesViewsCount() {
       if (isset($_POST['id_manga']) && $_POST['id_manga'] !== null) {
           $id = $_POST['id_manga'];
           $this->updateSeriesViews($id);
       }
    }
    
    public function ChapterDetailEdit($title, $chaptertitle) {
       if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
            $series = $this->getChapterDataBytitle($title, $chaptertitle);
        
            $this->edit('chapter', ['series' => $series]);
            exit;
        } else {
            $this->render404();
            exit;
        }
    }
    
    
    public function seriesEditChapter() {
        if (isset($_POST['id_manga']) && isset($_POST['id_chapter']) && isset($_POST['images']) && isset($_POST['id_chapter_data'])) {
            $seriesId = $_POST['id_manga'];
            $chapterId = $_POST['id_chapter'];
            $chDataID = $_POST['id_chapter_data'];
            
            $title = $_POST['title'];
            $titlech = $_POST['title_chapter'];
            $images = $_POST['images'];
            if (is_string($images)) {
                $images = json_decode($images, true);
            }
            
            $newImages = [];
            
            $folderPath = '/public/uploads/chapter/' . Helper::slugify($title) . '/' . Helper::slugify($titlech);

            if (!file_exists($this->mydirectory . $folderPath)) {
                mkdir($this->mydirectory . $folderPath, 0777, true);
            }
            
            foreach ($images as $key => $imageData) {
                if (strpos($imageData, 'data:image') === 0) {
                    $imageData = $this->removeDataURIScheme($imageData);

                    $imageFormat = $this->getImageFormatFromBase64($imageData);
                    if ($imageFormat === false) {
                        echo 'Invalid image format.';
                        return;
                    }

                    $imageData = base64_decode($imageData);

                    $imageFileName = uniqid() . '.' . $imageFormat;
                    $imageFilePath = $folderPath . '/' . $imageFileName;

                    file_put_contents($this->mydirectory . $imageFilePath, $imageData);
                    $newImages[] = ["image" => $imageFilePath];
                } else {
                    $newImages[] = ["image" => $imageData];
                    continue;
                }
            }
            
            $this->updateDataChapter($chDataID, $chapterId, $newImages);
            echo 'Images saved successfully.';
        } else {
            echo 'Invalid data. Make sure id_manga, id_chapter, and images are provided as an array.';
        }
    }
    
    private function updateDataChapter($chDataID, $chapterId, $chapterData) {
        Capsule::table('chapter_data')->where('id', $chDataID)->where('chapter_id', $chapterId)->update(['content' => $chapterData]);
    }
    
    private function getImageFormatFromBase64($base64Image) {
        $imageData = base64_decode($base64Image);
        
        $imageInfo = @getimagesizefromstring($imageData);

        if ($imageInfo === false) {
            return false;
        }

        // Get the image extension based on the image MIME type
        $mimeType = $imageInfo['mime'];
        $extension = image_type_to_extension($imageInfo[2], false);

        // Check if the extension is valid
        $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif'];
        if (!in_array($extension, $allowedExtensions)) {
            return false;
        }

        return $extension;
    }
    
    private function removeDataURIScheme($base64Image) {
        return preg_replace('/^data:image\/\w+;base64,/', '', $base64Image);
    }
    
}

