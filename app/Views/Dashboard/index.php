<?php

$PageTitle = 'Dashboard';
include __DIR__ . '/Partials/header.php';

function formatNumber($number) {
    if ($number >= 1000) {
        return number_format($number / 1000, 2) . 'k';
    } else {
        return $number;
    }
}

?>

                <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-xl">
                        <div class="nk-content-body">
                            <div class="nk-block-head nk-page-head nk-block-head-sm">
                                <div class="nk-block-head-between">
                                    <div class="nk-block-head-content">
                                          <h3 class="nk-block-title page-title">Welcome Back, <?php echo $_SESSION['username'] ?? 'Guest'; ?>!</h3>
                                    </div>
                                </div>
                            </div><!-- .nk-page-head -->
                            <div class="nk-block">
                                <div class="row g-gs">
                                	<div class="col-sm-6 col-xxl-3">
                                        <div class="card card-full bg-danger is-dark">
                                            <div class="card-inner">
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div class="fs-6 text-white text-opacity-75 mb-0">CPU Load</div>
                                                </div>
                                                <h5 class="fs-1 text-white"><div id="cpuLoad">0.0</div></h5>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-sm-6 col-xxl-3">
                                        <div class="card card-full bg-info is-dark">
                                            <div class="card-inner">
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div class="fs-6 text-white text-opacity-75 mb-0">User Online </div>
                                                </div>
                                                <h5 class="fs-1 text-white"><div id="userOnline">0 <small class="fs-3">User (Average)</small></div></h5>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->	
                                    <div class="col-sm-6 col-xxl-3">
                                        <div class="card card-full bg-primary">
                                            <div class="card-inner">
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div class="fs-6 text-white text-opacity-75 mb-0">Series Available</div>
                                                    
                                                </div>
                                                <h5 class="fs-1 text-white"><div id="seriesCount">0 <small class="fs-3">Series</small></div></h5>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-sm-6 col-xxl-3">
                                        <div class="card card-full bg-warning is-dark">
                                            <div class="card-inner">
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div class="fs-6 text-white text-opacity-75 mb-0">Chapter Available</div>
                                                </div>
                                                <h5 class="fs-1 text-white"><div id="chapterCount">0 <small class="fs-3">Chapter</small></h5>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                </div><!-- .row -->
                            </div><!-- .nk-block -->
                            <div class="nk-block-head">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Analysis Website</h4>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            
                            	<div class="nk-block">
                                <div class="row g-gs">
                            	<div class="col-md-6 col-lg-5">
                                        <div class="card h-100">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start pb-3 g-2">
                                                    <div class="card-title card-title-sm">
                                                        <h6 class="title">Views Analysis</h6>
                                                        <p>How do your users visited in the time.</p>
                                                    </div>
                                                    <div class="card-tools">
                                                        <em class="card-hint icon ni ni-help" data-bs-toggle="tooltip" data-bs-placement="left" title="Users of this month"></em>
                                                    </div>
                                                </div> 
                                                <div class="analytic-au">
                                                    <div class="analytic-data-group analytic-au-group">
                                                        <div class="analytic-data analytic-au-data">
    <div class="title">Monthly</div>
    <div class="amount"><?php echo formatNumber($this->data->get_data('month_views', '1')); ?></div>
</div>
<div class="analytic-data analytic-au-data">
    <div class="title">Weekly</div>
    <div class="amount"><?php echo formatNumber($this->data->get_data('weeks_views', '1')); ?></div>
</div>
<div class="analytic-data analytic-au-data">
    <div class="title">Today (Avg)</div>
    <div class="amount"><div id="todayVistor">0</div></div>
</div>
                                                    </div>
                                                    <div class="analytic-au-ck">
                                                        <canvas class="analytics-au-chart" id="analyticAuData"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                        	
                                    	
                    <div class="col-sm-6 col-lg-4">
                                        <div class="card h-100">
                                            <div class="card-inner">
                                                <div class="card-title-group">
                                                    <div class="card-title card-title-sm">
                                                        <h6 class="title">Traffic Channel</h6>
                                                    </div>
                                                </div>
                                                <div class="traffic-channel">
                                                    <div class="traffic-channel-doughnut-ck">
                                                        <canvas class="analytics-doughnut" id="TrafficChannelDoughnutData"></canvas>
                                                    </div>
                                                    <div class="traffic-channel-group g-2">
                                                        <div class="traffic-channel-data">
                                                            <div class="title"><span class="dot dot-lg sq" data-bg="#9cabff"></span><span>Organic Search</span></div>
                                                            <div class="amount"><div id="trafik_organic"></div></div>
                                                        </div>
                                                        <div class="traffic-channel-data">
                                                            <div class="title"><span class="dot dot-lg sq" data-bg="#b8acff"></span><span>Social Media</span></div>
                                                            <div class="amount"><div id="trafik_sosial"></div></div>
                                                        </div>
                                                        <div class="traffic-channel-data">
                                                            <div class="title"><span class="dot dot-lg sq" data-bg="#ffa9ce"></span><span>Referrals</span></div>
                                                            <div class="amount"><div id="trafik_referall"></div></div>
                                                        </div>
                                                        <div class="traffic-channel-data">
                                                            <div class="title"><span class="dot dot-lg sq" data-bg="#f9db7b"></span><span>Others</span></div>
                                                            <div class="amount"><div id="trafik_other"></div></div>
                                                        </div>
                                                    </div><!-- .traffic-channel-group -->
                                                </div><!-- .traffic-channel -->
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->                	
                                    	
                        </div></div></div>
                    </div>
                </div>
                <!-- content @e -->

<div class="nk-footer">
                    <div class="container-xl wide-xl">
                                    <div class="nk-block-content text-center text-lg-left">
                                        <p class="text-soft">&copy; 2023 Kaito Saikyo. All Rights Reserved.</p>
                                    </div>
                        </div>
                    </div>
                </div>
                
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    
    <script src="/public/assets/js/bundle.js?ver=3.2.0"></script>
    <script src="/public/assets/js/scripts.js?ver=3.2.0"></script>
    <script src="/public/assets/js/script.js"></script>
    <script src="/public/assets/js/libs/jqvmap.js?ver=3.2.0"></script>
    <!--<script src="/public/assets/js/charts/gd-analytics.js?ver=3.2.0"></script>-->
<?php

$gmtTime = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
$currentDate = $gmtTime->format('Y-m-d');
$currentWeek = $gmtTime->format('W');
$currentMonth = $gmtTime->format('Y-m');
$currentHour = $gmtTime->format('H');
        
$pageViewsData = array();
for ($i = 0; $i < 24; $i++) {
    $currentHour = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
    $pageViewsData[] = $this->data->get_data('hourly_views_' . $currentDate . '_' . substr($currentHour, 0, 2), '0');

}

// Mengubah data menjadi format JSON
$pageViewsJSON = json_encode($pageViewsData);
 

?>
	
	
	
<script>
	
function formatNumber(number) {
    if (number >= 1000) {
        return (number / 1000).toFixed(2) + 'k';
    } else {
        return number.toString();
    }
}

var TrafficChannelDoughnutData = {
    labels: ["Organic Search", "Social Media", "Referrals", "Others"],
    dataUnit: 'People',
    legend: false,
    datasets: [{
        borderColor: "#fff",
        background: ["#733AEA", "#b8acff", "#ffa9ce", "#f9db7b"],
        data: []
    }]
};

var temporaryData1 = 1;
var temporaryData2 = 1;
var temporaryData3 = 1;
var temporaryData4 = 1;

$(document).ready(function() {
    setInterval(function() {
        $.ajax({
            url: '/dashboard/api/status',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#cpuLoad').html(response.cpuLoad + ' <small class="fs-3">Average</small>');
                $('#userOnline').html(formatNumber(response.userOnline) + ' <small class="fs-3">User</small>');
                $('#seriesCount').html(formatNumber(response.seriesCount) + ' <small class="fs-3">Series</small>');
                $('#chapterCount').html(formatNumber(response.chapterCount) + ' <small class="fs-3">Chapter</small>');
                $('#todayVistor').html(formatNumber(response.totalViews));

                $('#trafik_organic').html(formatNumber(response.today_trafik_organic));
                $('#trafik_sosial').html(formatNumber(response.today_trafik_social));
                $('#trafik_referall').html(formatNumber(response.today_trafik_referall));
                $('#trafik_other').html(formatNumber(response.today_trafik_other));

                // Mengubah data TrafficChannelDoughnutData saat permintaan Ajax berhasil
                TrafficChannelDoughnutData.datasets[0].data = [
                    response.today_trafik_organic,
                    response.today_trafik_social,
                    response.today_trafik_referall,
                    response.today_trafik_other
                ];
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }, 1000);
});

var analyticAuData = {
    labels: [],
    dataUnit: 'Page Views',
    lineTension: .1,
    datasets: [{
        label: "Page Views",
        color: "#9C73F5",
        background: "#9C73F5",
        data: [] 
    }]
};

function updateAnalyticAuData() {
    var labels = [];
    var pageViews = <?php echo $pageViewsJSON ?>; 

    for (var i = 0; i < 24; i++) {
        var currentHour = i.toString().padStart(2, '0') + ':00'; // Format jam (misal: "00:00", "01:00", "02:00", ...)

        labels.push(currentHour); // Tambahkan label jam ke array labels
    }

    analyticAuData.labels = labels;
    analyticAuData.datasets[0].data = pageViews;
}

updateAnalyticAuData();

function analyticsAu(selector, set_data) {
    var selectors = selector ? document.querySelectorAll(selector) : document.querySelectorAll('.analytics-au-chart');
    selectors.forEach(function(element) {
        var self = element;
        var selfId = self.getAttribute('id');
        var getData = typeof set_data === 'undefined' ? analyticAuData : set_data;
        var selectCanvas = document.getElementById(selfId).getContext("2d");
        var chartData = [];
        for (var i = 0; i < getData.datasets.length; i++) {
            chartData.push({
                label: getData.datasets[i].label,
                tension: getData.lineTension,
                backgroundColor: getData.datasets[i].background,
                borderWidth: 2,
                borderColor: getData.datasets[i].color,
                data: getData.datasets[i].data,
                barPercentage: .7,
                categoryPercentage: .7
            });
        }
        var chart = new Chart(selectCanvas, {
            type: 'bar',
            data: {
                labels: getData.labels,
                datasets: chartData
            },
            options: {
                legend: {
                    display: false
                },
                maintainAspectRatio: false,
                tooltips: {
                    enabled: true,
                    callbacks: {
                        title: function(tooltipItem, data) {
                            return false;
                        },
                        label: function(tooltipItem, data) {
                            return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']];
                        }
                    },
                    backgroundColor: '#eff6ff',
                    titleFontSize: 9,
                    titleFontColor: '#6783b8',
                    titleMarginBottom: 6,
                    bodyFontColor: '#9eaecf',
                    bodyFontSize: 9,
                    bodySpacing: 4,
                    yPadding: 6,
                    xPadding: 6,
                    footerMarginTop: 0,
                    displayColors: false
                },
                scales: {
                    yAxes: [{
                        display: true,
                        position: "left",
                        ticks: {
                            beginAtZero: false,
                            fontSize: 12,
                            fontColor: '#9eaecf',
                            padding: 0,
                            display: false,
                            stepSize: 300
                        },
                        gridLines: {
                            color: NioApp.hexRGB("#526484", .2),
                            tickMarkLength: 0,
                            zeroLineColor: NioApp.hexRGB("#526484", .2)
                        }
                    }],
                    xAxes: [{
                        display: false,
                        ticks: {
                            fontSize: 12,
                            fontColor: '#9eaecf',
                            padding: 0,
                            reverse: NioApp.State.isRTL
                        },
                        gridLines: {
                            color: "transparent",
                            tickMarkLength: 0,
                            zeroLineColor: 'transparent',
                            offsetGridLines: true
                        }
                    }]
                }
            }
        });
    });
}

function analyticsDoughnut(selector, set_data) {
    var $selector = selector ? $(selector) : $('.analytics-doughnut');
    $selector.each(function() {
        var $self = $(this),
            _self_id = $self.attr('id'),
            _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data;
        var selectCanvas = document.getElementById(_self_id).getContext("2d");
        var chart_data = [];
        for (var i = 0; i < _get_data.datasets.length; i++) {
            chart_data.push({
                backgroundColor: _get_data.datasets[i].background,
                borderWidth: 2,
                borderColor: _get_data.datasets[i].borderColor,
                hoverBorderColor: _get_data.datasets[i].borderColor,
                data: _get_data.datasets[i].data
            });
        }
        var chart = new Chart(selectCanvas, {
            type: 'doughnut',
            data: {
                labels: _get_data.labels,
                datasets: chart_data
            },
            options: {
                legend: {
                    display: _get_data.legend ? _get_data.legend : false,
                    rtl: NioApp.State.isRTL,
                    labels: {
                        boxWidth: 12,
                        padding: 20,
                        fontColor: '#6783b8'
                    }
                },
                rotation: -1.5,
                cutoutPercentage: 70,
                maintainAspectRatio: false,
                tooltips: {
                    enabled: true,
                    rtl: NioApp.State.isRTL,
                    callbacks: {
                        title: function title(tooltipItem, data) {
                            return data['labels'][tooltipItem[0]['index']];
                        },
                        label: function label(tooltipItem, data) {
                            return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
                        }
                    },
                    backgroundColor: '#fff',
                    borderColor: '#eff6ff',
                    borderWidth: 2,
                    titleFontSize: 13,
                    titleFontColor: '#6783b8',
                    titleMarginBottom: 6,
                    bodyFontColor: '#9eaecf',
                    bodyFontSize: 12,
                    bodySpacing: 4,
                    yPadding: 10,
                    xPadding: 10,
                    footerMarginTop: 0,
                    displayColors: false
                }
            }
        });
    });
}

$(document).ready(function() {
    analyticsAu();
    setInterval(function() {
        analyticsDoughnut();
    }, 20000);
    setTimeout(function() {
        analyticsDoughnut();
    }, 3000);
});
 
</script>

</body>

</html>
