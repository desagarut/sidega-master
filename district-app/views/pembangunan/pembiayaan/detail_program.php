<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>Detail Rencana Pembiayaan Pembangunan Desa</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
      <li class="breadcrumb-item"><a href="<?= site_url() ?>pembangunan">Perencanaan Desa</a></li>
      <li class="breadcrumb-item active"><a href="<?= site_url() ?>pembangunan_pembiayaan">Rencana Pembiayaan</a></li>
      <li class="breadcrumb-item active">Detail</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <?php $this->load->view('pembangunan/menu'); ?>
        </div>
        <div class="col-md-9">
          <div class="box">
            <div class="box-header"> <a href="<?= site_url() ?>pembangunan_pembiayaan" class="btn btn-info">Kembali</a> </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="box box-success">
                <div class="box-header" align="center"> DETAIL RENCANA PEMBIAYAAN PEMBANGUNAN DESA </div>
                <div class="box-body">
                  <table class="table table-hover">
                    <tr>
                      <th width="350px">Desa</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->desa ?></td>
                    </tr>
                    <tr>
                      <th width="350px">Kecamatan</th>
                      <td width="20px">:</td>
                      <td><?= strtoupper($config['nama_kecamatan']); ?></td>
                    </tr>
                    <tr>
                      <th width="350px">Kabupaten</th>
                      <td width="20px">:</td>
                      <td><?= strtoupper($config['nama_kabupaten']); ?></td>
                    </tr>
                    <tr>
                      <th width="350px">Tahun</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->tahun ?></td>
                    </tr>
                    <tr>
                      <th width="350px">Nama Program Kegiatan</th>
                      <td width="20px">:</td>
                      <td><?= $musdus->nama_program_kegiatan ?></td>
                    </tr>
                    <tr>
                      <th width="350px">Jumlah Dana Indikatif </th>
                      <td width="20px"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th width="350px">PADes</th>
                      <td width="20px">:</td>
                      <td>Rp. <?= number_format($musdus->pades, 0) ?></td>
                    </tr>
                    <tr>
                      <th>Dana Desa (APBN)</th>
                      <td width="20px">:</td>
                      <td>Rp. <?= number_format($musdus->apbn, 0) ?></td>
                    </tr>
                    <tr>
                      <th>Alokasi Dana Desa (bagian dana perimbangan kab./kota)</th>
                      <td width="20px">:</td>
                      <td>Rp. <?= number_format($musdus->add, 0) ?> </td>
                    </tr>
                    <tr>
                      <th>Dana bagian dari hasil pajak dan retribusi</th>
                      <td width="20px">:</td>
                      <td>Rp. <?= number_format($musdus->bagi_hasil_pajak, 0) ?></td>
                    </tr>
                    <tr>
                      <th>APBD Provinsi</th>
                      <td width="20px">:</td>
                      <td>Rp. <?= number_format($musdus->apbd_prov, 0) ?></td>
                    </tr>
                    <tr>
                      <th>APBD Kabupaten</th>
                      <td width="20px">:</td>
                      <td>Rp. <?= number_format($musdus->apbd_kab, 0) ?></td>
                    </tr>
                    <tr>
                      <th>Sumber Keuangan Lainnya yang Sah dan Tidak Mengikat</th>
                      <td width="20px">:</td>
                      <td>Rp.
                        <?= number_format($musdus->lainnya, 0) ?></td>
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

