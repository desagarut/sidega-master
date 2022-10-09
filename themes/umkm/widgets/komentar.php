<!-- widget Komentar-->
<div class="widget popular-tag-widget">
    <h5 class="widget-title">Komentar</h5>
    <div class="tags">
            <?php foreach ($komen as $data) { ?>
        <div class="feed-desc">
          <i class="fa fa-comment"></i> <?php echo $data['owner'] ?> :<?php echo $data['komentar'] ?><br /><small>ditulis pada <?php echo tgl_indo2($data['tgl_upload']) ?></small>
        </div>
      <?php } ?>
  </div>
</div>