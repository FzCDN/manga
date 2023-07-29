<!doctype html>
<html lang=zxx class=js>
<head>
<meta charset=utf-8>
<meta name=viewport content="width=device-width,initial-scale=1,shrink-to-fit=no">
<title>Activating | Kaito Sakkyo</title>
<link rel=stylesheet href="/public/assets/css/dashlite.css?ver=3.2.0">
<link id=skin-default rel=stylesheet href="/public/assets/css/theme.css?ver=3.2.0">
<link rel=stylesheet href=https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css>
</head>
<body class="nk-body ui-rounder npc-general pg-auth">
<div class=nk-app-root>
<div class=nk-main>
<div class="nk-wrap nk-wrap-nosidebar">
<div class=nk-content>
<div class="nk-split nk-split-page nk-split-md">
<div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white w-lg-45">
<div class="nk-block nk-block-middle nk-auth-body">
<div class=nk-block-head>
<div class=nk-block-head-content>
<h5 class=nk-block-title>License Activation</h5>
<div class=nk-block-des>
<p>If you forgot your license, well, then we’ll chat you instructions to get your license.</p>
</div>
</div>
</div>
<form id=licenseForm>
<div class=form-group>
<div class=form-label-group>
<label class=form-label for=default-01>License Code</label>
<a class="link link-primary link-sm" href=https://t.me/kaitosaikyo>Need Help?</a>
</div>
<div class=form-control-wrap>
<input id=licenseKey name=licenseKey class="form-control form-control-lg" placeholder="Enter your license code" required>
</div>
</div>
<div class=form-group>
<button id=activateButton class="btn btn-lg btn-primary btn-block">Activating</button>
</div>
</form>
</div>
<div class="nk-block nk-auth-footer">
<div class=mt-3>
<p>&copy; 2023 Kaito Saikyo. All Rights Reserved.</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script src="/public/assets/js/bundle.js?ver=3.2.0"></script>
<script src="/public/assets/js/scripts.js?ver=3.2.0"></script>
<script src=https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.all.min.js></script>
<script src=https://code.jquery.com/jquery-3.6.0.min.js></script>
<script>$(document).ready((function(){$("#licenseForm").submit((function(e){e.preventDefault();var t=new FormData(this);$.ajax({url:"/",type:"POST",data:t,processData:!1,contentType:!1,success:function(e){"success"===e.result?Swal.fire({title:"Sukses",text:"License Berhasil Di Aktifkan.",icon:"success"}).then((function(){window.location.href="/<?php echo DASHBOARD_URL ?>"})):Swal.fire({title:"Gagal",text:"License Salah, Mohon Coba Lagi.",icon:"error"})},error:function(e,t,a){console.error("Error: "+a),Swal.fire({title:"Gagal",text:"Terjadi kesalahan saat mengirim permintaan.",icon:"error"})}})}))}))</script>
</body></html>