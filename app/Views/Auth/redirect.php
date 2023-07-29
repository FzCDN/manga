<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>Success Waiting  Redirect | <?php echo SITE_TITLE ?></title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="/public/assets/css/dashlite.css?ver=3.2.0">
    <link id="skin-default" rel="stylesheet" href="/public/assets/css/theme.css?ver=3.2.0">
</head>

<body class="nk-body ui-rounder npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                	
                    <div class="nk-block nk-block-middle nk-auth-body">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Login Successful </h4>
            <div class="nk-block-des">
                <p class="text-success">Waiting <span id="countdown">3</span> Seconds for Redirect</p>
            </div>
            <div class="loader"></div> <!-- Tambahkan elemen loader -->
        </div>
    </div>
</div>
 
<script>
window.onload = function() {
    var countdownElement = document.getElementById('countdown');
    var countdown = 3;

    var countdownInterval = setInterval(function() {
        countdown--;
        countdownElement.innerText = countdown;

        if (countdown === 0) {
            clearInterval(countdownInterval);
            // Lakukan redirect di sini
            window.location.href = '/<?php echo DASHBOARD_URL ?>';
        }
    }, 1000);
};
</script>

                    <div class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="col-lg-6">
                                    <div class="nk-block-content text-center text-lg-left">
                                        <p class="text-soft">&copy; 2023 Kaito Saikyo. All Rights Reserved.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="/public/assets/js/bundle.js?ver=3.2.0"></script>
    <script src="/public/assets/js/scripts.js?ver=3.2.0"></script>
    <script src="/public/js/script.js"></script>
    
</html>