<?php

$PageTitle = 'Analysis';
include __DIR__ . '/Partials/header.php';

function formatNumber($number) {
    if ($number >= 1000) {
        return number_format($number / 1000, 2) . 'k';
    } else {
        return $number;
    }
}


?>
	
                <!-- content @s -->
                <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-xl">
                        <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title">Website Analytics</h3>
                                        <div class="nk-block-des text-soft">
                                            <p>Welcome to Analytics Dashboard.</p>
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
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
    <div class="amount"><?php echo formatNumber($this->data->get_data('today_views', '1')); ?></div>
</div>
                                                    </div>
                                                    <div class="analytic-au-ck">
                                                        <canvas class="analytics-au-chart" id="analyticAuData"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-md-6 col-lg-5">
                                        <div class="card h-100">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start pb-3 g-2">
                                                    <div class="card-title card-title-sm">
                                                        <h6 class="title">Website Performance</h6>
                                                        <p>How has performend this month.</p>
                                                    </div>
                                                    <div class="card-tools">
                                                        <em class="card-hint icon ni ni-help" data-bs-toggle="tooltip" data-bs-placement="left" title="Performance of this month"></em>
                                                    </div>
                                                </div>
                                                <div class="analytic-wp">
                                                    <div class="analytic-wp-group g-3">
                                                        <div class="analytic-data analytic-wp-data">
                                                            <div class="analytic-wp-graph">
                                                                <div class="title">Bounce Rate <span>(avg)</span></div>
                                                                <div class="analytic-wp-ck">
                                                                    <canvas class="analytics-line-small" id="BounceRateData"></canvas>
                                                                </div>
                                                            </div>
                                                            <div class="analytic-wp-text">
                                                                <div class="amount amount-sm">23.59%</div>
                                                                <div class="change up"><em class="icon ni ni-arrow-long-up"></em>4.5%</div>
                                                                <div class="subtitle">vs. last month</div>
                                                            </div>
                                                        </div>
                                                        <div class="analytic-data analytic-wp-data">
                                                            <div class="analytic-wp-graph">
                                                                <div class="title">Pageviews <span>(avg)</span></div>
                                                                <div class="analytic-wp-ck">
                                                                    <canvas class="analytics-line-small" id="PageviewsData"></canvas>
                                                                </div>
                                                            </div>
                                                            <div class="analytic-wp-text">
                                                                <div class="amount amount-sm">5.48</div>
                                                                <div class="change down"><em class="icon ni ni-arrow-long-down"></em>-1.48%</div>
                                                                <div class="subtitle">vs. last month</div>
                                                            </div>
                                                        </div>
                                                        <div class="analytic-data analytic-wp-data">
                                                            <div class="analytic-wp-graph">
                                                                <div class="title">New Users <span>(avg)</span></div>
                                                                <div class="analytic-wp-ck">
                                                                    <canvas class="analytics-line-small" id="NewUsersData"></canvas>
                                                                </div>
                                                            </div>
                                                            <div class="analytic-wp-text">
                                                                <div class="amount amount-sm">549</div>
                                                                <div class="change up"><em class="icon ni ni-arrow-long-up"></em>6.8%</div>
                                                                <div class="subtitle">vs. last month</div>
                                                            </div>
                                                        </div>
                                                        <div class="analytic-data analytic-wp-data">
                                                            <div class="analytic-wp-graph">
                                                                <div class="title">Time on Site <span>(avg)</span></div>
                                                                <div class="analytic-wp-ck">
                                                                    <canvas class="analytics-line-small" id="TimeOnSiteData"></canvas>
                                                                </div>
                                                            </div>
                                                            <div class="analytic-wp-text">
                                                                <div class="amount amount-sm">3m 35s</div>
                                                                <div class="change up"><em class="icon ni ni-arrow-long-up"></em>1.4%</div>
                                                                <div class="subtitle">vs. last month</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-lg-7">
                                        <div class="card h-100">
                                            <div class="card-inner mb-n2">
                                                <div class="card-title-group">
                                                    <div class="card-title card-title-sm">
                                                        <h6 class="title">Traffic Channel</h6>
                                                        <p>Top traffic channels metrics.</p>
                                                    </div>
                                                    <div class="card-tools">
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-bs-toggle="dropdown">30 Days</a>
                                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="#"><span>7 Days</span></a></li>
                                                                    <li><a href="#"><span>15 Days</span></a></li>
                                                                    <li><a href="#"><span>30 Days</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nk-tb-list is-loose traffic-channel-table">
                                                <div class="nk-tb-item nk-tb-head">
                                                    <div class="nk-tb-col nk-tb-channel"><span>Channel</span></div>
                                                    <div class="nk-tb-col nk-tb-sessions"><span>Sessions</span></div>
                                                    <div class="nk-tb-col nk-tb-prev-sessions"><span>Prev Sessions</span></div>
                                                    <div class="nk-tb-col nk-tb-change"><span>Change</span></div>
                                                    <div class="nk-tb-col nk-tb-trend tb-col-sm text-end"><span>Trend</span></div>
                                                </div><!-- .nk-tb-head -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col nk-tb-channel">
                                                        <span class="tb-lead">Organic Search</span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-sessions">
                                                        <span class="tb-sub tb-amount"><span>4,305</span></span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-prev-sessions">
                                                        <span class="tb-sub tb-amount"><span>4,129</span></span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-change">
                                                        <span class="tb-sub"><span>4.29%</span> <span class="change up"><em class="icon ni ni-arrow-long-up"></em></span></span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-trend text-end">
                                                        <div class="traffic-channel-ck ms-auto">
                                                            <canvas class="analytics-line-small" id="OrganicSearchData"></canvas>
                                                        </div>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col nk-tb-channel">
                                                        <span class="tb-lead">Social Media</span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-sessions">
                                                        <span class="tb-sub tb-amount"><span>859</span></span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-prev-sessions">
                                                        <span class="tb-sub tb-amount"><span>936</span></span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-change">
                                                        <span class="tb-sub"><span>15.8%</span> <span class="change down"><em class="icon ni ni-arrow-long-down"></em></span></span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-trend text-end">
                                                        <div class="traffic-channel-ck ms-auto">
                                                            <canvas class="analytics-line-small" id="SocialMediaData"></canvas>
                                                        </div>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col nk-tb-channel">
                                                        <span class="tb-lead">Referrals</span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-sessions">
                                                        <span class="tb-sub tb-amount"><span>482</span></span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-prev-sessions">
                                                        <span class="tb-sub tb-amount"><span>793</span></span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-change">
                                                        <span class="tb-sub"><span>41.3%</span> <span class="change down"><em class="icon ni ni-arrow-long-down"></em></span></span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-trend text-end">
                                                        <div class="traffic-channel-ck ms-auto">
                                                            <canvas class="analytics-line-small" id="ReferralsData"></canvas>
                                                        </div>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col nk-tb-channel">
                                                        <span class="tb-lead">Others</span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-sessions">
                                                        <span class="tb-sub tb-amount"><span>138</span></span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-prev-sessions">
                                                        <span class="tb-sub tb-amount"><span>97</span></span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-change">
                                                        <span class="tb-sub"><span>12.6%</span> <span class="change up"><em class="icon ni ni-arrow-long-up"></em></span></span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-trend text-end">
                                                        <div class="traffic-channel-ck ms-auto">
                                                            <canvas class="analytics-line-small" id="OthersData"></canvas>
                                                        </div>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                            </div><!-- .nk-tb-list -->
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="card h-100">
                                            <div class="card-inner h-100 stretch flex-column">
                                                <div class="card-title-group">
                                                    <div class="card-title card-title-sm">
                                                        <h6 class="title">By Device</h6>
                                                    </div>
                                                    <div class="card-tools">
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-bs-toggle="dropdown">30 Days</a>
                                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="#"><span>7 Days</span></a></li>
                                                                    <li><a href="#"><span>15 Days</span></a></li>
                                                                    <li><a href="#"><span>30 Days</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="device-status my-auto">
                                                    <div class="device-status-ck">
                                                        <canvas class="analytics-doughnut" id="deviceStatusData"></canvas>
                                                    </div>
                                                    <div class="device-status-group">
                                                        <div class="device-status-data">
                                                            <em data-color="#798bff" class="icon ni ni-monitor"></em>
                                                            <div class="title">Desktop</div>
                                                            <div class="amount">84.5%</div>
                                                            <div class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.5%</div>
                                                        </div>
                                                        <div class="device-status-data">
                                                            <em data-color="#baaeff" class="icon ni ni-mobile"></em>
                                                            <div class="title">Mobile</div>
                                                            <div class="amount">14.2%</div>
                                                            <div class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>133.2%</div>
                                                        </div>
                                                        <div class="device-status-data">
                                                            <em data-color="#7de1f8" class="icon ni ni-tablet"></em>
                                                            <div class="title">Tablet</div>
                                                            <div class="amount">1.3%</div>
                                                            <div class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>25.3%</div>
                                                        </div>
                                                    </div><!-- .device-status-group -->
                                                </div><!-- .device-status -->
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="card h-100">
                                            <div class="card-inner">
                                                <div class="card-title-group">
                                                    <div class="card-title card-title-sm">
                                                        <h6 class="title">By Country</h6>
                                                    </div>
                                                    <div class="card-tools">
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-bs-toggle="dropdown">30 Days</a>
                                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="#"><span>7 Days</span></a></li>
                                                                    <li><a href="#"><span>15 Days</span></a></li>
                                                                    <li><a href="#"><span>30 Days</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="analytics-map">
                                                    <div class="vector-map" id="worldMap"></div>
                                                    <table class="analytics-map-data-list">
                                                        <tr class="analytics-map-data">
                                                            <td class="country">United States</td>
                                                            <td class="amount">12,094</td>
                                                            <td class="percent">23.54%</td>
                                                        </tr>
                                                        <tr class="analytics-map-data">
                                                            <td class="country">India</td>
                                                            <td class="amount">7,984</td>
                                                            <td class="percent">7.16%</td>
                                                        </tr>
                                                        <tr class="analytics-map-data">
                                                            <td class="country">Turkey</td>
                                                            <td class="amount">6,338</td>
                                                            <td class="percent">6.54%</td>
                                                        </tr>
                                                        <tr class="analytics-map-data">
                                                            <td class="country">Bangladesh</td>
                                                            <td class="amount">4,749</td>
                                                            <td class="percent">5.29%</td>
                                                        </tr>
                                                    </table>
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
                                                    <div class="card-tools">
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-bs-toggle="dropdown">30 Days</a>
                                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="#"><span>7 Days</span></a></li>
                                                                    <li><a href="#"><span>15 Days</span></a></li>
                                                                    <li><a href="#"><span>30 Days</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="traffic-channel">
                                                    <div class="traffic-channel-doughnut-ck">
                                                        <canvas class="analytics-doughnut" id="TrafficChannelDoughnutData"></canvas>
                                                    </div>
                                                    <div class="traffic-channel-group g-2">
                                                        <div class="traffic-channel-data">
                                                            <div class="title"><span class="dot dot-lg sq" data-bg="#9cabff"></span><span>Organic Search</span></div>
                                                            <div class="amount">4,305 <small>58.63%</small></div>
                                                        </div>
                                                        <div class="traffic-channel-data">
                                                            <div class="title"><span class="dot dot-lg sq" data-bg="#b8acff"></span><span>Social Media</span></div>
                                                            <div class="amount">859 <small>23.94%</small></div>
                                                        </div>
                                                        <div class="traffic-channel-data">
                                                            <div class="title"><span class="dot dot-lg sq" data-bg="#ffa9ce"></span><span>Referrals</span></div>
                                                            <div class="amount">482 <small>12.94%</small></div>
                                                        </div>
                                                        <div class="traffic-channel-data">
                                                            <div class="title"><span class="dot dot-lg sq" data-bg="#f9db7b"></span><span>Others</span></div>
                                                            <div class="amount">138 <small>4.49%</small></div>
                                                        </div>
                                                    </div><!-- .traffic-channel-group -->
                                                </div><!-- .traffic-channel -->
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-sm-6 col-lg-5">
                                        <div class="card h-100">
                                            <div class="card-inner mb-n2">
                                                <div class="card-title-group">
                                                    <div class="card-title card-title-sm">
                                                        <h6 class="title">Pages View by Users</h6>
                                                    </div>
                                                    <div class="card-tools">
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-bs-toggle="dropdown">30 Days</a>
                                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="#"><span>7 Days</span></a></li>
                                                                    <li><a href="#"><span>15 Days</span></a></li>
                                                                    <li><a href="#"><span>30 Days</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nk-tb-list is-compact">
                                                <div class="nk-tb-item nk-tb-head">
                                                    <div class="nk-tb-col"><span>Page</span></div>
                                                    <div class="nk-tb-col text-end"><span>Page Views</span></div>
                                                </div><!-- .nk-tb-head -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub"><span>/</span></span>
                                                    </div>
                                                    <div class="nk-tb-col text-end">
                                                        <span class="tb-sub tb-amount"><span>2,879</span></span>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub"><span>/subscription/index.html</span></span>
                                                    </div>
                                                    <div class="nk-tb-col text-end">
                                                        <span class="tb-sub tb-amount"><span>2,094</span></span>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub"><span>/general/index.html</span></span>
                                                    </div>
                                                    <div class="nk-tb-col text-end">
                                                        <span class="tb-sub tb-amount"><span>1,634</span></span>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub"><span>/crypto/index.html</span></span>
                                                    </div>
                                                    <div class="nk-tb-col text-end">
                                                        <span class="tb-sub tb-amount"><span>1,497</span></span>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub"><span>/invest/index.html</span></span>
                                                    </div>
                                                    <div class="nk-tb-col text-end">
                                                        <span class="tb-sub tb-amount"><span>1,349</span></span>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub"><span>/subscription/profile.html</span></span>
                                                    </div>
                                                    <div class="nk-tb-col text-end">
                                                        <span class="tb-sub tb-amount"><span>984</span></span>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub"><span>/general/index-crypto.html</span></span>
                                                    </div>
                                                    <div class="nk-tb-col text-end">
                                                        <span class="tb-sub tb-amount"><span>879</span></span>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub"><span>/apps/messages/index.html</span></span>
                                                    </div>
                                                    <div class="nk-tb-col text-end">
                                                        <span class="tb-sub tb-amount"><span>598</span></span>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <span class="tb-sub"><span>/general/index-crypto.html</span></span>
                                                    </div>
                                                    <div class="nk-tb-col text-end">
                                                        <span class="tb-sub tb-amount"><span>436</span></span>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                            </div><!-- .nk-tb-list -->
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-lg-7">
                                        <div class="card h-100">
                                            <div class="card-inner mb-n2">
                                                <div class="card-title-group">
                                                    <div class="card-title card-title-sm">
                                                        <h6 class="title">Browser Used</h6>
                                                    </div>
                                                    <div class="card-tools">
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-bs-toggle="dropdown">30 Days</a>
                                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="#"><span>7 Days</span></a></li>
                                                                    <li><a href="#"><span>15 Days</span></a></li>
                                                                    <li><a href="#"><span>30 Days</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nk-tb-list is-loose">
                                                <div class="nk-tb-item nk-tb-head">
                                                    <div class="nk-tb-col"><span>Browser</span></div>
                                                    <div class="nk-tb-col text-end"><span>Users</span></div>
                                                    <div class="nk-tb-col"><span>% Users</span></div>
                                                    <div class="nk-tb-col tb-col-sm text-end"><span>Bounce Rate</span></div>
                                                </div><!-- .nk-tb-head -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="icon-text">
                                                            <em class="text-primary icon ni ni-globe"></em>
                                                            <span class="tb-lead">Google Chrome</span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col text-end">
                                                        <span class="tb-sub tb-amount"><span>1,641</span></span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <div class="progress progress-md progress-alt bg-transparent">
                                                            <div class="progress-bar" data-progress="72.84"></div>
                                                            <div class="progress-amount">72.84%</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm text-end">
                                                        <span class="tb-sub">22.62%</span>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="icon-text">
                                                            <em class="text-danger icon ni ni-globe"></em>
                                                            <span class="tb-lead">Mozilla Firefox</span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col text-end">
                                                        <span class="tb-sub tb-amount"><span>497</span></span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <div class="progress progress-md progress-alt bg-transparent">
                                                            <div class="progress-bar" data-progress="7.93"></div>
                                                            <div class="progress-amount">7.93%</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm text-end">
                                                        <span class="tb-sub">20.49%</span>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="icon-text">
                                                            <em class="text-info icon ni ni-globe"></em>
                                                            <span class="tb-lead">Safari Browser</span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col text-end">
                                                        <span class="tb-sub tb-amount"><span>187</span></span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <div class="progress progress-md progress-alt bg-transparent">
                                                            <div class="progress-bar" data-progress="4.87"></div>
                                                            <div class="progress-amount">4.87%</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm text-end">
                                                        <span class="tb-sub">21.34%</span>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="icon-text">
                                                            <em class="text-orange icon ni ni-globe"></em>
                                                            <span class="tb-lead">UC Browser</span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col text-end">
                                                        <span class="tb-sub tb-amount"><span>96</span></span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <div class="progress progress-md progress-alt bg-transparent">
                                                            <div class="progress-bar" data-progress="2.46"></div>
                                                            <div class="progress-amount">2.46%</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm text-end">
                                                        <span class="tb-sub">20.33%</span>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="icon-text">
                                                            <em class="text-blue icon ni ni-globe"></em>
                                                            <span class="tb-lead">Edge / IE</span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col text-end">
                                                        <span class="tb-sub tb-amount"><span>28</span></span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <div class="progress progress-md progress-alt bg-transparent">
                                                            <div class="progress-bar" data-progress="1.14"></div>
                                                            <div class="progress-amount">1.14%</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm text-end">
                                                        <span class="tb-sub">21.34%</span>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="icon-text">
                                                            <em class="text-purple icon ni ni-globe"></em>
                                                            <span class="tb-lead">Other Browser</span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col text-end">
                                                        <span class="tb-sub tb-amount"><span>683</span></span>
                                                    </div>
                                                    <div class="nk-tb-col">
                                                        <div class="progress progress-md progress-alt bg-transparent">
                                                            <div class="progress-bar" data-progress="10.76"></div>
                                                            <div class="progress-amount">10.76%</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-sm text-end">
                                                        <span class="tb-sub">20.49%</span>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                            </div><!-- .nk-tb-list -->
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                </div><!-- .row -->
                            </div><!-- .nk-block -->
                        </div>
                    </div>
                </div>
                <!-- content @e -->
<!-- footer @s -->
	
	
                			
                		
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
  var analyticAuData = {
    labels: [], // Labels untuk setiap jam (misal: ["00:00", "01:00", "02:00", ...])
    dataUnit: 'Page Views',
    lineTension: .1,
    datasets: [{
        label: "Page Views",
        color: "#9C73F5",
        background: "#9C73F5",
        data: [] // Data page views setiap jam (misal: [100, 150, 200, ...])
    }]
  };

  function updateAnalyticAuData() {
    var labels = []; // Labels untuk setiap jam (misal: ["00:00", "01:00", "02:00", ...])
    var pageViews = <?php echo $pageViewsJSON ?>; // Data page views setiap jam (misal: [100, 150, 200, ...])
    
    for (var i = 0; i < 24; i++) {
      var currentHour = i.toString().padStart(2, '0') + ':00'; // Format jam (misal: "00:00", "01:00", "02:00", ...)

      labels.push(currentHour); // Tambahkan label jam ke array labels
    }
    
    analyticAuData.labels = labels;
    analyticAuData.datasets[0].data = pageViews;
  }

  // Panggil fungsi untuk mengupdate data dari kode PHP
  updateAnalyticAuData();

  function analyticsAu(selector, set_data) {
    var selectors = selector ? document.querySelectorAll(selector) : document.querySelectorAll('.analytics-au-chart');
    selectors.forEach(function (element) {
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
              title: function (tooltipItem, data) {
                return false;
              },
              label: function (tooltipItem, data) {
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

  // init chart
  NioApp.coms.docReady.push(function () {
    analyticsAu();
  });
</script>

</body>

</html>
