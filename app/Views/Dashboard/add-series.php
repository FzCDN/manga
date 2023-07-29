<?php

$PageTitle = 'Add Series';
include __DIR__ . '/Partials/header.php';

?>
	
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
                                    
                              
                                        	
                                                    <form class="px-3 py-3" id="addForm">
                                                        <div class="row gy-4 gx-4">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label class="form-label">Link Manga</label>
                                                                    <div class="form-control-wrap">
                                                                        <input name="link" class="form-control" placeholder="https://kiryuu.id/manga/xxxxxx/" required/>
                                                                    </div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="Images" class="form-label">Link Images</label>
                                                                    <div class="form-control-wrap">
                                                                        <input id="Images" name="images" type="text" class="form-control" placeholder="https://example.com" />
                                                                    </div>
                                                                    <div class="form-note d-flex justify-content-between"><span>leave blank if you don't want to replace it</span></div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="Author" class="form-label">Author</label>
                                                                    <div class="form-control-wrap">
                                                                        <input id="Author" name="author" type="text" class="form-control" placeholder="hikaru, momoncom" />
                                                                    </div>
                                                                    <div class="form-note d-flex justify-content-between"><span>Use Comma for splits (,)</span></div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="Artists" class="form-label">Artists</label>
                                                                    <div class="form-control-wrap">
                                                                        <input id="Artists" name="artist" type="text" class="form-control" placeholder="hikaru, momoncom" />
                                                                    </div>
                                                                    <div class="form-note d-flex justify-content-between"><span>Use Comma for splits (,)</span></div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="Genres" class="form-label">Genres</label>
                                                                    <div class="form-control-wrap">
                                                                        <input id="Genres" name="genres" type="text" class="form-control" placeholder="Isekai, Romance" />
                                                                    </div>
                                                                    <div class="form-note d-flex justify-content-between"><span>Use Comma for splits (,)</span></div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Release</label>
                                                                    <div class="form-control-wrap">
                                                                        <input name="release" type="text" class="form-control" placeholder="2020" />
                                                                    </div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Status</label>
                                                                    <div class="form-control-wrap">
                                                                        <select name="status" class="form-select js-select2">
                                                                            <option name="status" value="Ongoing">Ongoing</option>
                                                                            <option name="status" value="Completed">Completed</option>
                                                                            <option name="status" value="Hiatus">Hiatus</option>
                                                                        </select>
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
                	


    
<!-- footer @s -->
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