<div class="card">
	<div class="card-header">
		<h5 class="card-title">Menu Usulan Desa</h5>
		<div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
	</div>
	<div class="card-body text-white">
		<ul class="nav flex-column nav-pills">
			<li class="btn btn-light btn-sm text-left <?php ($this->tab_ini == 1) and print('active') ?>"><a href="<?= site_url('perencanaan_desa/usulan_dusun') ?>"> Daftar Program Usulan Dusun</a></li>
			<li class="btn btn-light btn-sm text-left <?php ($this->tab_ini == 2) and print('active') ?>"><a href="<?= site_url('perencanaan_desa_polling/daftar_polling') ?>"> Daftar Penentuan Prioritas Desa</a></li>
			<li class="btn btn-light btn-sm text-left <?php ($this->tab_ini == 3) and print('active') ?>"><a href="<?= site_url('perencanaan_desa/hasil_polling') ?>"> Hasil Penentuan Prioritas Desa</a></li>
		</ul>
	</div>
</div>

