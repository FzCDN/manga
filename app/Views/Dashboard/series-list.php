<?php

$PageTitle = 'Series List';
include __DIR__ . '/Partials/header.php';

?>

	
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
        	
        	
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">List Series</h3>
                        <div class="nk-block-des text-soft">
                        		<p>You have total <?php echo $seriesCount; ?> Series.</p>
                        </div>	
                    </div>
                    <!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-search"></em>
                                            </div>
                                            <input type="text" class="form-control" id="searchInput" placeholder="Quick search by name">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white" data-bs-toggle="dropdown">Status</a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><span>Ongoing</span></a></li>
                                                    <li><a href="#"><span>Completed</span></a></li>
                                                    <li><a href="#"><span>Hiatuses</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nk-block-tools-opt">
                                        <a href="/<?php echo DASHBOARD_URL ?>/series/add" class="btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                        <a href="/<?php echo DASHBOARD_URL ?>/series/add" class="btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Series</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- .nk-block-head-content -->
                </div>
                <!-- .nk-block-between -->
            </div>
            <!-- .nk-block-head -->
            <div class="nk-block">
                <div class="card">
                    <div class="card-inner-group">
                        <div class="card-inner p-0">
                            <div class="nk-tb-list" id="seriesTable">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="pid">
                                            <label class="custom-control-label" for="pid"></label>
                                        </div>
                                    </div>
                                    <div class="nk-tb-col tb-col-sm"><span>image</span></div>
                                    <div class="nk-tb-col"><span>name</span></div>
                                    <div class="nk-tb-col"><span>status</span></div>
                                    <div class="nk-tb-col"><span>views</span></div>
                                    
                                    <div class="nk-tb-col nk-tb-col-tools">
                                        <ul class="nk-tb-actions gx-1 my-n1">
                                            <li class="me-n1">
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><em class="icon ni ni-edit"></em><span>Edit Selected</span></a></li>
                                                            <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Selected</span></a></li>
                                                            <li><a href="#"><em class="icon ni ni-bar-c"></em><span>Update Stock</span></a></li>
                                                            <li><a href="#"><em class="icon ni ni-invest"></em><span>Update Price</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                
                                
                                <?php foreach ($series as $s): ?>
                                <div class="nk-tb-item" id="series-item">
                                    <div class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="pid1">
                                            <label class="custom-control-label" for="pid1"></label>
                                        </div>
                                    </div> 
                                    <div class="nk-tb-col tb-col-sm">
                                        <span class="tb-product">
                                        	<img src="<?php echo $s->getImage(); ?>" alt="" class="thumb">
                                        </span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span class="tb-lead titles"><?php echo $s->getTitle() ?></span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><?php echo $s->getMeta()->getStatus() ?? 'Ongoing' ?></span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><?php echo $s->getViewsAll() ?? '0' ?></span>
                                    </div>
                                    
                                    <div class="nk-tb-col nk-tb-col-tools">
                                        <ul class="nk-tb-actions gx-1 my-n1">
                                            <li class="me-n1">
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="/<?php echo SERIES_LINK; ?>/<?php echo $s->getLink(); ?>/edit"><em class="icon ni ni-edit"></em><span>Edit Series</span></a></li>
                                                            <li><a href="/<?php echo SERIES_LINK; ?>/<?php echo $s->getLink(); ?>"><em class="icon ni ni-eye"></em><span>View Series</span></a></li>
                                                            <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Series</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <?php endforeach; ?>	
                                
                            </div>
                            <!-- .nk-tb-list -->
                        </div>
                    </div>
                </div>
            </div>
            
            
            
        </div>
    </div>
</div>
<!-- content @e -->
	
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const seriesTable = document.getElementById('seriesTable');
    const seriesRows = seriesTable.querySelectorAll('.series-item');

    searchInput.addEventListener('input', function () {
      const searchQuery = searchInput.value.toLowerCase();

      for (let i = 0; i < seriesRows.length; i++) {
        const titleCell = seriesRows[i].querySelector('.titles');
        
        const title = titleCell ? titleCell.innerText.toLowerCase() : '';

        if (title.includes(searchQuery)) {
          seriesRows[i].style.display = '';
        } else {
          seriesRows[i].style.display = 'none';
        }
      }
    });
  });
</script>

    <?php $script = ''; ?>
    

    <?php include 'Partials/footer.php'; ?>                	              