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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">
    
    <style>
    .image-container {
      display: flex;
      flex-wrap: wrap;
    }

    .image-item {
      position: relative;
      width: 150px;
      height: 150px;
      margin: 10px;
    }

    .image-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .image-item .remove-button {
      position: absolute;
      top: 5px;
      right: 5px;
      background-color: #fff;
      border-radius: 50%;
      cursor: pointer;
    }
  </style>
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
                                <div class="nk-editor">
                                    <div class="nk-editor-header">
                                        <div class="nk-editor-title">
                                            <h4 class="me-3 mb-0 line-clamp-1">Edit Series</h4>
                                        </div>
                                    </div>
                                    
                                    
                                                    <form class="px-3 py-3" id="SeriesEdit">
                                                        <div class="row gy-4 gx-4">
                                                            
                                                        	<div class="col-12" style="display: none">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input name="id_manga" class="form-control" value="<?php echo $series->getId(); ?>" readonly/>
                                                                    </div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            
                                                            <div class="col-12" style="display: none">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input name="id_chapter" class="form-control" value="<?php echo $series->getChChapter()->getId(); ?>" readonly/>
                                                                    </div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            <div class="col-12" style="display: none">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input name="id_chapter_data" class="form-control" value="<?php echo $series->getChChapter()->getchData()->getId(); ?>" readonly/>
                                                                    </div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Title Series</label>
                                                                    <div class="form-control-wrap">
                                                                        <input name="title" class="form-control" value="<?php echo $series->getTitle(); ?>"  readonly/>
                                                                    </div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Chapter Title</label>
                                                                    <div class="form-control-wrap">
                                                                        <input name="title_chapter" class="form-control" value="<?php echo $series->getChChapter()->getTitle(); ?>"  readonly/>
                                                                    </div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label class="form-label">Image Upload</label>
                                                                    <div class="form-control-wrap">
                                                                            <input type="text" class="form-control" id="url-input" placeholder="https://imfg.com/xxxxxxx">
                                                                        <div class="col-12" id="url-container" style="display: none;">
                                                                        	<input type="file" class="form-control" id="image-input" accept="image/*">
                                                                        </div><br />
                                                                        
                                                                           <button type="button" class="btn btn-primary" onclick="addImage()">Add Image</button>
                                                                           <button type="button" class="btn btn-primary" onclick="toggleInput()">Toggle Input</button>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div><!-- .col -->
                                                            	
                                                            		
                                                            <div class="image-container" id="image-container">
                                                            	
                                                            	</div>
                                                            	<br>	
                                                            	
                                                            <div class="col-12">
                                                                <button type="submit" class="btn btn-primary btn-block">Update Series</button>
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

    var imageSrc = []; 
    var imageItems = document.getElementsByClassName("image-item");
    for (var i = 0; i < imageItems.length; i++) {
      var src = imageItems[i].querySelector("img").getAttribute("src");
        imageSrc.push(src);
    }

    // Append the base64-encoded images to the formData
    formData.append("images", JSON.stringify(imageSrc));

    alert("Data yang dikirimkan:\n" + JSON.stringify(Object.fromEntries(formData)));

    $.ajax({
      url: '/api/series/chapter/edit',
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
        alert(response);
      },
      error: function(xhr, textStatus, errorThrown) {
        // ... kode respons error ...

      }
    });
  });
});

</script>
  <script>
    var images = []; // Store the image URLs or files

    function renderImages() {
      var container = document.getElementById("image-container");
      container.innerHTML = ""; // Clear previous images

      for (var i = 0; i < images.length; i++) {
        var imageItem = document.createElement("div");
        imageItem.className = "image-item";

        var image = document.createElement("img");
        image.src = images[i].image;

        var removeButton = document.createElement("div");
        removeButton.className = "remove-button";
        removeButton.innerHTML = "&times;";
        removeButton.setAttribute("data-index", i);
        removeButton.addEventListener("click", removeImage);

        imageItem.appendChild(image);
        imageItem.appendChild(removeButton);

        container.appendChild(imageItem);
      }
    }

    function addImage() {
  var fileInput = document.getElementById("image-input");
  var urlInput = document.getElementById("url-input");
  var file = fileInput.files[0];
  var url = urlInput.value.trim();

  if (file) {
    // Image uploaded via file input
    var reader = new FileReader();

    reader.onload = function(event) {
      var image = {
        image: event.target.result
      };

      images.push(image);
      renderImages();
    };

    reader.readAsDataURL(file);
  } else if (url !== "") {
    // Image URL entered
    var image = {
      image: url
    };

    images.push(image);
    renderImages();
  }

  fileInput.value = ""; // Clear the file input field
  urlInput.value = ""; // Clear the URL input field
}



    function removeImage(event) {
      var index = event.target.getAttribute("data-index");
      images.splice(index, 1);
      renderImages();
    }

    // Load existing images from the database and render them on the page
    var existingImages = <?php echo $series->getChChapter()->getchData()->getContent(); ?>;

    images = existingImages;
    renderImages();
    
    
    function toggleInput() {
  var fileInput = document.getElementById("url-input");
  var urlContainer = document.getElementById("url-container");

  if (fileInput.style.display === "none") {
    // Show file input and hide URL input
    fileInput.style.display = "block";
    urlContainer.style.display = "none";
  } else {
    // Hide file input and show URL input
    fileInput.style.display = "none";
    urlContainer.style.display = "block";
  }
}


  </script>
</body>

</html>
