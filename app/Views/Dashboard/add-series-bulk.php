<?php

$PageTitle = 'Add Series';
include __DIR__ . '/Partials/header.php';

?>
                <!-- content @s -->
                <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-xl">
                        <div class="nk-content-body">
                            <div class="card">
                                <div class="nk-editor">
                                    <div class="nk-editor-header">
                                        <div class="nk-editor-title">
                                            <h4 class="me-3 mb-0 line-clamp-1">Add Series</h4>
                                        </div>
                                    </div>
                                    
                              
                                        	
                                                    <form id="addForm" class="px-3 py-3">
                                                        <div class="row gy-4 gx-4">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label class="form-label">Link Manga</label>
                                                                    <div class="form-control-wrap">
                                                                        <textarea name="link" rows="10" class="form-control" placeholder="https://kiryuu.id/manga/xxxxxx/" required style="width: 100%; height: 640px;"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            	
                                                            <div class="col-12">
                                                                <button type="submit" class="btn btn-primary btn-block">Generate</button>
                                                            </div>
                                                        </div><!-- .row -->
                                                    </form>
                                                
                                        </div><!-- .nk-editor-base -->
                                        <div class="nk-editor-body">
                                            <div class="tinymce-toolbar nk-editor-style-clean nk-editor-full p-4" id="editor-v1"></div> <!-- .js-editor -->
                                        </div><!-- .nk-editor-body -->
                              
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                	
<?php
$script = '<script>
$(document).ready(function() {
    $("#addForm").submit(function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: window.location.href,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
             
                    Swal.fire({
                        title: "Sukses",
                        text: "Data berhasil dikirim!",
                        icon: "success"
                    }).then(function() {
                        location.reload(); 
                    });
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
                Swal.fire({
                    title: "Gagal",
                    text: "Terjadi kesalahan saat mengirim permintaan.",
                    icon: "error"
                });
            }
        });
    });
}); </script>
';
?>
	
	
   <?php include 'Partials/footer.php'; ?>