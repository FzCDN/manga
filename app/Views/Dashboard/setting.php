<?php

$PageTitle = 'Settings';
include __DIR__ . '/Partials/header.php';

?>

    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-body">
                <div class="card">
                    <div class="nk-editor">
                        <div class="nk-editor-header">
                            <div class="nk-editor-title">
                                <h4 class="me-3 mb-0 line-clamp-1">Configuration</h4>
                            </div>
                        </div>



                        <form class="px-3 py-3" id="licenseForm">
                            <div class="row gy-4 gx-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Site Title</label>
                                        <div class="form-control-wrap">
                                            <input class="form-control" type="text" name="site_title" id="site_title" value="<?php echo SITE_TITLE; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Site Tagline</label>
                                        <div class="form-control-wrap">
                                            <input class="form-control" type="text" name="site_tagline" id="site_tagline" value="<?php echo SITE_TAGLINE; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Favicon</label>
                                        <div class="form-control-wrap">
                                            <input class="form-control" type="text" name="favicon_path" id="favicon_path" value="<?php echo FAVICON_PATH; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Logo</label>
                                        <div class="form-control-wrap">
                                            <input class="form-control" type="text" name="logo" id="logo" value="<?php echo LOGO; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Disqus</label>
                                        <div class="form-control-wrap">
                                            <input class="form-control" type="text" name="disqus" id="disqus" value="<?php echo DISQUS; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- .col -->

                                <h4 class="me-3 mb-0 line-clamp-1">Security</h4>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Url Dashboard</label>
                                        <div class="form-control-wrap">
                                            <input class="form-control" type="text" name="dashboard_url" id="dashboard_url" value="<?php echo DASHBOARD_URL; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Url Login</label>
                                        <div class="form-control-wrap">
                                            <input class="form-control" type="text" name="login_url" id="login_url" value="<?php echo LOGIN_URL; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Url Series</label>
                                        <div class="form-control-wrap">
                                            <input class="form-control" type="text" name="series_url" id="series_url" value="<?php echo SERIES_LINK; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- .col -->
                                <h4 class="me-3 mb-0 line-clamp-1">Advance Setting</h4>
                                
                                <div class="col-12">
                                	<div class="form-group">
                                		<label class="form-label">Cache Static</label>
        <div class="form-control-wrap">
            <select class="form-control" name="cache" id="cache">
                <option value="no" <?php echo CACHE === 'no' ? 'selected' : ''; ?>>No</option>
                <option value="yes" <?php echo CACHE === 'yes' ? 'selected' : ''; ?>>Yes</option>
            </select>
        </div>
    </div>
</div>

<div class="col-12">
                                	<div class="form-group">
                                		<label class="form-label">Maintenance Mode</label>
        <div class="form-control-wrap">
            <select class="form-control" name="mainten" id="cache">
                <option value="no" <?php echo MAINTEN === 'no' ? 'selected' : ''; ?>>No</option>
                <option value="yes" <?php echo MAINTEN === 'yes' ? 'selected' : ''; ?>>Yes</option>
            </select>
        </div>
    </div>
</div>
                                
                                <h4 class="me-3 mb-0 line-clamp-1">Header & Footer</h4>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Header</label>
                                        <div class="form-control-wrap">
                                            <textarea name="header" id="header" rows="10" class="form-control"><?php echo HEADER; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Footers</label>
                                        <div class="form-control-wrap">
                                            <textarea name="footer" id="footer" rows="10" class="form-control"><?php echo FOOTER; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- .col -->

                                <h4 class="me-3 mb-0 line-clamp-1">Ads Area</h4>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Iklan Header Home</label>
                                        <div class="form-control-wrap">
                                            <textarea name="ads_home_header" id="ads_home_header" rows="10" class="form-control"><?php echo IKLAN_HEADER_HOME; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- .col -->


                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Iklan Bawah Popular</label>
                                        <div class="form-control-wrap">
                                            <textarea name="iklan_bawah_popular" id="iklan_bawah_popular" rows="10" class="form-control"><?php echo IKLAN_BAWAH_POPULAR; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Iklan Bawah List</label>
                                        <div class="form-control-wrap">
                                            <textarea name="iklan_bawah_list" id="iklan_bawah_list" rows="10" class="form-control"><?php echo IKLAN_BAWAH_LIST; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Atas Chapter List</label>
                                        <div class="form-control-wrap">
                                            <textarea name="ads_top_chapter" id="ads_top_chapter" rows="10" class="form-control"><?php echo IKLAN_ATAS_CHAPTER; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Bawah Chapter List</label>
                                        <div class="form-control-wrap">
                                            <textarea name="ads_button_chapter" id="ads_button_chapter" rows="10" class="form-control"><?php echo IKLAN_BAWAH_CHAPTER; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Atas Reading Chapter</label>
                                        <div class="form-control-wrap">
                                            <textarea name="ads_top_read_chapter" id="ads_top_read_chapter" rows="10" class="form-control"><?php echo IKLAN_ATAS_READ_CHAPTER; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Bawah Reading Chapter</label>
                                        <div class="form-control-wrap">
                                            <textarea name="ads_button_read_chapter" id="ads_button_read_chapter" rows="10" class="form-control"><?php echo IKLAN_BAWAH_READ_CHAPTER; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- .col -->

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                                </div>
                            </div>
                            <!-- .row -->
                        </form>

                    </div>
                    <!-- .nk-editor-base -->
                    <div class="nk-editor-body">
                        <div class="tinymce-toolbar nk-editor-style-clean nk-editor-full p-4" id="editor-v1"></div>
                        <!-- .js-editor -->
                    </div>
                    <!-- .nk-editor-body -->

                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->




    <!-- footer @s -->
    <?php $script = '<script>
$(document).ready(function() {
    $("#licenseForm").submit(function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "/' . DASHBOARD_URL . '/setting",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    title: "Sukses",
                    text: "Data Berhasil Di Update.",
                    icon: "success"
                }).then(function() {
                    //
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
});
</script>'; ?>

    <?php include 'Partials/footer.php'; ?>