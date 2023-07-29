<?php

namespace App\Controllers;


class DashboardController extends CoreController {

    public function index() {
    
       $this->viewDash('index');
    }
    
    public function profile() {
        $this->viewDash('profile');
    }
    
    public function seriesList() {
    
      $series = $this->getSeriesList();
      $seriesCount = $this->seriesCount();
      
      $this->viewDash('series-list', ['series' => $series, 'seriesCount' => $seriesCount]);
    }
    
    public function seriesAdd() {
        $this->viewDash('add-series');
    }
    
    public function seriesAdds() {
        $this->viewDash('add-series-bulk');
    }
    
    public function settingPage() {
        $this->viewDash('setting');
    }
    
    public function analysisPage() {
        $this->viewDash('analysis');
    }
    
    
    
    public function getCpuLoad() {
    
       $gmtTime = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
       $currentDate = $gmtTime->format('Y-m-d');
       
       $load = sys_getloadavg();
       $cpuLoad = $load[0];
       
       $response = array(
        'cpuLoad' => $cpuLoad,
        'seriesCount' => $this->seriesCount(),
        'chapterCount' => $this->chapterCount(),
        'totalViews' => $this->data->get_data('today_views', '0'),
        'userOnline' => $this->getOnlineUserCount(),
        'today_trafik_organic' => $this->data->get_data('organic_vistor_' . $currentDate, '1'),
        'today_trafik_social' => $this->data->get_data('social_vistor_' . $currentDate, '1'),
        'today_trafik_referall' => $this->data->get_data('referer_vistor_' . $currentDate, '1'),
        'today_trafik_other' => $this->data->get_data('other_vistor_' . $currentDate, '1'),
      );

      header('Content-Type: application/json');
      echo json_encode($response);
    }
    
    
}
