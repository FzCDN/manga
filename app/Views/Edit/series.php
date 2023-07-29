<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta robots="no-index" >
    
    <title>Edit Series <?php echo $series->getTitle() ?> | <?php echo SITE_TITLE; ?></title>
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
                            	<form class="px-3 py-3" id="SeriesEdit">
                                <div class="nk-editor">
                                    <div class="nk-editor-header">
                                        <div class="nk-editor-title">
                                            <h4 class="me-3 mb-0 line-clamp-1">Edit Series</h4>
                                            	
                                                                    <div class="form-control-wrap">
                                                                        <select name="status_post" class="form-select js-select2">
                                                                        	<option name="status" value="draft" <?php if ($series->getStatus() === "draft") echo 'selected'; ?>>Draft</option>
                                                                            <option name="status" value="publish" <?php if ($series->getStatus() === "publish") echo 'selected'; ?>>Publish</option>
                                                                        </select>
                                                                    </div>
                                        </div>
                                    </div>
                                    
                                    
                                                    
                                                        <div class="row gy-4 gx-4">
                                                            
                                                        	<div class="col-12" style="display: none">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input name="id_manga" class="form-control" value="<?php echo $series->getId(); ?>" required/>
                                                                    </div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label class="form-label">Title</label>
                                                                    <div class="form-control-wrap">
                                                                        <input name="title" class="form-control" value="<?php echo $series->getTitle(); ?>" required/>
                                                                    </div>
                                                                </div>
                                                            </div><!-- .col --> 	
                                                            	
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="Images" class="form-label">Link Images</label>
                                                                    <div class="form-control-wrap">
                                                                        <input id="Images" name="images" type="text" class="form-control" value="<?php echo $series->getImage(); ?>" required/>
                                                                    </div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="Author" class="form-label">Author</label>
                                                                    <div class="form-control-wrap">
                                                                        <input id="Author" name="author" type="text" class="form-control" value="<?php echo $series->getMeta()->getAuthor(); ?>" />
                                                                    </div>
                                                                    <div class="form-note d-flex justify-content-between"><span>Use Comma for splits (,)</span></div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="Artists" class="form-label">Artists</label>
                                                                    <div class="form-control-wrap">
                                                                        <input id="Artists" name="artist" type="text" class="form-control" value="<?php echo $series->getMeta()->getArtist(); ?>" />
                                                                    </div>
                                                                    <div class="form-note d-flex justify-content-between"><span>Use Comma for splits (,)</span></div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="Author" class="form-label">Rating</label>
                                                                    <div class="form-control-wrap">
                                                                        <input id="rating" name="rating" type="number" class="form-control" value="<?php echo $series->getMeta()->getRating(); ?>" />
                                                                    </div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="Artists" class="form-label">Type</label>
                                                                    <div class="form-control-wrap">
                                                                        <select name="type" class="form-select js-select2">
                                                                            <option name="Manhwa" value="Manhwa" <?php if ($series->getMeta()->getType() === "Manhwa") echo 'selected'; ?>>Manhwa</option>
                                                                            <option name="Manhua" value="Manhua" <?php if ($series->getMeta()->getType() === "Manhua") echo 'selected'; ?>>Manhua</option>
                                                                            <option name="Manga" value="Manga" <?php if ($series->getMeta()->getType() === "Manga") echo 'selected'; ?>>Manga</option>
                                                                            <option name="Weebtoons" value="Weebtoons" <?php if ($series->getMeta()->getType() === "Weebtoons") echo 'selected'; ?>>Weebtoons</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div><!-- .col -->	
                                                            	
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="Genres" class="form-label">Alternative</label>
                                                                    <div class="form-control-wrap">
                                                                        <input id="alternative" name="alternative" type="text" class="form-control" value="<?php echo $series->getMeta()->getAlternatif(); ?>" />
                                                                    </div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Release</label>
                                                                    <div class="form-control-wrap">
                                                                        <input name="release" type="text" class="form-control" value="<?php echo $series->getMeta()->getReleased(); ?>" />
                                                                    </div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Status Komik</label>
                                                                    <div class="form-control-wrap">
                                                                        <select name="status" class="form-select js-select2">
                                                                            <option name="status" value="Ongoing" <?php if ($series->getMeta()->getStatus() === "Ongoing") echo 'selected'; ?>>Ongoing</option>
                                                                            <option name="status" value="Completed" <?php if ($series->getMeta()->getStatus() === "Completed") echo 'selected'; ?>Completed</option>
                                                                            <option name="status" value="Hiatus" <?php if ($series->getMeta()->getStatus() === "Hiatus") echo 'selected'; ?>Hiatus</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            	
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="Genres" class="form-label">Description</label>
                                                                    <div class="form-control-wrap">
                                                                        <textarea id="description" name="description" type="text" class="form-control"><?php echo $series->getMeta()->getDeskripsi(); ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div><!-- .col -->	
                                                            	
                                                            <div class="col-12">
                                                                <button type="submit" class="btn btn-primary btn-block">Update Series</button>
                                                            </div>
                                                        </div><!-- .row -->
                                                
                                        </div><!-- .nk-editor-base -->
                                        <div class="nk-editor-body">
                                            <div class="tinymce-toolbar nk-editor-style-clean nk-editor-full p-4" id="editor-v1"></div> <!-- .js-editor -->
                                        </div><!-- .nk-editor-body -->
                              
                            </div></form>
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
        $("#SeriesEdit").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            
            $.ajax({
                url: '/api/series/edit',
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                
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
