<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5>Detail Kerjasama Antar Desa</h5>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url() ?>pembangunan">Perencanaan Desa</a></li>
            <li class="breadcrumb-item active"><a href="<?= site_url() ?>pembangunan/kerjasama_pihak_ketiga">Kerjasama Antar Desa</a></li>
            <li class="breadcrumb-item active">Detail</li>
          </ol>
        </div>
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container-fluid --> 
  </div>
  <!-- /.content-header -->
  <section class="content" id="maincontent">
  <div class="row">
    <div class="col-md-3">
      <?php $this->load->view('pembangunan/menu'); ?>
    </div>
    <div class="col-md-9">
      <div class="box">
        <div class="box-header"> <a href="<?= site_url() ?>pembangunan/kerjasama_antar_desa" class="btn btn-sm btn-info">Kembali</a> <span class="text-right">
          <h5>DETAIL KERJASAMA ANTAR DESA</h5>
          </span> </div>
      </div>
      <div class="box box-success">
        <div class="box-header"> Informasi Program/Kegiatan </div>
        <div class="box-body">
          <table class="table table-hover">
            <tr>
              <th width="350px">Nama Desa</th>
              <td width="20px">:</td>
              <td><?= $musdus->desa ?></td>
            </tr>
            <tr>
              <th width="150px">Kecamatan</th>
              <td width="20px">:</td>
              <td><?= strtoupper($config['nama_kecamatan']); ?></td>
            </tr>
            <tr>
              <th width="150px">Kabupaten</th>
              <td width="20px">:</td>
              <td><?= strtoupper($config['nama_kabupaten']); ?></td>
            </tr>
            <tr>
              <th>Tahun</th>
              <td width="20px">:</td>
              <td><?= $musdus->tahun ?></td>
            </tr>
            <tr>
              <th width="150px">Nama Program / Kegiatan</th>
              <td width="20px">:</td>
              <td><?= $musdus->nama_program_kegiatan ?></td>
            </tr>
            <tr>
              <th width="150px">Mendukung SDGS Desa Ke</th>
              <td width="20px">:</td>
              <td><?= $musdus->sdgs_ke ?></td>
            </tr>
            <tr>
              <th>Lokasi</th>
              <td width="20px">:</td>
              <td><?= $musdus->alamat ?></td>
            </tr>
            <tr>
              <th>Perkiraan Volume & Satuan</th>
              <td width="20px">:</td>
              <td><?= $musdus->volume ?>
                <?= $musdus->satuan ?></td>
            </tr>
            <tr>
              <th>Penerima manfaat</th>
              <td width="20px">:</td>
              <td>Laki-laki:
                <?= $musdus->laki ?>
                jiwa | Perempuan:
                <?= $musdus->satuan ?>
                jiwa | Rumah Tangga:
                <?= $musdus->rtm ?>
                jiwa</td>
            </tr>
            <tr>
              <th>Perkiraan Biaya yang ditanggung Desa</th>
              <td width="20px">:</td>
              <td>Jumlah : Rp.
                <?= number_format($musdus->anggaran, 0) ?>
                | Sumber :
                <?= $musdus->sumber_dana ?></td>
            </tr>
            <tr>
              <th>Perkiraan Biaya yang ditanggung Desa Lain</th>
              <td width="20px">:</td>
              <td>Jumlah : Rp.
                <?= number_format($musdus->anggaran_desa_lain, 0) ?>
                | Nama Desa Lain:
                <?= $musdus->nama_desa_lain ?></td>
            </tr>
            <tr>
              <th>Dibuat Tanggal</th>
              <td width="20px">:</td>
              <td><?= $musdus->created_at ?></td>
            </tr>
            <tr>
              <th>Diubah Tanggal</th>
              <td width="20px">:</td>
              <td><?= $musdus->updated_at ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<?php foreach ($dokumentasi as $key => $value) : ?>
<div class="modal fade" id="<?= $value->id ?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
          <?= 'Gambar Progres Usulan Masyarakat ' . $value->persentase ?>
        </h4>
      </div>
      <div class="modal-body">
        <div class="text-center"> <img src="<?= base_url() . LOKASI_GALERI . $value->gambar ?>" width="600px" height="500px"> </div>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>
<div class="modal fade" id="sampul<?= $musdus->id ?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Gambar Lokasi Usulan Masyarakat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="text-center"> <img src="<?= base_url() . LOKASI_GALERI . $musdus->foto ?>" width="700px" height="400px"> </div>
      </div>
    </div>
  </div>
</div>
<script>
	var map = L.map('map').setView([<?= $musdus->lat ?>, <?= $musdus->lng ?>], 18);
	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);

	var logo = L.icon({
		iconUrl: '<?= favico_desa() ?>',
		iconSize: [32, 32], // size of the icon
		//iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
		popupAnchor: [-1, 1] // point from which the popup should open relative to the iconAnchor
	});

	var info_tempat = "<div class='media text-center'>";
	info_tempat += "<div class='media-center'>";
	info_tempat += "<img class='media-object' src='<?= base_url() . LOKASI_GALERI . $musdus->foto ?>' width='200px' height='100px'>";
	info_tempat += "</div>";
	info_tempat += "<div class='media-body '>";
	info_tempat += "<p><b><?= $musdus->judul ?></b></p>";
	info_tempat += "</div>";
	info_tempat += "</div>";

	L.marker([<?= $musdus->lat ?>, <?= $musdus->lng ?>], {
			icon: logo
		}).addTo(map)
		.bindPopup(info_tempat).openPopup();
</script>