<?php

namespace App\Controllers;

// Utils
use App\Utils\Helper;
use App\Utils\Database;
use App\Utils\DataWeb;
use App\Utils\OptionsManager;
use App\Utils\RedisConnection;

// tambahan
use App\Models\Chapter;
use App\Models\ChapterData;
use App\Models\Series;
use App\Models\SeriesMeta;

use App\Models\Genres;
use App\Models\SeriesGenre;
use App\Models\SeriesPopular;
use App\Models\SeriesRecommendations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CoreController {

    protected $db;
    protected $config;
    protected $time;
    protected $redis;
    protected $processData;
    
    // core
    protected $license;
    protected $mydirectory;
    protected $data;
    
    private $cacheData = [];
    
    public function __construct() {
    
        $currentDirectory = __DIR__;
        $this->mydirectory = realpath($currentDirectory . '/../../');
        
        
        $this->db = Database::getInstance()->getConnection();
        $this->config = new OptionsManager();
        
        $this->data = DataWeb::getInstance();
        
        $gmtTime = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
        $this->time = $gmtTime->format('Y-m-d H:i:s');
        
        if (!defined('SITE_TITLE')) {
           define('SITE_TITLE', $this->config->get_option('site_title', 'Komik Chan'));
        }
        
        if (!defined('SITE_TAGLINE')) {
           define('SITE_TAGLINE', $this->config->get_option('site_tagline', 'Baca Komik Bahasa Indonesia Terbaru'));
        }
        
        if (!defined('SITE_DOMAIN')) {
           define('SITE_DOMAIN', $this->config->get_option('site_domain', ''));
        }
        
        if (!defined('FAVICON_PATH')) {
           define('FAVICON_PATH', $this->config->get_option('favicon_path', '/public/favicon.ico'));
        }
        
        if (!defined('LOGO')) {
           define('LOGO', $this->config->get_option('logo', ''));
        }
        
        if (!defined('SERIES_LINK')) {
           define('SERIES_LINK', $this->config->get_option('series_link', 'series'));
        }
        
        if (!defined('LICENSE_KEY')) {
           define('LICENSE_KEY', $this->config->get_option('license', 'No Key'));
        }
        
        if (!defined('DISQUS')) {
           define('DISQUS', $this->config->get_option('disqus', 'komik-chan'));
        }
        
        if (!defined('DASHBOARD_URL')) {
           define('DASHBOARD_URL', $this->config->get_option('dashboard_url', 'dashboard'));
        }
        
        if (!defined('LOGIN_URL')) {
           define('LOGIN_URL', $this->config->get_option('login_url', 'login'));
        }
        
        if (!defined('LICENSE_ACTIVATING')) {
           define('LICENSE_ACTIVATING', $this->config->get_option('activate', false));
        }
        
        if (!defined('LICENSE')) {
           define('LICENSE', $this->config->get_option('license'));
        }
        
        if (!defined('HEADER')) {
           define('HEADER', $this->config->get_option('header'));
        }
        
        if (!defined('FOOTER')) {
           define('FOOTER', $this->config->get_option('footer'));
        }
        
        if (!defined('IKLAN_ATAS_CHAPTER')) {
           define('IKLAN_ATAS_CHAPTER', $this->config->get_option('ads_top_chapter'));
        }
        
        if (!defined('IKLAN_BAWAH_CHAPTER')) {
           define('IKLAN_BAWAH_CHAPTER', $this->config->get_option('ads_button_chapter'));
        }
        
        if (!defined('IKLAN_BAWAH_POPULAR')) {
           define('IKLAN_BAWAH_POPULAR', $this->config->get_option('ads_button_popular'));
        }
        
        if (!defined('IKLAN_BAWAH_LIST')) {
           define('IKLAN_BAWAH_LIST', $this->config->get_option('ads_button_list'));
        }
        
        if (!defined('IKLAN_ATAS_READ_CHAPTER')) {
           define('IKLAN_ATAS_READ_CHAPTER', $this->config->get_option('ads_top_read_chapter'));
        }
        
        if (!defined('IKLAN_BAWAH_READ_CHAPTER')) {
           define('IKLAN_BAWAH_READ_CHAPTER', $this->config->get_option('ads_button_read_chapter'));
        }
        
        if (!defined('IKLAN_HEADER_HOME')) {
           define('IKLAN_HEADER_HOME', $this->config->get_option('ads_home_header'));
        }
        
        // Settingan Redis
        if (!defined('REDIS_CACHE')) {
           define('REDIS_CACHE', $this->config->get_option('redis_cache', 'no'));
        }
        
        if (!defined('CACHE')) {
           define('CACHE', $this->config->get_option('cache', 'no'));
        }
        
        if (!defined('MAINTEN')) {
           define('MAINTEN', $this->config->get_option('mainten', 'no'));
        }
        
        $this->license = LICENSE;
        
        if (REDIS_CACHE === 'yes') {
           try {
              $redisConnection = new RedisConnection();
              $this->redis = $redisConnection->getRedis();
           } catch (\Exception $e) {
              $this->view('error', ['error' => $e->getMessage()]);
              exit;
           }
        }
        
    }
    
    // Universal Code
    protected function view($view, $data = []) {
       $cacheKey = md5($_SERVER['REQUEST_URI']); 
       
       extract($data);
       ob_start();
       include_once __DIR__ . '/../Views/' . $view . '.php';
       $content = ob_get_clean();
       
       if (!empty(ob_get_contents())) {
          $this->noCache();
       } else {   
          $this->cacheContent($cacheKey, $content);
       }
       
       echo $content; 
       
       return;
    }
    
    protected function edit($view, $data = []) {
        extract($data);
        include_once __DIR__ . '/../Views/Edit/' . $view . '.php';
    }
    
    protected function viewAuth($view, $data = []) {
        extract($data);
        include_once __DIR__ . '/../Views/Auth/' . $view . '.php';
    }
    
    protected function viewDash($view, $data = []) {
        extract($data);
        include_once __DIR__ . '/../Views/Dashboard/' . $view . '.php';
    }
    
    protected function render404() {
        header("HTTP/1.0 404 Not Found");
        $this->view('404');
        exit;
    }
    
    protected function mainteMode() {
        $this->view('maintenance');
        exit;
    }
     
    protected function timeAgo($timestamp) {
    
        $currentTimestamp = strtotime($this->time);
        $diff = $currentTimestamp - $timestamp;
        
        $intervals = array( 'year' => 31536000, 'month' => 2592000, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'mins' => 60, 'secs' => 1 );
        
        
        foreach ($intervals as $interval => $seconds) {
            $quantity = floor($diff / $seconds);

            if ($quantity > 0) {
               $result = '';
               if ($interval === 'mins' || $interval === 'secs') {
                  $result = $this->formatQuantity($quantity) . ' ' . $interval . ' ago';
               } else {   
                  $result = $quantity . ' ' . $interval . ($quantity > 1 ? 's' : '') . ' ago';
               }
             return $result;   
            }
        }
        return 'Just Now'; 
    }

    protected function formatQuantity($quantity) {
        return str_pad($quantity, 2, '0', STR_PAD_LEFT);
    }
    
    public function getCachedContent($cacheKey) {
    
        if (isset($this->cacheData[$cacheKey])) {
            return $this->cacheData[$cacheKey];
        }
        
        $cacheFilePath = $this->mydirectory . '/cache/' . $cacheKey;
        
        if (file_exists($cacheFilePath)) {
            $cachedData = file_get_contents($cacheFilePath);

            if ($cachedData) {
                $this->cacheData[$cacheKey] = $cachedData;
                return $cachedData;
            }
         }

        return false;
    }

    public function cacheContent($cacheKey, $content) {
        $cacheFilePath = $this->mydirectory . '/cache/' . $cacheKey;
        
        file_put_contents($cacheFilePath, $content);
    }
    
    public function checkExpiredCache() {
         $cacheDirectory = $this->mydirectory . '/cache/';
         $files = glob($cacheDirectory . '*');
         
         foreach ($files as $file) {
              $cachedData = file_get_contents($file);
              
              $expirationTime = filemtime($file) + (30 * 60); 
              
              if (time() > $expirationTime) {
                  unlink($file);
              }
         }
    }
    
    /**
     * Run a Function for delete cache use uri  
     *
     * @params cacheKey
     * @return null or true
     */
    
    protected function deleteCache($cacheKey) {
         $cacheFilePath = $this->mydirectory . '/cache/' . $cacheKey;
         
         if (file_exists($cacheFilePath)) {
           unset($this->cacheData[$cacheKey]);
           unlink($cacheFilePath); 
           return true;
         }
         
         return false;
    }

    /**
     * Run a programs for delete cache homepage 
     *
     * @params none
     * @return void
     */
     
    protected function deleteHomeCache() {
        $homeCacheKey = md5('/'); 
        return $this->deleteCache($homeCacheKey);
    }
    
    /**
     * Run a programs for get analysis 
     *
     * @params Referral and IP address 
     * @return void
     */
     
    public function postAnalysisPage() {
       if (isset($_POST['referral'])) {
          $referralDomain = parse_url($_POST['referral'], PHP_URL_HOST);
          $currentDomain = $_SERVER['HTTP_HOST'];
          if ($referralDomain === $currentDomain) {
              $referer = null;
          } else {
              $referer = $_POST['referral'];
          }
       } else {
          $referer = null;
       }
       
       $this->updateTodayViewsWeb();
       $this->updateUserOnlineStatus();
       $this->getTrafficSource($referer);
    }
    
    private function resetViewsToday() {
        try {
            Capsule::table('series')->update(['views_today' => 0]);

            echo "views_today reset for all series.\n";
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
    
    private function resetViewsMonth() {
        try {
            Capsule::table('series')->update(['views_month' => 0]);

            echo "views_month reset for all series.\n";
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
    
    private function resetViewsWeeks() {
        try {
            Capsule::table('series')->update(['views_weeks' => 0]);

            echo "views_weeks reset for all series.\n";
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
    
    public function resetViews() {
        $currentTime = time();
        $resetTime = strtotime('00:00:00');
        $currentDay = date('j');
        $currentWeekDay = date('w');

        if ($currentTime >= $resetTime && $currentTime < ($resetTime + 60)) {
            $this->resetViewsToday();

            if ($currentDay === 1) {
                $this->resetViewsMonth();
            }

            if ($currentWeekDay === '0') {
                $this->resetViewsWeeks();
            }
        }
    }
    
    // Data Dashboard
    
    protected function chapterCount() {
       return Capsule::table('chapter')->count();
    }
    
    protected function seriesCount() {
       return Capsule::table('series')->count();
    }
    
    // Setingan Dashboard 
    protected function settingDash($siteTitle, $siteTagline, $default_domain, $faviconPath, $logo, $seriesLink, $disqus, $dashboard_url, $login_url, $header, $footer, $ads_top_chapter, $ads_button_chapter, $ads_button_popular, $ads_button_list, $ads_button_read_chapter, $ads_top_read_chapter, $ads_home_header, $cache, $mainten) {
        $this->config->update_option('site_title', $siteTitle);
        $this->config->update_option('site_tagline', $siteTagline);
        $this->config->update_option('site_domain', $default_domain);
        $this->config->update_option('favicon_path', $faviconPath);
        $this->config->update_option('logo', $logo);
        $this->config->update_option('series_link', $seriesLink);
        $this->config->update_option('disqus', $disqus);
        $this->config->update_option('dashboard_url', $dashboard_url);
        $this->config->update_option('login_url', $login_url);
        $this->config->update_option('header', $header);
        $this->config->update_option('footer', $footer);
        $this->config->update_option('ads_top_chapter', $ads_top_chapter);
        $this->config->update_option('ads_button_chapter', $ads_button_chapter);
        $this->config->update_option('ads_button_popular', $ads_button_popular);
        $this->config->update_option('ads_button_list', $ads_button_list);
        $this->config->update_option('ads_button_read_chapter', $ads_button_read_chapter);
        $this->config->update_option('ads_top_read_chapter', $ads_top_read_chapter);
        $this->config->update_option('ads_home_header', $ads_home_header);
        
        $this->config->update_option('cache', $cache);
        $this->config->update_option('mainten', $mainten);
    }
    
    public function settingPageConf() {
    
        $default_domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
        $siteTitle = $_POST['site_title'];
        $siteTagline = $_POST['site_tagline'];
        $faviconPaths = $_POST['favicon_path'];
        $logo = $_POST['logo'];
        $seriesLink = $_POST['series_url'];
        $disqus = $_POST['disqus'];
        $dashboard_url = $_POST['dashboard_url'];
        $login_url = $_POST['login_url'];
        $header = $_POST['header'];
        $footer = $_POST['footer'];
        $ads_button_list = $_POST['iklan_bawah_list'];
        $ads_button_popular = $_POST['iklan_bawah_popular'];
        $ads_top_chapter = $_POST['ads_top_chapter'];
        $ads_button_read_chapter = $_POST['ads_button_read_chapter'];
        $ads_top_read_chapter = $_POST['ads_top_read_chapter'];
        $ads_button_chapter = $_POST['ads_button_chapter'];
        $ads_home_header = $_POST['ads_home_header'];
        $cache = $_POST['cache'] ?? 'no';
        
        $mainten = $_POST['mainten'];
        
        $this->settingDash($siteTitle, $siteTagline, $default_domain, $faviconPaths, $logo, $seriesLink, $disqus, $dashboard_url, $login_url, $header, $footer, $ads_top_chapter, $ads_button_chapter, $ads_button_popular, $ads_button_list, $ads_button_read_chapter, $ads_top_read_chapter, $ads_home_header, $cache, $mainten);
    }
    
    // Update Function
    
    protected function updateSeries($id, $title, $image, $status_post) {
        Capsule::table('series')->where('id', $id)->update(['title' => $title, 'image' => $image, 'status' => $status_post]);
        return true;
    }

    protected function updateMetaSeries($seriesId, $alternatif, $released, $author, $artist, $type, $rating, $status, $deskripsi) {
        try {
           $affectedRows = Capsule::table('series_meta')
             ->where('series_id', $seriesId)
             ->update([
                'alternatif' => $alternatif,
                'released' => $released,
                'author' => $author,
                'artist' => $artist,
                'type' => $type,
                'rating' => $rating,
                'status' => $status,
                'deskripsi' => $deskripsi
            ]);
            
            return true;
        
      } catch (Exception $e) {
        return $e; 
      }
    }
    
    // Series Function
     protected function getSeriesList() {
           $series = Capsule::table('series')->where('status', 'publish')->orderBy('updated_at', 'DESC')->get();
           
           $result = [];
           
           foreach ($series as $row) {
               $seriesItem = new Series($row->id, $row->postname, $row->status, $row->image, $row->title, $row->views_weeks, $row->views_month, $row->views_all, $row->created_at, $row->updated_at);
               
               $chapter3 = $this->getChaptersBySeriesId3($row->id);
               $seriesItem->set3LastChapter($chapter3);
               
               $type = $this->getMetaById($row->id);
               $seriesItem->setMeta($type);
               
               $result[] = $seriesItem;
            }    
            
            return $result;
     }
     
     protected function getByTitle($title) {
        $series = Capsule::table('series')
        ->where('postname', $title)
        ->where('status', 'publish')
        ->get()
        ->first();
        
        if ($series) {
            $seriesItem = new Series($series->id, $series->postname, $series->status, $series->image, $series->title, $series->views_weeks, $series->views_month, $series->views_all, $series->created_at, $series->updated_at);
            
            $meta = $this->getMetaById($series->id);
            $seriesItem->setMeta($meta);
            
            $chapters = $this->getChaptersBySeriesId($series->id);
            $seriesItem->setChapters($chapters);
            $genres = $this->getGenre($series->id);
            $seriesItem->setGenres($genres);

            return $seriesItem;
        }
        return $series;
     }
     
     protected function getByTitleEdit($title) {
        $series = Capsule::table('series')
        ->where('postname', $title)
        ->get()
        ->first();
        
        if ($series) {
            $seriesItem = new Series($series->id, $series->postname, $series->status, $series->image, $series->title, $series->views_weeks, $series->views_month, $series->views_all, $series->created_at, $series->updated_at);
            
            $meta = $this->getMetaById($series->id);
            $seriesItem->setMeta($meta);
            
            $chapters = $this->getChaptersBySeriesId($series->id);
            $seriesItem->setChapters($chapters);
            $genres = $this->getGenre($series->id);
            $seriesItem->setGenres($genres);

            return $seriesItem;
        }
        return $series;
     }
     
     protected function getSeriesSearch($title) {
        $series = Capsule::table('series')
        ->where('title', 'LIKE', '%' . $title . '%')
        ->where('status', 'publish')
        ->get();
        
        $result = [];
        
        foreach ($series as $row) {
            $seriesItem = new Series(
                $row->id,
                $row->postname,
                $row->status,
                $row->image,
                $row->title,
                $row->views_weeks,
                $row->views_month,
                $row->views_all,
                $row->created_at,
                $row->updated_at
            );
        
            $chapter3 = $this->getChaptersBySeriesId3($row->id);
            $seriesItem->set3LastChapter($chapter3);
            
            $type = $this->getMetaById($row->id);
            $seriesItem->setMeta($type);
            
            $genres = $this->getSeriesbyId($row->id);
            $seriesItem->setGenres($genres);
            
            $result[] = $seriesItem;
        }
        
        return $result;
     }
     
     protected function getAllSeries($offset = 0, $limit = 30) {
          $series = Capsule::table('series')
             ->where('status', 'publish')
             ->orderBy('updated_at', 'DESC')
             ->offset($offset)
             ->limit($limit)
             ->get();

          $result = [];
          
          
          foreach ($series as $row) {
             $seriesItem = new Series(
                $row->id,
                $row->postname,
                $row->status,
                $row->image,
                $row->title,
                $row->views_weeks,
                $row->views_month,
                $row->views_all,
                $row->created_at,
                $row->updated_at
             );

            $chapter3 = $this->getChaptersBySeriesId3($row->id);
            $seriesItem->set3LastChapter($chapter3);

            $type = $this->getMetaById($row->id);
            $seriesItem->setMeta($type);
            
            $result[] = $seriesItem;
         }

       return $result;
     }


     protected function getByID($id) {
          $series = Capsule::table('series')->where('id', $id)->where('status', 'publish')->first();
          
          if ($series) {
              $seriesItem = new Series(
                   $series->id,
                   $series->postname,
                   $series->status,
                   $series->image,
                   $series->title,
                   $series->views_weeks,
                   $series->views_month,
                   $series->views_all,
                   $series->created_at,
                   $series->updated_at
             );
             
             $genres = $this->getGenre($series->id);
             $seriesItem->setGenres($genres);
             
             return $seriesItem;
         }

       return null;
     }
     
     protected function getTotalRows() {
        $result = Capsule::table('series')->where('status', 'publish')->count();
        return $result;
     }
     
     // Meta Series Function
     
     protected function getMetaById($seriesId) {
           $meta = Capsule::table('series_meta')
             ->where('series_id', $seriesId)
             ->first();
        
           if (empty($meta)) {
              return null;
           }
           
           $metaItem = new SeriesMeta($meta->id, $meta->series_id, $meta->alternatif, $meta->released, $meta->author, $meta->artist, $meta->type, $meta->rating, $meta->status, $meta->deskripsi);
           
           return $metaItem;
    }
    
    // List Type Function
    
    protected function getTypeSeries($type, $offset = 1, $limit = 30) {
          $series = Capsule::table('series_meta')
             ->where('type', $type)
             ->offset($offset)
             ->limit($limit)
             ->get(); 

          $result = [];
          
          foreach ($series as $meta) {
          
             $seriesItem = new SeriesMeta($meta->id, $meta->series_id, $meta->alternatif, $meta->released, $meta->author, $meta->artist, $meta->type, $meta->rating, $meta->status, $meta->deskripsi);
             
             $series = $this->getByID($meta->series_id);
             if (!$series) {
                continue;
             }
             
             $seriesItem->setseriesName($series);
             
             $chapter = $this->get1ChaptersBySeriesId($meta->series_id);
             $seriesItem->setLastch($chapter);
             
             $result[] = $seriesItem;
         }

       return $result;
     }
     
     protected function getTotalRowsType($type) {
        $result = Capsule::table('series_meta')->where('type', $type)->count();
        return $result;
     }
     
    // Chapter Function
    
    protected function getChaptersBySeriesId3($seriesId) {
          $chapters = [];
          
          $data = Capsule::table('chapter')
             ->select('*')
             ->where('series_id', $seriesId)
             ->orderByRaw('CAST(SUBSTRING_INDEX(title, " ", -1) AS DECIMAL(6,2)) DESC')
             ->limit(3)
             ->get();

         foreach ($data as $row) {
             $chapter = new Chapter($row->id, $row->series_id, $row->postname, $row->title, strtotime($row->created_at));
             
             $chapter->setCreateAt($this->timeAgo(strtotime($row->created_at)));

             $chapters[] = $chapter;
         }

       return $chapters;
     }    
    
     protected function getChaptersBySeriesId($seriesId) {
         $query = "SELECT * FROM chapter WHERE series_id = :seriesId ORDER BY CAST(SUBSTRING_INDEX(title, ' ', -1) AS DECIMAL(6,2)) DESC";
         $chapters = Capsule::select($query, ['seriesId' => $seriesId]);
         
         $result = [];
         foreach ($chapters as $chapter) {
              $chapterItem = new Chapter($chapter->id, $chapter->series_id, $chapter->postname, $chapter->title, strtotime($chapter->created_at));
              $chapterItem->setCreateAt($this->timeAgo(strtotime($chapter->created_at)));
              $result[] = $chapterItem;
         }
         
         return $result;
     }   
    
    
    // Genres Function 
    
    protected function getAllGenres($name, $offset, $itemsPerPage) {
        $genre = Capsule::table('series_genre')->where('postname', $name)->first();
        
        if ($genre) {
            $genreData = new Genres($genre->id, $genre->title, $genre->postname);
            $seriesGenre = $this->getAllGenresOff($genre->id, $offset, $itemsPerPage);
            $genreData->setSeriesData($seriesGenre);
            return $genreData;
        }
        
        return null;
    }    
    
    protected function getAllGenresOff($genre_id, $offset = 0, $limit = 30) {
          $genres = Capsule::table('genres')
              ->where('genre_id', $genre_id)
              ->offset($offset)
              ->limit($limit)
              ->get();
          
          $genresData = [];
          
          foreach ($genres as $genre) {
              $genreData = new SeriesGenre($genre->id, $genre->series_id, $genre->genre_id );
              
              $genreName = $this->getSeriesName($genre->series_id);
              $genreData->setGenData($genreName);
              
              if (!$genreName) {
                 continue; 
              }
              
              $genresData[] = $genreData;
          }
          
        return $genresData;
     }    
        
     
     protected function getSeriesbyId($seriesid) {
         $genreData = Capsule::table('genres')
            ->where('series_id', $seriesid)
            ->get();
            
         $genres = [];   
         
         foreach ($genreData as $genre) {
            $genreItem = new SeriesGenre($genre->id, $genre->series_id, $genre->genre_id );
            
            $genreName = $this->getGenreName($genre->genre_id);
            $genreItem->setGenData($genreName);
            
            $genres[] = $genreItem;
         }
         
         return $genres;
    }	     
     
     protected function getGenrebyId($genreId) {
         $genreData = Capsule::table('genres')
           ->where('genre_id', $genreId)
           ->get();

         $genres = [];
         
         foreach ($genreData as $genre) {
              $genreItem = new SeriesGenre( $genre->id, $genre->series_id, $genre->genre_id );

              $seriesData = $this->getGenreName($genre->genre_id);
              $genreItem->setGenData($seriesData);
              
              $genres[] = $genreItem;
         }
    
         return $genres;
    }	     
    
    protected function getSeriesName($seriesId) {
        $seriesData = Capsule::table('series')->where('id', $seriesId)->where('status', 'publish')->first();
        
        if (empty($seriesData)) {
            return null;
        }
        
        $seriesItem = new Series( $seriesData->id, $seriesData->postname, $seriesData->status, $seriesData->image, $seriesData->title, $seriesData->views_weeks, $seriesData->views_month, $seriesData->views_all, $seriesData->created_at, $seriesData->updated_at);
        
        $series = $this->get1ChaptersBySeriesId($seriesData->id);
        $seriesItem->setLastch($series);
        
        return $seriesItem;
    }

    protected function getGenreName($genreID) {
        $genreData = Capsule::table('series_genre')
          ->where('id', $genreID)
          ->first();

        $genreItem = new Genres($genreData->id, $genreData->title, $genreData->postname);
        
        return $genreItem;
    }
    
    protected function getGenres() {
        $genresData = Capsule::table('genres')->get();
        
        $genres = [];
        
        foreach ($genresData as $genre) {
            $genreData = new Genres($genre->id, $genre->series_id, $genre->genre_id );
            $genreName = $this->getGenreName($genre->genre_id);
            $genreData->setGenData($genreName);
            
            $genres[] = $genreData;
        }
       return $genres;
    }

    protected function getGenre($seriesId) {
    
       $genresData = Capsule::table('genres')
          ->where('series_id', $seriesId)
          ->get();
          
       $genres = [];   
       
       foreach ($genresData as $genre) {
           $genreData = new SeriesGenre( $genre->id, $genre->series_id, $genre->genre_id );
           
           $gendata = $this->getGenreNamess($genre->genre_id);
           $genreData->setGenData($gendata);
           
           $genres[] = $genreData;
       }
       return $genres;
    }

    protected function getGenreNamess($genreID) {
        $row = Capsule::table('series_genre')
           ->where('id', $genreID)
           ->first();

        if ($row) {
           $genres = new Genres($row->id, $row->title, $row->postname );
           return $genres;
        }
        
        return null;
   }   
   
   protected function getAllGenresList() {
       $getData = Capsule::table('series_genre')->limit(30)->get();
       
       $genres = [];

       foreach ($getData as $genre) {
            $genreData = new Genres( $genre->id, $genre->title, $genre->postname );
            $genres[] = $genreData;
       }
       
       return $genres;
    }   

    protected function getTotalGenresRows($genre_id) {
         $result = Capsule::table('genres')->where('genre_id', $genre_id)->count();
         return $result;
    }
     
     // Chapter Function
     
     protected function get1ChaptersBySeriesId($seriesId) {
         $chapter = Capsule::table('chapter')
        ->where('series_id', $seriesId)
        ->orderBy(Capsule::raw('CAST(SUBSTRING_INDEX(title, " ", -1) AS DECIMAL(5,1))'), 'DESC')
        ->first();
        
        if (empty($chapter)) {
           return null;
        }   
           
        $chapterItem = new Chapter($chapter->id, $chapter->series_id, $chapter->postname, $chapter->title, strtotime($chapter->created_at));
        $chapterItem->setCreateAt($this->timeAgo(strtotime($chapter->created_at)));
        
        return $chapterItem;
     }
    
     protected function getChapterDataBytitle($title, $chaptertitle) {
         $series = Capsule::table('series')->where('postname', $title)->where('status', 'publish')->first();
         if ($series) {
             $seriesItem = new Series( $series->id, $series->postname, $series->status, $series->image, $series->title, $series->views_weeks, $series->views_month, $series->views_all, strtotime($series->created_at), strtotime($series->updated_at) );
             $seriesItem->setChChapter($this->getChapterByTitle($series->id, $chaptertitle));
             $seriesItem->setChChapters($this->getChaptersBySeriesId($series->id));
             return $seriesItem;
         }
         return null;
      }
      
      protected function getChapterByTitle($seriesId, $chapterTitle) {
      
          $query = "SELECT * FROM chapter WHERE series_id = :seriesId AND postname = :chapterTitle";
          $chapter = Capsule::selectOne($query, ['seriesId' => $seriesId, 'chapterTitle' => $chapterTitle]); 
          
          if ($chapter) {
             $chapterData = new Chapter( $chapter->id, $chapter->series_id, $chapter->postname, $chapter->title, strtotime($chapter->created_at));
             
             $chapterData->setchData($this->getByChapterId($chapter->id));
             $chapterData->setNextChapter($this->getNextChapter($seriesId, $chapter->title));
             $chapterData->setPrevChapter($this->getPrevChapter($seriesId, $chapter->title));
             
             return $chapterData;
          }
          return null;
     }
     
     
     protected function getPrevChapter($seriesId, $chapterId) {
          $chapterNumber = preg_replace('/(Chapter )(\d+(\.\d+)?)/i', '$2', $chapterId);

          $query = "SELECT * FROM chapter WHERE series_id = :seriesId AND CAST(SUBSTRING_INDEX(title, ' ', -1) AS DECIMAL(6,2)) < :chapterNumber ORDER BY CAST(SUBSTRING_INDEX(title, ' ', -1) AS DECIMAL(6,2)) DESC LIMIT 1";
          
          $prevChapter = Capsule::selectOne($query, ['seriesId' => $seriesId, 'chapterNumber' => $chapterNumber]);
          
          if ($prevChapter) { $chapter = new Chapter( $prevChapter->id, $prevChapter->series_id, $prevChapter->postname, $prevChapter->title, strtotime($prevChapter->created_at) );
             return $chapter;
          }
          return null;
     }

     protected function getNextChapter($seriesId, $chapterId) {
         $chapterNumber = preg_replace('/(Chapter )(\d+(\.\d+)?)/i', '$2', $chapterId);

         $query = "SELECT * FROM chapter WHERE series_id = :seriesId AND CAST(SUBSTRING_INDEX(title, ' ', -1) AS DECIMAL(6,2)) > :chapterNumber ORDER BY CAST(SUBSTRING_INDEX(title, ' ', -1) AS DECIMAL(6,2)) ASC LIMIT 1";
         
         $nextChapter = Capsule::selectOne($query, ['seriesId' => $seriesId, 'chapterNumber' => $chapterNumber]);
         
         if ($nextChapter) {
             $chapter = new Chapter( $nextChapter->id, $nextChapter->series_id, $nextChapter->postname, $nextChapter->title, strtotime($nextChapter->created_at) );
             
             return $chapter;
         }
         
         return null;
     }
    
     protected function getByChapterId($seriesId) {
    
         $query = "SELECT * FROM chapter_data WHERE chapter_id = :seriesId";
         $chapterData = Capsule::selectOne($query, ['seriesId' => $seriesId]);

         if (!empty($chapterData)) {
           $row = $chapterData;
           
           $chapter_data = new ChapterData($row->id, $row->chapter_id, $row->content, $row->created_at );
           
           return $chapter_data;
         }
         
         return null;
     }

     // Widget Function
     
     protected function getReq() {
        $reqData = Capsule::table('series_recommendations')
           ->orderBy('order_by', 'ASC')
           ->limit(10)
           ->get();

        $reqs = [];
        
        foreach ($reqData as $row) {
            $metaItem = new SeriesRecommendations( $row->id, $row->series_id, $row->order_by, $row->created_at, $row->updated_at );
            
            $series = $this->getByID($row->series_id);
            $metaItem->setSeries($series);
            
            if (!$series) {
               continue;
            }
            
            $meta = $this->getMetaById($row->series_id);
            $metaItem->setMeta($meta);
            
            $lastch = $this->get1ChaptersBySeriesId($row->series_id);
            $metaItem->setLastch($lastch);
            
            $reqs[] = $metaItem;
        }

         return $reqs;
     }

     protected function getPop() {
         $popData = Capsule::table('series_popular')
           ->orderBy('order_by', 'ASC')
           ->limit(10)
           ->get();

         $reqs = [];
         
         foreach ($popData as $row) {
              $metaItem = new SeriesPopular( $row->id, $row->series_id, $row->order_by, $row->created_at, $row->updated_at);
              
              $series = $this->getByID($row->series_id);
              $metaItem->setSeries($series);
              
              if (!$series) {
                continue;
              }
              
              $meta = $this->getMetaById($row->series_id);
              $metaItem->setMeta($meta);
              
              $lastch = $this->get1ChaptersBySeriesId($row->series_id);
              $metaItem->setLastch($lastch);
              
              $reqs[] = $metaItem;
         }

       return $reqs;
    }

    
     // Views Function
     
     protected function updateSeriesViews($seriesId) {
        Capsule::table('series')
        ->where('id', $seriesId)
        ->update([
            'views_today' => Capsule::raw('views_today + 1'),
            'views_month' => Capsule::raw('views_month + 1'),
            'views_weeks' => Capsule::raw('views_weeks + 1'),
            'views_all' => Capsule::raw('views_all + 1')
        ]);
    }
    
    // Popular Updater Function
    
    public function updateSeriesRecommendations()  {
        $series = $this->fetchAllSeries();

        if (count($series) > 0) {
            foreach ($series as $row) {
              $this->updateSeriesRecommendation($row->id);
            }
        }

        $this->deleteExcessSeriesRecommendations();
    }    

    protected function fetchAllSeries() {
        $series = Capsule::table('series')->where('status', 'publish')->get();
        return $series;
    }

    protected function updateSeriesRecommendation($series_id) {
        $this->updateSeriesRecommendationTable($series_id);
        $this->insertSeriesRecommendation($series_id);
        $this->updateSeriesRecommendationOrder();
    }

    protected function updateSeriesRecommendationTable($series_id) {
        $updateQuery = "UPDATE series_recommendations
                    SET order_by = (SELECT COUNT(*) FROM series WHERE views_today >= (SELECT views_today FROM series WHERE id = :series_id) AND status = 'publish') + 1,
                    updated_at = CURRENT_TIMESTAMP
                    WHERE series_id = :series_id2";
       Capsule::update($updateQuery, ['series_id' => $series_id, 'series_id2' => $series_id]); 

    }

    protected function insertSeriesRecommendation($series_id) {
        $insertQuery = "INSERT INTO series_recommendations (series_id, order_by, created_at, updated_at)
                    SELECT :series_id, 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
                    FROM dual
                    WHERE NOT EXISTS (
                        SELECT * FROM series_recommendations WHERE series_id = :series_id2
                    )";

        Capsule::insert($insertQuery, ['series_id' => $series_id, 'series_id2' => $series_id]);

    }

    protected function updateSeriesRecommendationOrder() {
        $updateOrderQuery = "UPDATE series_recommendations sr
                        INNER JOIN (
                            SELECT series_id, @row_number := @row_number + 1 AS order_by
                            FROM series_recommendations, (SELECT @row_number := 0) AS rn
                            WHERE series_id IN (SELECT id FROM series)
                            ORDER BY (SELECT views_today FROM series WHERE id = series_id) DESC
                        ) subquery ON sr.series_id = subquery.series_id
                        SET sr.order_by = subquery.order_by";

       Capsule::update(Capsule::raw($updateOrderQuery));

    }

    protected function deleteExcessSeriesRecommendations() {
        $deleteQuery = "DELETE FROM series_recommendations WHERE order_by > 10";
        Capsule::delete(Capsule::raw($deleteQuery));
    }

    public function popularSeriesRecommendations() {
        $series = $this->fetchAllSeries();

        if (count($series) > 0) {
            foreach ($series as $row) {
                $this->popularSeriesRecommendation($row->id);
            }
        }

        $this->deleteExcessSeriesPopular();
    }    

    protected function popularSeriesRecommendation($series_id) {
        $this->updatePopularSeriesRecommendationTable($series_id);
        $this->insertPopularSeriesRecommendation($series_id);
        $this->updatePopularSeriesRecommendationOrder();
    }

    protected function updatePopularSeriesRecommendationTable($series_id) {
        $updateQuery = "UPDATE series_popular
                    SET order_by = (SELECT COUNT(*) FROM series WHERE views_month >= (SELECT views_month FROM series WHERE id = :series_id AND status = 'publish')) + 1,
                        updated_at = CURRENT_TIMESTAMP
                    WHERE series_id = :series_id2";

        Capsule::update($updateQuery, ['series_id' => $series_id, 'series_id2' => $series_id]);
    }

    protected function insertPopularSeriesRecommendation($series_id) {
        $insertQuery = "INSERT INTO series_popular (series_id, order_by, created_at, updated_at)
                    SELECT :series_id, 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
                    FROM dual
                    WHERE NOT EXISTS (
                        SELECT * FROM series_popular WHERE series_id = :series_id2
                    )";

       Capsule::insert($insertQuery, ['series_id' => $series_id, 'series_id2' => $series_id]);

    }

    protected function updatePopularSeriesRecommendationOrder() {
         $updateOrderQuery = "UPDATE series_popular sr
                INNER JOIN (
                    SELECT series_id, @row_number := @row_number + 1 AS order_by
                    FROM series_popular, (SELECT @row_number := 0) AS rn
                    WHERE series_id IN (SELECT id FROM series)
                    ORDER BY (SELECT views_today FROM series WHERE id = series_id) DESC
                ) subquery ON sr.series_id = subquery.series_id
                SET sr.order_by = subquery.order_by";

        Capsule::update(Capsule::raw($updateOrderQuery));
    }

    protected function deleteExcessSeriesPopular() {
        $deleteQuery = "DELETE FROM series_popular WHERE order_by > 10";
        Capsule::delete(Capsule::raw($deleteQuery));
    }
    
    // License Function
    
    protected function activateLicense($licenseKey) {
      if (!isset($_POST['licenseKey'])) {
        $error = ['error' => 'License key is required.'];
        header('Content-Type: application/json');
        echo json_encode($error);
        exit;
      }
      
      $licenseActivationUrl = 'https://kaitosaikyo.my.id/api/activating';
      $domain = $_SERVER['HTTP_HOST'];
      
      $urlWithParams = $licenseActivationUrl . '?slm_action=slm_activate&secret_key=641806a4405659.48250412&license_key=' . urlencode($licenseKey) . '&registered_domain=' . urlencode($domain);
      
      $ch = curl_init($urlWithParams);
      
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      
      $response = curl_exec($ch);
      
      if ($response === false) {
        $error = ['error' => curl_error($ch)];
        curl_close($ch);
        header('Content-Type: application/json');
        echo json_encode($error);
        exit;
      } else {
        $responseData = json_decode($response, true);
        if ($responseData['result'] === 'success') {
            $this->config->update_option('activate', true);
            $this->config->update_option('license', $licenseKey);
            $this->config->update_option('site_domain', $this->getBaseUrl());
            
            curl_close($ch);

            header('Content-Type: application/json');
            echo $response;
            exit;
        } else {
            $error = ['error' => 'License activation failed.'];
            curl_close($ch);
            header('Content-Type: application/json');
            echo json_encode($error);
            exit;
        }
      }
    }


    public function checkLicense() {
    
       $licenseActivationUrl = 'https://kaitosaikyo.my.id/api/activating';
       $domain = $_SERVER['HTTP_HOST'];
       
       $urlWithParams = $licenseActivationUrl . '?slm_action=slm_check&secret_key=641806a4405659.48250412&license_key=' . urlencode($this->license);
       
       $ch = curl_init($urlWithParams);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       
       $response = curl_exec($ch);
       
       $error = curl_error($ch);
       curl_close($ch);
       
       if ($error) {
          $errorResponse = ['error' => $error];
       } else {
          $responseData = json_decode($response, true);
          $registeredDomains = array_column($responseData['registered_domains'], 'registered_domain');
          
          if (in_array($domain, $registeredDomains) && $responseData['status'] === 'active') {
             $this->config->update_option('activate', true);
             $this->config->update_option('license', $this->license);
          } else {
             $this->config->update_option('activate', false);
             $this->config->update_option('license', '0');
          }
       }
    }   
    
    // Auth Function
    
    protected function showLogin() {
        if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
            header('Location: /' . DASHBOARD_URL);
            exit();
        } else {
            $this->viewAuth('login', ['error' => '']);
        }
    }
    
    protected function logout() {
       if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
            session_unset();
            session_destroy();
            header('Location: /' . LOGIN_URL);
            exit();
        } else {
            $this->view('404');
            exit();
        }
    }
    
    protected function login() {
      if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $domain = $_SERVER['HTTP_HOST'];
        $license = $this->license;
        
        $curl = curl_init();

        $url = 'https://kaitosaikyo.my.id/wp-json/custom/v1/login';
        $data = array(
            'username' => $username,
            'password' => $password,
            'license' => $license,
            'domain' => $domain
        );

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        curl_close($curl);
        
        $responseData = json_decode($response, true);
        

        if ($httpCode == 200) {
            
            $_SESSION['username'] = $responseData['user_name'];
            $_SESSION['email'] = $responseData['user_email'];
            $_SESSION['pass'] = $responseData['user_pass'];
            $_SESSION['roles'] = $responseData['user_roles'];
            $_SESSION['license'] = $responseData['license'];
            $_SESSION['authenticated'] = true;
            
            $this->viewAuth('redirect');
            
            exit();
        } else {
            $error = $responseData['message'] ?? 'Ada Error Saat Melakukan Login';
            $this->viewAuth('login', ['error' => $error]);
        }
      } else {
        $error = 'Username dan password diperlukan';
        $this->viewAuth('login', ['error' => $error]);
      }
   }
   
   // Scraping Function
   
   protected function getMangaList() {
       $url = "https://api-jr.kaitosaikyo.my.id/tools/list?apikey=" . $this->license . "&link=https://komikcast.io"; 
       $response = file_get_contents($url);
       $data = json_decode($response, true);
       return $data['result'] ?? [];
    }

    public function singleAddPost() {
       $link = $_POST['link'];
       $images = isset($_POST['images']) && !empty($_POST['images']) ? base64_encode($_POST['images']) : 'num';
       $author = isset($_POST['author']) && !empty($_POST['author']) ? base64_encode($_POST['author']) : 'num';
       $artist = isset($_POST['artist']) && !empty($_POST['artist']) ? base64_encode($_POST['artist']) : 'num';
       $genres = isset($_POST['genres']) && !empty($_POST['genres']) ? base64_encode($_POST['genres']) : 'num';
       $release = isset($_POST['release']) && !empty($_POST['release']) ? base64_encode($_POST['release']) : 'num';
       $status = isset($_POST['status']) && !empty($_POST['status']) ? base64_encode($_POST['status']) : 'num';

       if (!isset($link)) {
          throw new Exception('Link is required.');
       }

       $this->runScrapingJob($link, $images, $author, $artist, $genres, $release, $status);
    }

    public function adsSeriesBulkPost() {
    if (isset($_POST['link'])) {
      $links = explode("\n", $_POST['link']);
      foreach ($links as $link) {
         $link = trim($link);
         
         if (!empty($link)) {
            $this->runScrapingJob($link, 'num', 'num', 'num', 'num', 'num', 'num');
            sleep(30);
         }
      }
    } 
    }

    public function checkAndCrawlManga(){
    $mangaList = $this->getMangaList();
    $file = __DIR__ . "/../../manga_list.txt"; 

    if (!file_exists($file)) {
        foreach ($mangaList as $manga) {
            $link = $manga['link'];
            $this->runScrapingJob($link, 'num', 'num', 'num', 'num', 'num', 'num');
            
            sleep(10);
        }

        $this->saveMangaList($mangaList);
        return;
    }

    $oldMangaList = json_decode(file_get_contents($file), true);

    $newMangaList = array_filter($mangaList, function ($manga) use ($oldMangaList) {
        return !in_array($manga['link'], array_column($oldMangaList, 'link'));
    });

    if (!empty($newMangaList)) {
        foreach ($newMangaList as $manga) {
            $link = $manga['link'];
            $this->runScrapingJob($link, null, null, null, null, null, null);
            sleep(10);
        }
        $this->saveMangaList($mangaList);
    }
   }
   
    /**
     * Run the scraping job using a provided script with given parameters.
     *
     * @param string $link
     * @param string $images
     * @param string $author
     * @param string $artist
     * @param string $genres
     * @param string $release
     * @param string $status
     *
     * @return array Associative array containing the process information and output.
     *               Format: ['process' => resource|null, 'pipes' => array|null, 'isRunning' => bool, 'output' => string]
     */
     
    public function runScrapingJob($link, $images, $author, $artist, $genres, $release, $status): array {
        $scriptPath = __DIR__ . "/../scraping_script.php";
        $command = "php8.1 " . $scriptPath . " " . $link . " " . $images . " " . $author . " " . $artist . " " . $genres . " " . $release . " " . $status . " > /dev/null 2>&1";

        try {
            $process = proc_open($command, [0 => ['pipe', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes);

            if (is_resource($process)) {
                return [
                    'process' => $process,
                    'pipes' => $pipes,
                    'isRunning' => true,
                    'output' => ''
                ];
            } else {
                throw new Exception("proc_open failed");
            }
        } catch (Exception $e) {
            try {
                $returnValue = null;
                $output = [];
                exec($command, $output, $returnValue);

                if ($returnValue === 0) {
                    return [
                        'process' => null,
                        'pipes' => null,
                        'isRunning' => false,
                        'output' => implode("\n", $output)
                    ];
                } else {
                    throw new Exception("exec failed");
                }
            } catch (Exception $e) {
                $this->executeBashScript($command);
            }
        }
    }

    /**
     * Execute a Bash script to run a command.
     *
     * @param string $command The command to be executed.
     * @return void
     */
     
    private function executeBashScript(string $command): void {
        $scriptContent = "#!/bin/bash\n$command";
        
        $bashCommand = "bash -s << 'END'\n$scriptContent\nEND";
        
        exec($bashCommand);
    }
    
    /** Scraping Create Function **/
    
    /**
     * Execute a Function to create series 
     *
     * @params string $imafe and $title
     * @return $seriesId
     */
     
    protected function createSeries($image, $title) {
        $view = '0';
        
        $postn = Helper::slugify($title);
        $uniqueCode = substr(uniqid(), -5);
        $postname = $uniqueCode . '-' . $postn;
        
        $gmtTime = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
        $time = $gmtTime->format('Y-m-d H:i:s');
        
        $seriesId = Capsule::table('series')->insertGetId([
            'postname' => $postname,
            'status' => 'publish',
            'image' => $image,
            'title' => $title,
            'views_weeks' => $view,
            'views_month' => $view,
            'views_all' => $view,
            'created_at' => $time,
            'updated_at' => $time,
        ]);
        
        return $seriesId;
    }
    
    /**
     * Execute a Function to create meta series 
     *
     * @params string $seriesId and $seriesMeta
     * @return void
     */
     
    protected function createMeta($seriesId, $seriesMeta) {
        Capsule::table('series_meta')->insert([
            'series_id' => $seriesId,
            'alternatif' => $seriesMeta['alternatif'],
            'released' => $seriesMeta['release'],
            'author' => $seriesMeta['author'],
            'artist' => $seriesMeta['artist'],
            'type' => $seriesMeta['type'],
            'rating' => $seriesMeta['rating'],
            'status' => $seriesMeta['status'],
            'deskripsi' => $seriesMeta['deskripsi'],
        ]);
    }
    
    /**
     * Execute a Function to create chapter 
     *
     * @params string $seriesId and $chapterName
     * @return $chapterId
     */
     
    protected function createChapter($seriesId, $chapterTitle) {
        $postn = Helper::slugify($chapterTitle);
        
        $gmtTime = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
        $time = $gmtTime->format('Y-m-d H:i:s');
        
        $chapterId = Capsule::table('chapter')->insertGetId(['series_id' => $seriesId, 'postname' => $postn, 'title' => $chapterTitle, 'created_at' => $time ]);
    
        return $chapterId;
    }
    
    /**
     * Execute a Function to create chapter data
     *
     * @params string $chapterid and $chapterData
     * @return void
     */
     
    protected function createChapterData($chapterId, $chapterData) {
        $query = "INSERT INTO chapter_data (chapter_id, content, created_at)
              VALUES (:chapter_id, :content, :createAt)";
    
        Capsule::table('chapter_data')->insert(['chapter_id' => $chapterId,'content' => $chapterData['content'],'created_at' => $this->time]);
    }
    
    protected function updateDataSeries($seriesId) {
       $gmtTime = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
       $time = $gmtTime->format('Y-m-d H:i:s');
       
       Capsule::table('series')->where('id', $seriesId)->update(['updated_at' => $time]);
    }

    protected function saveMangaList($mangaList) {
        $file = __DIR__ . "/../../manga_list.txt";  
        file_put_contents($file, json_encode($mangaList));
    }
    
    protected function genresSet($seriesId, $genreName) {
        $postn = Helper::slugify($genreName);
        
        $checkResult = Capsule::table('series_genre')->select('id')->where('title', $genreName)->get();
        
        if ($checkResult->count() > 0) {
            $genreId = $checkResult[0]->id;
        } else {
            $genreId = Capsule::table('series_genre')->insertGetId(['title' => $genreName, 'postname' => $postn]);
        }
        
        Capsule::table('genres')->insert(['series_id' => $seriesId, 'genre_id' => $genreId]);
     }
    
    // core license function
    
    public function scrape($link, $datas) {
    
       $apiUrl = "https://api-jr.kaitosaikyo.my.id/tools/detail?apikey=" . $this->license . "&link=" . urlencode($link);
       
       $images = isset($datas['images']) ? ($datas['images'] === 'num' ? null : base64_decode($datas['images'])) : null;
       $author = isset($datas['author']) ? ($datas['author'] === 'num' ? null : base64_decode($datas['author'])) : null;
       $artist = isset($datas['artist']) ? ($datas['artist'] === 'num' ? null : base64_decode($datas['artist'])) : null;
       $genres = isset($datas['genres']) ? ($datas['genres'] === 'num' ? null : base64_decode($datas['genres'])) : null;
       $release = isset($datas['release']) ? ($datas['release'] === 'num' ? null : base64_decode($datas['release'])) : null;
       $status = isset($datas['status']) ? ($datas['status'] === 'num' ? null : base64_decode($datas['status'])) : null;

       if ($images !== null && (strpos($images, 'https://') !== 0 && strpos($images, 'http://') !== 0)) {
          $images = null;
        }
        
        $response = $this->curlGet($apiUrl);
        
        if ($response) {
            $data = json_decode($response, true);
            
            if ($data && isset($data['status']) && $data['status'] === 200) {
                $seriesTitle = $data['result']['title'];
                $existingSeriesId = $this->checkExistingSeries($seriesTitle);
                
                if ($existingSeriesId) {
                    $this->logMessage($seriesTitle . " Sudah Ada");
                    $seriesId = $existingSeriesId;
                } else {
                    $seriesImage = $images ?? $data['result']['cover'] ?? 'nope';
                    $postnames = Helper::slugify($seriesTitle);
                    $filename = basename($seriesImage);
                    $totalimages = '/public/thumbnail/' . $postnames . '/' . $filename;
                    $pathFolder = $this->mydirectory . $totalimages;
                    
                    if (!file_exists(dirname($pathFolder))) {
                       mkdir(dirname($pathFolder), 0777, true);
                    }
                    
                    $images = SITE_DOMAIN . $totalimages;
                     
                    try {
                       if ($this->downloadImage($seriesImage, $pathFolder)) {
                         echo "Gambar berhasil diunduh dan disimpan di " . $pathFolder . "\n";
                       } else {
                         $images = $seriesImage;
                         echo "Gagal menyimpan gambar. Menggunakan URL gambar sebagai alternatif.\n";
                         echo "URL gambar: " . $images . "\n";
                       }
                    } catch (Exception $e) {
                       $images = $seriesImage; 
                       echo "Gagal mengunduh gambar: " . $e->getMessage() . "\n";
                    }
                    
                    $this->logMessage($seriesTitle . " Belum Ada");
                    
                    $seriesId = $this->createSeries($images, $seriesTitle);
                    $existingMeta = $this->getExistingMeta($seriesId);
                    
                    if ($existingMeta) {
                        $seriesMeta = $existingMeta;
                    } else {
                        $seriesMeta = $this->buildSeriesMeta($data['result'], $author, $artist, $release, $status);
                        $this->createMeta($seriesId, $seriesMeta);
                    }
                    
                    $datagenre = $data['result']['genres'];
                    
                    foreach($datagenre as $genre) {
                        $this->genresSet($seriesId, $genre);
                    }
                }
                
                $chapterList = $data['result']['chapterList'];
                foreach ($chapterList as $chapter) {
                    $chapterTitle = $chapter['title'];
                    $existingChapterId = $this->checkExistingChapter($seriesId, $chapterTitle);
                    
                    if (!$existingChapterId) { 
                        echo "--> Crawl " . $chapterTitle . "\n";

                        $this->logMessage($chapterTitle . " Belum Ada");
                        $chapterId = $this->createChapter($seriesId, $chapterTitle);
                        
                        $chapterImages = $this->scrapeChapterImages($chapter['url']);
                        $chapterData = [
                            'content' => $chapterImages
                        ];
                        
                        $this->updateDataSeries($seriesId);
                        $this->createChapterData($chapterId, $chapterData);
                    } else {
                        $this->logMessage($chapterTitle . " Sudah Ada");
                    }
                }
                
                $dataSeries = $this->getSeriesName($seriesId);
                $keyCache = md5(SERIES_LINK . '/' .  $dataSeries->getLink());
                
                $this->deleteHomeCache();
                $this->deleteCache($keyCache);
            }
        }
    }
    
    protected function scrapeChapterImages($chapterUrl) {
       $apiUrl = "https://api-jr.kaitosaikyo.my.id/tools/chapter?apikey=" .  $this->license . "&link=" . urlencode($chapterUrl);
       
       $response = $this->curlGet($apiUrl);
       
       $data = json_decode($response, true);
       
       if ($data && isset($data['status']) && $data['status'] === 200) {
          $chapterImages = $data['result'];
          
          $imageUrls = array(); 
          
          foreach ($chapterImages as $image) {
            $imageUrl = $image['download_url'];
            $imageUrls[] = ["image" => $imageUrl];
          }
          
          return json_encode($imageUrls);
       } 
       return "[]"; 
    }
    
    protected function getExistingMeta($seriesId) {
       $metaQuery = "SELECT * FROM series_meta WHERE series_id = :id";
       
       $row = Capsule::selectOne($metaQuery, ['id' => $seriesId]);
       
       if ($row) {
          return [
            'alternatif' => $row->alternatif,
            'release' => $row->release_date,
            'author' => $row->author,
            'artist' => $row->artist,
            'rating' => $row->rating,
            'status' => $row->status,
            'deskripsi' => $row->deskripsi,
            'type' => $row->type
          ];
       }
       return false;
    }
    
    protected function buildSeriesMeta($result, $author, $artist, $release, $status2) {
    
       $alternatif = isset($result['originTitle']) ? $result['originTitle'] : '';
       $release = ($release !== null && isset($result['release'])) ? $release : $result['release'];
       $author = ($author !== null && isset($result['authors'])) ? implode(", ", (array)$author) : implode(", ", $result['authors']);
       $artist = ($artist !== null && isset($result['artists'])) ? implode(", ", (array)$artist) : implode(", ", $result['artists']);
       $rating = mt_rand(30, 45) / 10.0;
       $rating = number_format($rating, 1);
       $status = $status2 ?? 'Ongoing';
       $deskripsi = isset($result['description']) ? $result['description'] : '';
       $type = isset($result['MangaType']) ? $result['MangaType'] : '';
    
       $meta = [
         'alternatif' => $alternatif,
         'release' => $release,
         'author' => $author,
         'artist' => $artist,
         'rating' => $rating,
         'status' => $status,
         'deskripsi' => $deskripsi,
         'type' => $type,
       ];
       
       return $meta;
    }

    protected function curlGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        
        return $response;
    }
    
    protected function checkExistingSeries($seriesTitle) {
        $query = "SELECT id FROM series WHERE title = :title";
        $id = Capsule::selectOne($query, ['title' => $seriesTitle]);
        return $id ? $id->id : null;
    }
    
    protected function checkExistingChapter($seriesId, $chapterTitle) {
        $query = "SELECT id FROM chapter WHERE series_id = :series_id AND title = :title";
        $id = Capsule::selectOne($query, ['series_id' => $seriesId, 'title' => $chapterTitle]);
        
        return $id ? $id->id : null;
    }
    
    protected function logMessage($message) {
        $logFile = $this->mydirectory . '/scraper.log';
        $logMessage = "[$this->time] $message" . PHP_EOL;
        file_put_contents($logFile, $logMessage, FILE_APPEND);
    }
    
    // Sitemap
    
    public function indexSitemap() {
        $totalChapter = $this->getTotalChapter();
        $dividedBy2000 = ceil($totalChapter / 2000);

        $sitemapUrls = [];
        $sitemapUrls[] = 'https://' . $_SERVER['HTTP_HOST'] . '/sitemap/series-1.xml';

        for ($i = 1; $i <= $dividedBy2000; $i++) {
           $sitemapUrls[] = 'https://' . $_SERVER['HTTP_HOST'] . '/sitemap/chapter-' . $i . '.xml';
        }

        $indexContent = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $indexContent .= '<?xml-stylesheet type="text/xsl" href="https://' . $_SERVER['HTTP_HOST'] . '/public/assets/main-sitemap.xsl"?>';
        $indexContent .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($sitemapUrls as $sitemapUrl) {
            $indexContent .= '    <sitemap>' . "\n";
            $indexContent .= '        <loc>' . $sitemapUrl . '</loc>' . "\n";
            $indexContent .= '    </sitemap>' . "\n";
        }
        $indexContent .= '</sitemapindex>';
        
        header('Content-Type: application/xml');
        echo $indexContent;

   }
   
    public function seriesSitemap() {
        $series = $this->getSeries();
        $cacheKey = md5($_SERVER['REQUEST_URI']);
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        
        $xml .= '<?xml-stylesheet type="text/xsl" href="https://' . $_SERVER['HTTP_HOST'] . '/public/assets/main-sitemap.xsl"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        if (!empty($series)) {
            foreach ($series as $item) {
                $xml .= '<url>';
                $xml .= '<loc>' . 'https://' . $_SERVER['HTTP_HOST'] . '/' . SERIES_LINK . '/' . $item->getLink() . '</loc>';
                $xml .= '</url>';
            }
        }

        $xml .= '</urlset>';
        
        
       $this->cacheContent($cacheKey, $xml); 
       header('Content-type: text/xml');
       echo $xml;
    }
    
    public function ChapterSitemap($num = 1) {
    
         if (preg_match('/chapter-(\d+)\.xml/', $num, $matches)) { 
             $num = $matches[1];
         }
         
         if ($num === '0') {
             $this->render404();
             exit;
         }
         
         $itemsPerPage = 2000;
         $offset = ($num - 1) * $itemsPerPage;
         
         $cacheKey = md5($_SERVER['REQUEST_URI']);
        
         $chapter = $this->getChapter($offset, $itemsPerPage);
        
         $xml = '<?xml version="1.0" encoding="UTF-8"?>';
         $xml .= '<?xml-stylesheet type="text/xsl" href="/public/assets/main-sitemap.xsl"?>';
         $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
         
         if (!empty($chapter)) {
            foreach ($chapter as $item) {
                $xml .= '<url>';
                $xml .= '<loc>' . 'https://' . $_SERVER['HTTP_HOST'] . '/reading/' . $item->getSeries()->getLink() . '/' . $item->getLink() . '</loc>';
                $xml .= '</url>';
            }
         }

         $xml .= '</urlset>';
         
         $this->cacheContent($cacheKey, $xml); 
         header('Content-type: text/xml');
         echo $xml;
    }
    
    
    public function generateRSSFeed($title) {
    $series = $this->getSeriesByName($title);

    $dom = new \DOMDocument('1.0', 'UTF-8');
    $dom->formatOutput = true;

    $rss = $dom->createElement('rss');
    $rss->setAttribute('version', '2.0');
    $dom->appendChild($rss);

    $rssNamespaces = [
        'content' => 'http://purl.org/rss/1.0/modules/content/',
        'dc' => 'http://purl.org/dc/elements/1.1/',
        'atom' => 'http://www.w3.org/2005/Atom',
        'sy' => 'http://purl.org/rss/1.0/modules/syndication/'
    ];

    foreach ($rssNamespaces as $prefix => $namespace) {
        $rss->setAttribute("xmlns:$prefix", $namespace);
    }

    $channel = $dom->createElement('channel');
    $rss->appendChild($channel);

    $titleElement = $dom->createElement('title', 'Comments on: ' . $series->getTitle());
    $channel->appendChild($titleElement);

    $atomLink = $dom->createElement('atom:link');
    $atomLink->setAttribute('href', 'https://' . $_SERVER['HTTP_HOST'] . '/' . SERIES_LINK . '/' . $series->getLink() . '/feed/');
    $atomLink->setAttribute('rel', 'self');
    $atomLink->setAttribute('type', 'application/rss+xml');
    $channel->appendChild($atomLink);

    $linkElement = $dom->createElement('link', 'https://' . $_SERVER['HTTP_HOST'] . '/' . SERIES_LINK . '/' . $series->getLink());
    $channel->appendChild($linkElement);

    $descriptionElement = $dom->createElement('description', 'Tempatnya Baca Komik Online Bahasa Indonesia');
    $channel->appendChild($descriptionElement);

    $lastBuildDateElement = $dom->createElement('lastBuildDate', gmdate('D, d M Y H:i:s') . ' +0000');
    $channel->appendChild($lastBuildDateElement);

    $updatePeriodElement = $dom->createElement('sy:updatePeriod', 'hourly');
    $channel->appendChild($updatePeriodElement);

    $updateFrequencyElement = $dom->createElement('sy:updateFrequency', '1');
    $channel->appendChild($updateFrequencyElement);

    header('Content-type: application/rss+xml');
    echo $dom->saveXML();
    }
    
    public function generateRSSFeedChapter($title) {
       $series = $this->getSeriesByName($title);
       
       $dom = new \DOMDocument('1.0', 'UTF-8');
       $dom->formatOutput = true;
       
       $rss = $dom->createElement('rss');
       $rss->setAttribute('version', '2.0');
       $dom->appendChild($rss);

    $rssNamespaces = [
        'content' => 'http://purl.org/rss/1.0/modules/content/',
        'dc' => 'http://purl.org/dc/elements/1.1/',
        'atom' => 'http://www.w3.org/2005/Atom',
        'sy' => 'http://purl.org/rss/1.0/modules/syndication/'
    ];

    foreach ($rssNamespaces as $prefix => $namespace) {
        $rss->setAttribute("xmlns:$prefix", $namespace);
    }

    $channel = $dom->createElement('channel');
    $rss->appendChild($channel);

    $titleElement = $dom->createElement('title', 'Comments on: ' . $series->getTitle());
    $channel->appendChild($titleElement);
    
    $linkElement = $dom->createElement('link', 'https://' . $_SERVER['HTTP_HOST'] . '/' . SERIES_LINK . '/' . $series->getLink());
    $channel->appendChild($linkElement);
    
    $descriptionElement = $dom->createElement('description', 'Comments on: ' . $series->getTitle());
    $channel->appendChild($descriptionElement);

    $atomLink = $dom->createElement('atom:link');
    $atomLink->setAttribute('href', 'https://' . $_SERVER['HTTP_HOST'] . '/' . SERIES_LINK . '/' . $series->getLink() . '/feed/');
    $atomLink->setAttribute('rel', 'self');
    $atomLink->setAttribute('type', 'application/rss+xml');
    $channel->appendChild($atomLink);

    foreach ($series->getChapters() as $ch) {
       $item = $dom->createElement('item');
       $channel->appendChild($item);
       
       $title = $dom->createElement('title', $series->getTitle() . ' - ' . $ch->getTitle());
       $item->appendChild($title);

       $link = $dom->createElement('link', 'https://' . $_SERVER['HTTP_HOST'] . '/' . SERIES_LINK . '/' . $series->getLink() . '/' . $ch->getLink());
       $item->appendChild($link);
       
       $guid = $dom->createElement('guid', 'https://' . $_SERVER['HTTP_HOST'] . '/' . SERIES_LINK . '/' . $series->getLink() . '/' . $ch->getLink());
       $item->appendChild($guid);
    }
    
    $lastBuildDateElement = $dom->createElement('lastBuildDate', gmdate('D, d M Y H:i:s') . ' +0000');
    $channel->appendChild($lastBuildDateElement);

    $updatePeriodElement = $dom->createElement('sy:updatePeriod', 'hourly');
    $channel->appendChild($updatePeriodElement);

    $updateFrequencyElement = $dom->createElement('sy:updateFrequency', '1');
    $channel->appendChild($updateFrequencyElement);

    header('Content-type: application/rss+xml');
    echo $dom->saveXML();
    }

    private function getSeries() {
        $query = "SELECT * FROM series WHERE status = 'publish'";
        $seriesData = Capsule::select($query);
        
        $series = []; 
        
        foreach ($seriesData as $row) {
            $seriesItem = new Series($row->id, $row->postname, $row->status, $row->image, $row->title, $row->views_weeks, $row->views_month, $row->views_all, $row->created_at, $row->updated_at );
            $series[] = $seriesItem; 
        }
        
        return $series;
    }
    
    private function getChapter($offset, $item) {
        $series = Capsule::table('chapter')
        ->select('id', 'series_id', 'postname', 'title', 'created_at')
        ->offset($offset)
        ->limit($item)
        ->get()
        ->map(function ($row) {
            $seriesItem = new Chapter(
                $row->id,
                $row->series_id,
                $row->postname,
                $row->title,
                $row->created_at
            );

            $dataseries = $this->getSeriesName($row->series_id);
            $seriesItem->setSeries($dataseries);
            
            return $dataseries ? $seriesItem : null;
        });
        
        $series = $series->filter(function ($item) {
           return $item !== null;
        });

       return $series;
    }
    
    private function getTotalChapter() {
        $query = "SELECT COUNT(*) as total FROM chapter";
        $result = Capsule::selectOne($query);
        return $result->total;
    }
    
    private function getSeriesByName($title) {
        $series = Capsule::table('series')
           ->where('postname', $title)
           ->where('status', 'publish')
           ->first();
           
        if ($series) {
            $seriesItem = new Series($series->id, $series->postname, $series->status, $series->image, $series->title, $series->views_weeks, $series->views_month, $series->views_all, $series->created_at, $series->updated_at );
            
            $chapters = $this->getChaptersBySeriesId($series->id);
            $seriesItem->setChapters($chapters);
            
            return $seriesItem;
        }

      return null;
    }
    
    // Download Function

    protected function downloadImage($imageUrl, $destination) {
        $referralDomain = parse_url($imageUrl, PHP_URL_HOST);
        $userAgent = $this->getRandomUserAgent();
        
        $maxAttempts = 5;
        $attempt = 0;
        
        do {
           $attempt++;
           
           $ch = curl_init($imageUrl);
           curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
           curl_setopt($ch, CURLOPT_REFERER, "https://$referralDomain");
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           $imageData = curl_exec($ch);
           $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
           curl_close($ch);
           
           if ($statusCode === 200) {
              if (file_put_contents($destination, $imageData)) {
                return true;
              } else {
                return false;
              }
           }
        } while ($attempt < $maxAttempts);
        
        return false;
    }

    protected function getRandomUserAgent() {
       $userAgents = array(
          'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36',
          'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:86.0) Gecko/20100101 Firefox/86.0',
          'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.82 Safari/537.36',
          'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0.3 Safari/605.1.15'
       );
       
       $randomIndex = array_rand($userAgents);
       return $userAgents[$randomIndex];
    }
    
    protected function getBaseURL() {
       $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
       $host = $_SERVER['HTTP_HOST'];
       $baseURL = $protocol . $host;

       return $baseURL;
    }
    
    // Data Web
    
    public function updateTodayViewsWeb() {
    
        $gmtTime = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
        
        $currentDate = $gmtTime->format('Y-m-d');
        $currentWeek = $gmtTime->format('W');
        $currentMonth = $gmtTime->format('Y-m');
        $currentHour = $gmtTime->format('H');

        $this->data->update_data('all_views', $this->data->get_data('all_views', '1') + 1);
        
        $this->data->update_data('hourly_views_' . $currentDate . '_' . $currentHour, $this->data->get_data('hourly_views_' . $currentDate . '_' . $currentHour, '1') + 1);

        $lastResetDateToday = $this->data->get_data('last_reset_date_today');
        if ($lastResetDateToday != $currentDate) {
            $this->data->update_data('today_views', '1');
            $this->data->update_data('last_reset_date_today', $currentDate);
        } else {
            $this->data->update_data('today_views', $this->data->get_data('today_views', '1') + 1);
        }

        $lastResetDateWeeks = $this->data->get_data('last_reset_date_weeks');
        if (date('Y-m', strtotime($lastResetDateWeeks)) != $currentMonth) {
            $this->data->update_data('weeks_views', '1');
            $this->data->update_data('last_reset_date_weeks', $currentDate);
        } else {
            $this->data->update_data('weeks_views', $this->data->get_data('weeks_views', '1') + 1);
        }

        $lastResetDateMonth = $this->data->get_data('last_reset_date_month');
        if ($lastResetDateMonth != $currentMonth) {
            $this->data->update_data('month_views', '1');
            $this->data->update_data('last_reset_date_month', $currentMonth);
        } else {
            $this->data->update_data('month_views', $this->data->get_data('month_views', '1') + 1);
        }
    }
    
    private function getIPAddress() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;  
    }
    
    public function updateUserOnlineStatus() {
        $ip = $this->getIPAddress();
        
        $result = Capsule::table('user_online')->where('ip_address', $ip)->first();
        
        if (!$result) {
           Capsule::table('user_online')->insert(['ip_address' => $ip]);
        } else {
           Capsule::table('user_online')->where('ip_address', $ip)->update(['access_count' => Capsule::raw('access_count + 1'), 'last_access' => Capsule::raw('NOW()')]);
        }
        
        Capsule::table('user_online')->whereRaw('DATE_ADD(last_access, INTERVAL 300 SECOND) < NOW()')->delete();
    }

    public function getOnlineUserCount() {
        $onlineUsers = Capsule::table('user_online')->count();
        return $onlineUsers;
    }
    
    public function getTrafficSource($referer) {
    
        $gmtTime = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
        
        $currentDate = $gmtTime->format('Y-m-d');
        $currentWeek = $gmtTime->format('W');
        $currentMonth = $gmtTime->format('Y-m');
        $currentHour = $gmtTime->format('H');

        if ($referer) {
           if (strpos($referer, 'yandex') !== false || strpos($referer, 'yahoo') !== false || strpos($referer, 'bing') !== false || strpos($referer, 'google') !== false) {
               $this->data->update_data('organic_vistor_' . $currentDate, $this->data->get_data('organic_vistor_' . $currentDate, '1') + 1);
           } elseif (strpos($referer, 'linkedin.com') !== false || strpos($referer, 'youtube.com') !== false || strpos($referer, 'tiktok.com') !== false || strpos($referer, 'snapchat.com') !== false || strpos($referer, 'reddit.com') !== false || strpos($referer, 'linkedin.com') !== false || strpos($referer, 'github.com') !== false || strpos($referer, 'telegram.com') !== false || strpos($referer, 'whatsapp.com') !== false || strpos($referer, 't.me') !== false || strpos($referer, 'wa.me') !== false || strpos($referer, 'instagram.com') !== false || strpos($referer, 'twitter.com') !== false || strpos($referer, 'facebook.com') !== false) {
               $this->data->update_data('social_vistor_' . $currentDate, $this->data->get_data('social_vistor_' . $currentDate, '1') + 1);
           } elseif (!empty($referer)) {
               $this->data->update_data('referer_vistor_' . $currentDate, $this->data->get_data('referer_vistor_' . $currentDate, '1') + 1);
           } 
           
        } else {   
            $this->data->update_data('other_vistor_' . $currentDate, $this->data->get_data('other_vistor_' . $currentDate, '1') + 1);
        }
        
    }
   
}

