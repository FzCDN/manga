<?php

use Symfony\Component\Routing\Route;

use App\Controllers\RouterController;
use App\Controllers\DashboardController;
use App\Controllers\SeriesController;
use App\Controllers\ChapterController;

$router = new RouterController();

// Series List
$router->get('/', [SeriesController::class, 'homepage']);
$router->get('/page/{number}', [SeriesController::class, 'homepage'], ['number' => '\d+']);

// Series Type
$router->get('/type/{type}', [SeriesController::class, 'typeManga']);
$router->get('/type/{type}/page/{number}', [SeriesController::class, 'typeManga'], ['number' => '\d+']);

$router->get('/' . SERIES_LINK . '/{title}/', [SeriesController::class, 'seriesDetail']);
$router->get('/' . SERIES_LINK . '/{title}/edit', [SeriesController::class, 'seriesDetailEdit']);
    
$router->get('/reading/{title}/{chapter}', [SeriesController::class, 'viewChapter']);
$router->get('/reading/{title}/{chapter}/edit', [SeriesController::class, 'ChapterDetailEdit']);
$router->post('/reading/{title}/{chapter}', [SeriesController::class, 'viewChapter']);

// Genres
$router->get('/genre/{title}', [SeriesController::class, 'genreNames']);
$router->get('/genre/{title}/page/{number}', [SeriesController::class, 'genreNames']);

// Dashboard
$router->get('/' . DASHBOARD_URL, [DashboardController::class, 'index']);
$router->get('/' . DASHBOARD_URL . '/profile', [DashboardController::class, 'profile']);

$router->get('/' . DASHBOARD_URL . '/series/list', [DashboardController::class, 'seriesList']);
$router->get('/' . DASHBOARD_URL . '/series/add', [DashboardController::class, 'seriesAdd']);
$router->post('/' . DASHBOARD_URL . '/series/add', [DashboardController::class, 'singleAddPost']);

$router->get('/' . DASHBOARD_URL . '/series/add-bulk', [DashboardController::class, 'seriesAdds']);
$router->post('/' . DASHBOARD_URL . '/series/add-bulk', [DashboardController::class, 'adsSeriesBulkPost']);

$router->get('/' . DASHBOARD_URL . '/setting', [DashboardController::class, 'settingPage']);
$router->post('/' . DASHBOARD_URL . '/setting', [DashboardController::class, 'settingPageConf']);

$router->get('/' . DASHBOARD_URL . '/analysis', [DashboardController::class, 'analysisPage']);

$router->get('/' . DASHBOARD_URL . '/api/status', [DashboardController::class, 'getCpuLoad']);

// Bookmark
$router->get('/bookmark', [SeriesController::class, 'bookMark']);

// Login Logout
$router->get('/'. LOGIN_URL, [DashboardController::class, 'showLogin']);
$router->post('/auth/login', [DashboardController::class, 'login']);

$router->get('/auth/logout', [DashboardController::class, 'logout']);

// Ajax Search And More
$router->post('/admin/ajax', [SeriesController::class, 'ajaxSearch']);

// sitemap && feed
$router->get('/' . SERIES_LINK . '/{title}/feed', [SeriesController::class, 'generateRSSFeed']);
$router->get('/' . SERIES_LINK . '/{title}/feed/chapter', [SeriesController::class, 'generateRSSFeedChapter']);

// sitemap
$router->get('/sitemap/index.xml', [SeriesController::class, 'indexSitemap']);
$router->get('/sitemap/series-1.xml', [SeriesController::class, 'seriesSitemap']);
$router->get('/sitemap/chapter-{num}.xml', [SeriesController::class, 'ChapterSitemap']);

// Api Post
$router->post('/api/series/edit', [SeriesController::class, 'seriesDetailEditPost']);
$router->post('/api/series/chapter/edit', [SeriesController::class, 'seriesEditChapter']);

$router->post('/api/series/views-count', [SeriesController::class, 'seriesViewsCount']);
$router->post('/api/site/analysis', [SeriesController::class, 'postAnalysisPage']);

$router->dispatch();
