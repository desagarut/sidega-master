
		<h3 class="sidebar-title"> Kategori Kelompok</h3>

	<div class="sidebar-item">
        <ul class="nav nav-pills nav-stacked">
          <?php foreach ($list_master AS $data): ?>
          <li <?= jecho($filter, $data['id'], 'class="active"'); ?>> <a href="<?= site_url("kelompok/to_master/$data[id]"); ?>">
            <?= $data['kelompok']; ?>
            </a> </li>
          <?php endforeach; ?>
          <li> <a class="btn btn-box bg-purple btn-sm" href="<?= site_url("kelompok_master/clear"); ?>"><i class="fa fa-plus"></i> Kelola Kategori Kelompok</a> </li>
        </ul>
      </div>
