<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>Profile | <?php SITE_TITLE ?></title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="/public/assets/css/dashlite.css?ver=3.2.0">
    <link id="skin-default" rel="stylesheet" href="/public/assets/css/theme.css?ver=3.2.0">
</head>

<body class="nk-body ui-rounder has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar is-light nk-sidebar-fixed is-light " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="/<?php echo DASHBOARD_URL ?>" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                            <img class="logo-dark logo-img" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                            <img class="logo-small logo-img logo-img-small" src="./images/logo-small.png" srcset="./images/logo-small2x.png 2x" alt="logo-small">
                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                        	<?php include 'dash-part/menu.php'; ?>
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header is-light nk-header-fixed is-light">
                    <div class="container-xl wide-xl">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1 me-3">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="</?php echo DASHBOARD_URL ?>" class="logo-link">
                                    <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                                    <img class="logo-dark logo-img" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                                </a>
                            </div><!-- .nk-header-brand -->
                            	
                            <?php include 'dash-part/head.php'; ?>
                            
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                
                
                
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-xl">
                        <div class="nk-content-body">
                            <div class="nk-block">
                                <div class="card">
                                    <div class="card-aside-wrap">
                                        <div class="card-inner card-inner-lg">
                                            <div class="nk-block-head nk-block-head-lg">
                                                <div class="nk-block-between">
                                                    <div class="nk-block-head-content">
                                                        <h4 class="nk-block-title">Personal Information</h4>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-block-head -->
                                            <div class="nk-block">
                                                <div class="nk-data data-list">
                                                    <div class="data-head">
                                                        <h6 class="overline-title">Basics</h6>
                                                    </div>
                                                    <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                                        <div class="data-col">
                                                            <span class="data-label">Display Name</span>
                                                            <span class="data-value"><?php echo $_SESSION['username']; ?></span>
                                                        </div>
                                                        <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                                    </div><!-- data-item -->
                                                    <div class="data-item">
                                                        <div class="data-col">
                                                            <span class="data-label">Email</span>
                                                            <span class="data-value"><?php echo $_SESSION['email']; ?></span>
                                                        </div>
                                                        <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                                    </div><!-- data-item -->
                                                    <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                                        <div class="data-col">
                                                            <span class="data-label">Phone Number</span>
                                                            <span class="data-value text-soft">Not add yet</span>
                                                        </div>
                                                        <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                                    </div><!-- data-item -->
                                                    <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                                        <div class="data-col">
                                                            <span class="data-label">Roles</span>
                                                            <span class="data-value"><?php echo $_SESSION['roles']; ?></span>
                                                        </div>
                                                        <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                                    </div><!-- data-item -->
                                                    <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit" data-tab-target="#address">
                                                        <div class="data-col">
                                                            <span class="data-label">License</span>
                                                            <span class="data-value"><?php echo $_SESSION['license']; ?></span>
                                                        </div>
                                                        <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                                    </div><!-- data-item -->
                                                </div><!-- data-list -->
                                                
                                            </div><!-- .nk-block -->
                                        </div>
                                        
                                    </div><!-- .card-aside-wrap -->
                                </div><!-- .card -->
                            </div><!-- .nk-block -->
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                <!-- footer @s -->
                <?php include 'dash-part/footer.php'; ?>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    
    <script src="/public/assets/js/bundle.js?ver=3.2.0"></script>
    <script src="/public/assets/js/scripts.js?ver=3.2.0"></script>
    <script src="/public/js/script.js"></script>
    
</body>

</html>