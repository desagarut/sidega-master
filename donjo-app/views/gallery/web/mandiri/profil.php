<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style type="text/css">
table.table th {
	text-align: left;
}
</style>
<div class="content-wrapper">
  <section class="content" id="maincontent">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-3"> 
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <div align="center">
                <?php if ($penduduk['foto']): ?>
                <img class="img-responsive img-circle" src="<?= AmbilFoto($penduduk['foto'])?>" alt="Foto Penduduk">
                <?php else: ?>
                <img class="img-responsive img-circle" src="<?= base_url()?>assets/files/user_pict/kuser.png" alt="Foto Penduduk">
                <?php endif; ?>
                <h3 class="profile-username text-center">
                  <h5><?= strtoupper($penduduk['nama'])?></h5>
                </h3>
                <p class="text-muted text-center"> <small>
                  <?= strtoupper($penduduk['sex'])?>
                  </small> </p>
              </div>
              <ul class="list-group list-group-unbordered" >
                <li class="list-group-item"><small>NIK<a class="pull-right">
                  <?= $penduduk['nik']?>
                  </a></small> </li>
                <li class="list-group-item"><small>KK Sebelumya<a class="pull-right"> <small>
                  <?= $penduduk['no_kk_sebelumnya']?>
                  </small> </a></small> </li>
                <li class="list-group-item"> <small>KK Terbaru<a class="pull-right">
                  <?= $penduduk['no_kk']?>
                  <?php if ($penduduk['status_dasar_id'] <> '1' AND $penduduk['no_kk'] <> $penduduk['log_no_kk']): ?>
                  (waktu peristiwa {
                  <?= $penduduk['status_dasar']?>
                  }: {
                  <?= $penduduk['log_no_kk']?>
                  })
                  <?php endif; ?>
                  </a></small> </li>
                <li class="list-group-item"><small>Hub. Kel.<a class="pull-right">
                  <?= $penduduk['hubungan']?>
                  </a></small> </li>
              </ul>
              <a href="<?= site_url("keluarga/anggota/$p/$o/$penduduk[id_kk]")?>" class="btn btn-danger btn-block disabled"><b>Daftar Keluarga</b></a> </div>
            <!-- /.box-body --> 
          </div>
          <!-- /.box --> 
          
          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <small><h4 class="box-title">Ringkasan</h4></small>
            </div>
            <!-- /.box-header -->
            <div class="box-body"><small> <strong><i class="fa fa-book margin-r-5"></i> Pendidikan Terakhir</strong></small>
              <p class="text-muted">
                <small><?= strtoupper($penduduk['pendidikan_kk'])?></small>
              </p>
              <hr>
              <small><strong><i class="fa fa-map-marker margin-r-5"></i> Alamat Sekarang</strong></small>
              <p class="text-muted"><small>
                <?= strtoupper($penduduk['alamat'])?>
                ,
                <?= strtoupper($penduduk['dusun'])?>
                ,
                <?= strtoupper($penduduk['rt'])?>
                /
                <?= $penduduk['rw']?>
                , </small></p>
              <hr>
              <small><strong><i class="fa fa-pencil margin-r-5"></i> Kontak</strong>
              <p> <span class="label label-info"><i class="fa fa-phone"></i>
                <?= $penduduk['telepon']?>
                </span> <span class="label label-warning"><i class="fa fa-envelope"></i>
                <?= $penduduk['email']?>
                </span> </p></small>
              <hr>
              <small><strong><i class="fa fa-file-text-o margin-r-5"></i> Catatan:</strong> <br>
              Biodata Penduduk (NIK :
              <?= $penduduk['nik']?>
              )
              <?php if (!empty($penduduk['nama_pendaftar'])): ?>
              <p class="kecil"> Terdaftar pada: <i class="fa fa-clock-o"></i>
                <?= tgl_indo2($penduduk['created_at']);?>
                Oleh: <i class="fa fa-user"></i>
                <?= $penduduk['nama_pendaftar']?>
              </p>
              <?php else: ?>
              <p class="kecil"> Terdaftar sebelum: <i class="fa fa-clock-o"></i>
                <?= tgl_indo2($penduduk['created_at']);?>
              </p>
              <?php endif; ?>
              <?php if (!empty($penduduk['nama_pengubah'])): ?>
              <p class="kecil"> Terakhir diubah: <i class="fa fa-clock-o"></i>
                <?= tgl_indo2($penduduk['updated_at']);?>
                <i class="fa fa-user"></i>
                <?= $penduduk['nama_pengubah']?>
              </p>
              <?php endif; ?>
              </small>
            </div>
            <!-- /.box-body --> 
          </div>
          <!-- /.box --> 
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li ><a href="#biodata" data-toggle="tab">Biodata</a></li>
              <li><a href="#keluarga" data-toggle="tab">Keluarga</a></li>
              <li><a href="#kelompok" data-toggle="tab">Kelompok</a></li>
              <li><a href="#dok" data-toggle="tab">Dokumen</a></li>
              <li><a href="#bantuan" data-toggle="tab">Bantuan</a></li>
              <li><a href="#rumah" data-toggle="tab">Foto Rumah</a></li>
              <li class="active"><a href="#resume" data-toggle="tab">Resume</a></li>
            </ul>
            <div class="tab-content"> 
              <!-- /Profile Biodata-->
              <?php $this->load->view('web/mandiri/profil_biodata.php');?>
              <!-- /Profile Keluarga-->
              <?php $this->load->view('web/mandiri/profil_keluarga.php');?>
              <!-- /Profile Pokmas-->
              <?php $this->load->view('web/mandiri/profil_pokmas.php');?>
              <!-- /Profile Dokumen-->
              <?php $this->load->view('web/mandiri/profil_dokumen.php');?>
              <!-- /Profile Program Bantuan-->
              <?php $this->load->view('web/mandiri/profil_program_bantuan.php');?>
              <!-- /Profile Rumah Tinggal-->
              <?php $this->load->view('web/mandiri/profil_rumah.php');?>
              <!-- /Profile mandiri-->
              <?php $this->load->view('web/mandiri/profil_resume.php');?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
