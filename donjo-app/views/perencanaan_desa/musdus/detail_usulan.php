<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <section class="content-header">
    <h1>Usulan Masyarakat</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
      <li class="breadcrumb-item"><a href="<?= site_url() ?>desa_musdus">Perencanaan Desa</a></li>
      <li class="breadcrumb-item active"><a href="<?= site_url() ?>desa_musdus">Musdus</a></li>
      <li class="breadcrumb-item active"><a href="<?= site_url() ?>desa_musdus">Usulan Masyarakat</a></li>
      <li class="breadcrumb-item active">Detail</li>
    </ol>
  </section>

  <section class="content" id="maincontent">
      <div class="row">
        <div class="col-md-3">
          <?php $this->load->view('perencanaan_desa/menu'); ?>
        </div>
        <div class="col-md-9">
          <div class="box">
            <div class="box-body">
              <a href="<?= site_url() ?>perencanaan_desa" class="btn btn-info">Kembali</a>
              <strong> USULAN MASYARAKAT</strong>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="box box-success">
                <div class="box-header"> Informasi Program/Kegiatan </div>
                <div class="box-body">
                  <table class="table table-hover">
                    <tr>
                      <th width="150px">Desa</th>
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
                      <th>Tahun Usulan</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->tahun ?></td>
                    </tr>
                    <tr>
                      <th width="150px">Nama Kegiatan</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->nama_program_kegiatan ?></td>
                    </tr>
                    <tr>
                      <th width="150px">Status Usulan</th>
                      <td width="20px">:</td>
                      <td><?php if ($musdus->status == "0") { ?>
                          <button class="btn btn-danger disabled" title="Tidak Aktif"> Tidak Aktif</button>
                        <?php } else { ?>
                          <button class="btn btn-success disabled" title="Aktif"> Aktif</button>
                        <?php } ?>
                        <?php if ($musdus->status_usulan == "0") { ?>
                          <button class="btn btn-danger disabled" title="Belum Diusulkan"> Belum Diusulkan</button>
                        <?php } else { ?>
                          <button class="btn btn-success disabled" title="Sudah Diusulkan"> Sudah Diusulkan</button>
                        <?php } ?>
                      </td>
                    </tr>
                    <tr>
                      <th>Alamat Lokasi</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->alamat ?></td>
                    </tr>
                    <tr>
                      <th>Sumber Dana</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->sumber_dana ?></td>
                    </tr>
                    <tr>
                      <th>Anggaran</th>
                      <td width="20px">:</td>
                      <td>Rp.
                        <?= number_format($musdus->anggaran, 0) ?></td>
                    </tr>
                    <tr>
                      <th>Volume</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->volume ?></td>
                    </tr>
                    <tr>
                      <th>Penerima Manfaat</th>
                      <td width="20px">:</td>
                      <td>Laki-laki:
                        <?= $musdus->laki ?>
                        | Perempuan:
                        <?= $musdus->perempuan ?>
                        | Rumah Tangga
                        <?= $musdus->rtm ?></td>
                    </tr>
                    <tr>
                      <th>SDGS KE</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->sdgs_ke ?></td>
                    </tr>
                    <tr>
                      <th>Data Eksisting</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->data_eksisting ?></td>
                    </tr>
                    <tr>
                      <th>Pengusul</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->pengusul ?></td>
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
            <div class="col-sm-6">
              <div class="box box-success">
                <div class="box-header">Gambar Lokasi Usulan Masyarakat</div>
                <div class="box-body">
                  <div class="col-xs-12 col-sm-12">
                    <div class="widget-main text-center"> <img src="<?= base_url() . LOKASI_GALERI . $musdus->foto ?>" width="auto" height="180px"> </div>
                    <br />
                    <button class="btn btn-info btn-minier" data-toggle="modal" data-target="#sampul<?= $musdus->id ?>"> <i class="ace-icon fa fa-eye"></i> Lihat </button>
                  </div>
                </div>
              </div>
              <div class="box box-success">
                <div class="box-header">Peta Lokasi</div>
                <div class="box-body">
                  <?php $this->load->view('perencanaan_desa/musdus/peta_view'); ?>
                  <!--<div id="map" style="height: 340px;"></div>-->
                </div>
              </div>
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