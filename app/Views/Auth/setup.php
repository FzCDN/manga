<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta robots="no-index" >
    
    <title> Setup Database | Kaito Saikyo</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="/public/assets/css/dashlite.css?ver=3.2.0">
    <link id="skin-default" rel="stylesheet" href="/public/assets/css/theme.css?ver=3.2.0">
    <link rel=stylesheet href=https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css>
</head>

<body class="nk-body ui-rounder has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
	
                <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-xl">
                        <div class="nk-content-body">
                        	
                                    <div class="card">
                                        <div class="card-inner">
                                            <form method="POST" class="nk-wizard nk-wizard-simple is-alter" id="dataUp">
                                                <div class="nk-wizard-head">
                                                    <h5>Step 1</h5>
                                                </div>
                                                <div class="nk-wizard-content">
                                                    <div class="row gy-3">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Database Host</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" data-msg="Required" class="form-control required" placeholder="localhost" name="database_host" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Database Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" data-msg="Required" class="form-control required" name="database_name" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label" >Database User</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" data-msg="Required" class="form-control required" name="database_user" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label" >Database Password</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="password" data-msg="Required" class="form-control required" name="database_pass" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="nk-wizard-head">
                                                    <h5>Step 2</h5>
                                                </div>
                                                <div class="nk-wizard-content">
                                                    <div class="row gy-3">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="fw-re-password">License Key</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" data-msg="Required" class="form-control required" name="license" required>
                                                                </div>
                                                            </div>
                                                        </div><!-- .col -->
                                                        <div class="col-md-12">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" data-msg="Required" class="custom-control-input required" name="fw-policy" id="fw-policy" required>
                                                                <label class="custom-control-label" for="fw-policy">I agreed Terms and policy</label>
                                                            </div>
                                                        </div>
                                                    </div><!-- .row -->
                                                </div>
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div><!-- .nk-block -->
                        </div>    
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
    <script src="/public/js/script.js"></script>
    <script src=https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.all.min.js></script>
    <script src=https://code.jquery.com/jquery-3.6.0.min.js></script>
    
<script>
    
 $(document).ready(function() {
  $("#dataUp").submit(function(e) {
    e.preventDefault();

    var formData = new FormData(this);
    alert('Submit Post');
    $.ajax({
      url: window.location.href,
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) { 
        alert(response);
        if (response.result === 'success') {
          Swal.fire({
            title: "Sukses",
            text: "Series Berhasil Di Update.",
            icon: "success"
          }).then(function() {
            window.location.reload();
          });
        } else {
          Swal.fire({
            title: "Gagal",
            text: "Opps Error, Mohon Coba Lagi.",
            icon: "error"
          });
        }
      },
      error: function(xhr, textStatus, errorThrown) {
        console.error("Error: " + errorThrown);
        Swal.fire({
          title: "Gagal",
          text: "Terjadi kesalahan saat mengirim permintaan.",
          icon: "error"
        });
      }
    });
  });
  
});

</script>

</body>

</html>
