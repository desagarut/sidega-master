<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style>
.table {
	font-size: 12px;
}
.bg-identitas {
	width: 100%;
	height: 300px;
	background: url('<?= gambar_desa($main['kantor_desa'], TRUE); ?>');
	background-repeat: no-repeat;
	background-position: center center;
}
.img-identitas {
	margin: 30px auto;
	width: 100px;
	padding: 3px;
}
.text-identitas {
	text-align: center;
	font-weight: bold;
	color: #fff;
	text-shadow: 2px 2px 2px #0c83c5;
	;
}
</style>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Identitas
      <?= $desa; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= site_url('beranda'); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Identitas
        <?= $desa; ?>
      </li>
    </ol>
  </section>
  <section class="content" id="maincontent">
    <form id="mainform" name="mainform" action="" method="post">
      <div class="box box-info">
        <div class="box-header with-border">
          <div class="col-md-12">
            <?php $this->load->view('identitas_desa/peta.php');?>
            <div class="pull-right">
            <?php if ($this->CI->cek_hak_akses('h')): ?>
            <a href="<?= site_url('identitas_desa/form'); ?>" class="btn btn-social btn-box btn-warning btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Ubah Data" ><i class="fa fa-edit"></i> Ubah Data
            <?= $desa; ?>
            </a> 
            <!--<a href="<?= site_url('identitas_desa/maps/kantor'); ?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class='fa fa-map-marker'></i> Lokasi Kantor <?= $desa; ?></a>--> 
            <a href="<?= site_url('identitas_desa/maps/kantor'); ?>" class="btn btn-social btn-box btn-info btn-sm" title="Ubah Lokasi Kantor Desa"><i class='fa fa-map-marker'></i> Lokasi Kantor
            <?= $desa; ?>
            </a> 
            <!--<a href="<?= site_url('identitas_desa/maps/wilayah'); ?>" class="btn btn-social btn-box btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class='fa fa-map'></i> Peta Wilayah <?= $desa; ?></a>--> 
            <a href="<?= site_url('identitas_desa/maps/wilayah'); ?>" class="btn btn-social btn-box btn-primary btn-sm" title="Ubah Wilayah Desa"><i class='fa fa-google'></i> Peta Google </a>
            <a href="<?= site_url('identitas_desa/maps_openstreet/wilayah'); ?>" class="btn btn-social btn-box bg-blue btn-sm" title="Ubah Wilayah Desa"><i class='fa fa-map'></i> Peta Openstreet</a>
            <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover tabel-rincian">
              <tbody>
                <tr>
                  <th colspan="3" style="background-color:#606BFD; color:#fff"><strong>
                    <?= strtoupper($desa); ?>
                    </strong></th>
                </tr>
                <tr>
                  <td width="300">Nama
                    <?= $desa; ?></td>
                  <td width="1">:</td>
                  <td><?= $main['nama_desa']; ?></td>
                </tr>
                <tr>
                  <td>Kode
                    <?= $desa; ?></td>
                  <td>:</td>
                  <td><?= kode_wilayah($main['kode_desa']); ?></td>
                </tr>
                <tr>
                  <td>Kode Pos
                    <?= $desa; ?></td>
                  <td>:</td>
                  <td><?= $main['kode_pos']; ?></td>
                </tr>
                <tr>
                  <td>Kepala
                    <?= $desa; ?></td>
                  <td>:</td>
                  <td><?= $main['nama_kepala_desa']; ?></td>
                </tr>
                <tr>
                  <td>NIP Kepala
                    <?= $desa; ?></td>
                  <td>:</td>
                  <td><?= $main['nip_kepala_desa']; ?></td>
                </tr>
                <tr>
                  <td>Alamat Kantor
                    <?= $desa; ?></td>
                  <td>:</td>
                  <td><?= $main['alamat_kantor']; ?></td>
                </tr>
                <tr>
                  <td>E-Mail
                    <?= $desa; ?></td>
                  <td>:</td>
                  <td><?= $main['email_desa']; ?></td>
                </tr>
                <tr>
                  <td>Telpon
                    <?= $desa; ?></td>
                  <td>:</td>
                  <td><?= $main['telepon']; ?></td>
                </tr>
                <tr>
                  <td>Website
                    <?= $desa; ?></td>
                  <td>:</td>
                  <td><?= $main['website']; ?></td>
                </tr>
                <tr>
                  <th colspan="3" style="background-color:#606BFD; color:#fff"><strong>
                    <?= strtoupper($kecamatan); ?>
                    </strong></th>
                </tr>
                <tr>
                  <td>Nama
                    <?= $kecamatan; ?></td>
                  <td>:</td>
                  <td><?= $main['nama_kecamatan']; ?></td>
                </tr>
                <tr>
                  <td>Kode
                    <?= $kecamatan; ?></td>
                  <td>:</td>
                  <td><?= kode_wilayah($main['kode_kecamatan']); ?></td>
                </tr>
                <tr>
                  <td>Nama
                    <?= ucwords($this->setting->sebutan_camat); ?></td>
                  <td>:</td>
                  <td><?= $main['nama_kepala_camat']; ?></td>
                </tr>
                <tr>
                  <td>NIP
                    <?= ucwords($this->setting->sebutan_camat); ?></td>
                  <td>:</td>
                  <td><?= $main['nip_kepala_camat']; ?></td>
                </tr>
                <tr>
                  <th colspan="3" style="background-color:#606BFD; color:#fff"><strong>
                    <?= strtoupper($kabupaten); ?>
                    </strong></th>
                </tr>
                <tr>
                  <td>Nama
                    <?= $kabupaten; ?></td>
                  <td>:</td>
                  <td><?= $main['nama_kabupaten']; ?></td>
                </tr>
                <tr>
                  <td>Kode
                    <?= $kabupaten; ?></td>
                  <td>:</td>
                  <td><?= kode_wilayah($main['kode_kabupaten']); ?></td>
                </tr>
                <tr>
                  <th colspan="3" style="background-color:#606BFD; color:#fff"><strong>
PROVINSI</strong></th>
                </tr>
                <tr>
                  <td>Nama Provinsi</td>
                  <td>:</td>
                  <td><?= $main['nama_propinsi']; ?></td>
                </tr>
                <tr>
                  <td>Kode Provinsi</td>
                  <td>:</td>
                  <td><?= kode_wilayah($main['kode_propinsi']); ?></td>
                </tr>
                <tr>
                  <th colspan="3" style="background-color:#606BFD; color:#fff"><strong>
BATAS WILAYAH</strong></th>
                </tr>
                <tr>
                  <td>Utara
                    <?= $desa; ?></td>
                  <td>:</td>
                  <td><?= $main['batas_utara']; ?></td>
                </tr>
                <tr>
                  <td>Selatan
                    <?= $desa; ?></td>
                  <td>:</td>
                  <td><?= $main['batas_selatan']; ?></td>
                </tr>
                <tr>
                  <td>Timur
                    <?= $desa; ?></td>
                  <td>:</td>
                  <td><?= $main['batas_timur']; ?></td>
                </tr>
                <tr>
                  <td>Barat
                    <?= $desa; ?></td>
                  <td>:</td>
                  <td><?= $main['batas_barat']; ?></td>
                </tr>
                <tr>
                  <td>Luas Wilayah
                    <?= $desa; ?></td>
                  <td>:</td>
                  <td><?= $main['luas_wilayah']; ?> Ha</td>
                </tr>
                <tr>
                  <td>Koordinat Bujur (Lang)
                    <?= $desa; ?></td>
                  <td>:</td>
                  <td><?= $main['lng']; ?></td>
                </tr>
                <tr>
                  <td>Koordinat Lintang (lat)
                    <?= $desa; ?></td>
                  <td>:</td>
                  <td><?= $main['lat']; ?></td>
                </tr>
                <!--<tr>
                  <td>Koordinat Wilayah 
                    <?= $desa; ?></td>
                  <td>:</td>
                  <td><?= $main['path']; ?></td>
                </tr>-->
                <tr>
                  <td>Ketinggian Diatas Permukaan Laut</td>
                  <td>:</td>
                  <td><?= $main['mdpl']; ?> mdpl</td>
                </tr>
                <tr>
                  <td><?= $desa; ?> Terluar di Indonesia</td>
                  <td>:</td>
                  <td><?= $main['terluar_id']; ?></td>
                </tr>
                <tr>
                  <td><?= $desa; ?> Terluar di Provinsi</td>
                  <td>:</td>
                  <td><?= $main['terluar_prov']; ?></td>
                </tr>
                <tr>
                  <td><?= $desa; ?> Terluar di Kabupaten</td>
                  <td>:</td>
                  <td><?= $main['terluar_kab']; ?></td>
                </tr>
                <tr>
                  <td><?= $desa; ?> Terluar di Kecamatan</td>
                  <td>:</td>
                  <td><?= $main['terluar_kec']; ?></td>
                </tr>
                <tr>
                  <th colspan="3" style="background-color:#606BFD; color:#fff"><strong>
                  PROFIL SINGKAT</strong></th>
                </tr>
                <tr>
                  <td>Profil
                    <?= $desa; ?></td>
                  <td>:</td>
                  <td><?= $main['profil_singkat']; ?></td>
                </tr>
                <tr>
                  <td>Visi</td>
                  <td>:</td>
                  <td><?= $main['visi']; ?></td>
                </tr>
                <tr>
                  <td>Misi </td>
                  <td>:</td>
                  <td><?= $main['misi']; ?></td>
                </tr>
                <tr>
                  <td>Strategi</td>
                  <td>:</td>
                  <td><?= $main['strategi']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </form>
  </section>
</div>
