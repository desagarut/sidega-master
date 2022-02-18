<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php 
	$pages = array();
	for($i=$paging->start_link; $i<=$paging->end_link; $i++) {
		array_push($pages, $i);
	}
?>

            <div class="blog blog-pagination" align="center">
<?php if((int) $paging->end_link > 1) : ?>
              <ul class="justify-content-center">
		<?php if($paging->start_link) : ?>
                <li class="disabled"><a href="<?= site_url('first/'.$paging_page.'/'.$paging->start_link)?>"><i class="icofont-rounded-left"></i></a></li>
		<?php endif ?>
		<?php if($paging->prev) : ?>
                <li class="disabled"><a href="<?= site_url('first/'.$paging_page.'/'.$paging->prev.$paging->suffix)?>"></a></li>
        <?php endif ?>  
        <?php foreach($pages as $page) : ?>      
                <li class="active"><a href="<?= site_url('first/'.$paging_page.'/'.$page.$paging->suffix)?>"><?= $page ?></a></li>
		<?php endforeach ?>
		<?php if($paging->next) : ?>
                <li class="disabled"><a href="<?= site_url('first/'.$paging_page.'/'.$paging->next.$paging->suffix)?>"></a></li>
		<?php endif ?>
		<?php if($paging->end_link) : ?>
                <li class="disabled"><a href="<?= site_url('first/'.$paging_page.'/'.$paging->end_link)?>"><i class="icofont-rounded-right"></i></a></li>
		<?php endif ?>
              </ul>
<?php endif ?>
            </div>
