<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5>Detail Program Kegiatan Masuk Ke Desa</h5>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url() ?>pembangunan">Perencanaan Desa</a></li>
            <li class="breadcrumb-item active"><a href="<?= site_url() ?>pembangunan_program_masuk_desa">Program Masuk Desa</a></li>
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
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <?php $this->load->view('pembangunan/menu'); ?>
        </div>
        <div class="col-md-9">
          <div class="box">
            <div class="box-header"> <a href="<?= site_url() ?>pembangunan_program_masuk_desa" class="btn btn-info">Kembali</a> </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="box box-success">
                <div class="box-header" align="center"> DETAIL PROGRAM KEGIATAN YANG MASUK KE DESA </div>
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
                      <th>Tahun</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->tahun ?></td>
                    </tr>
                    <tr>
                      <th>Tahun Pelaksanaan</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->tahun_pelaksanaan ?></td>
                    </tr>
                    <tr>
                      <th width="150px">Nama Kegiatan</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->nama_program_kegiatan ?></td>
                    </tr>
                    <tr>
                      <th width="150px">Sumber Dana</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->sumber_dana ?></td>
                    </tr>
                    <tr>
                      <th>Mendukung SDGS Desa Ke</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->sdgs_ke ?></td>
                    </tr>
                    <tr>
                      <th>Sumber Dana</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->sumber_dana ?></td>
                    </tr>
                    <tr>
                      <th>Alamat Lokasi</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->alamat ?></td>
                    </tr>
                    <tr>
                      <th>Volume</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->volume ?></td>
                    </tr>
                    <tr>
                      <th>Satuan</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->satuan ?></td>
                    </tr>
                    <tr>
                      <th>Anggaran</th>
                      <td width="20px">:</td>
                      <td>Rp.
                        <?= number_format($musdus->anggaran, 0) ?></td>
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
          <div class="text-center"> <img src="<?= base_url() . LOKASI_GALERI . $value->gambar ?>" width="700px" height="500px"> </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<div class="modal fade" id="sampul<?= $musdus->id ?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Gambar</h4>
      </div>
      <div class="modal-body">
        <div class="text-center"> <img src="<?= base_url() . LOKASI_GALERI . $musdus->foto ?>" width="800px" height="500px"> </div>
      </div>
    </div>
  </div>
</div>