<div class="content-wrapper">
  <section class="content-header">
    <h1>Detil Pemudik</h1>
    <ol class="breadcrumb">
      <li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="<?= site_url('covid19_vaksin') ?>"><i class="fa fa-home"></i> Vaksin Covid-19</a></li>
      <li class="active">Detil Penerima Vaksin</li>
    </ol>
  </section>
  <section class="content" id="maincontent">
    <div class="row">
      <div class="col-sm-2">
        <?php $this->load->view('kesehatan/covid19/menu') ?>
      </div>
      <div class="col-md-10">
        <div class="box box-info">

          <div class="box-header with-border">
            <a href="<?= site_url('covid19_vaksin') ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-arrow-circle-left"></i> Kembali Ke Data Penerima Vaksin</a>
            <?php if ($penduduk['id_status'] === '2' or $penduduk['id_status'] === '3') : ?>
              <a href="#" class="btn btn-social btn-success btn-sm" data-toggle="modal" data-target="#edit-warga">
                <i class="fa fa-edit"></i>
                Ubah Data Penduduk Non Domisili
              </a>
            <?php endif ?>
          </div>

          <div class="box-header with-border">
            <h3 class="box-title">Detil Penerima Vaksin</h3>
          </div>

          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td style="padding-top : 10px;padding-bottom : 10px;width:20%;">NIK /Nama</td>
                    <td> <?= $terdata["terdata_nama"] . " / " . $terdata["terdata_info"] ?></td>
                  </tr>
                  <tr>
                    <td style="padding-top : 10px;padding-bottom : 10px;width:20%;">Alamat</td>
                    <td> <?= $individu['alamat_wilayah']; ?> </td>
                  </tr>
                  <tr>
                    <td style="padding-top : 10px;padding-bottom : 10px;width:20%;">Tempat Tanggal Lahir (Umur)</td>
                    <td> <?= $individu['tempatlahir'] ?> <?= tgl_indo($individu['tanggallahir']) ?> (<?= $individu['umur'] ?> Tahun) </td>
                  </tr>
                  <tr>
                    <td style="padding-top : 10px;padding-bottom : 10px;width:20%;">Pendidikan</td>
                    <td> <?= $individu['pendidikan'] ?> </td>
                  </tr>
                  <tr>
                    <td style="padding-top : 10px;padding-bottom : 10px;width:20%;">Warganegara / Agama</td>
                    <td> <?= $individu['warganegara'] ?> / <?= $individu['agama'] ?> </td>
                  </tr>
                  <tr>
                    <td style="padding-top : 10px;padding-bottom : 10px;">Asal Pemudik</td>
                    <td> <?= $terdata["asal_mudik"] ?></td>
                  </tr>
                  <tr>
                    <td style="padding-top : 10px;padding-bottom : 10px;">Tanggal Vaksin</td>
                    <td> <?= $terdata["tanggal"] ?></td>
                  </tr>
                  <tr>
                    <td style="padding-top : 10px;padding-bottom : 10px;">Jenis Vaksin</td>
                    <td> <?= $terdata["jenis_vaksin"] ?></td>
                  </tr>
                  <tr>
                    <td style="padding-top : 10px;padding-bottom : 10px;">Dosis 1</td>
                    <td> <?= $terdata["dosis1"] ?></td>
                  </tr>
                  <tr>
                    <td style="padding-top : 10px;padding-bottom : 10px;">Dosis 2</td>
                    <td> <?= $terdata["dosis2"] ?></td>
                  </tr>
                  <tr>
                    <td style="padding-top : 10px;padding-bottom : 10px;">HP</td>
                    <td> <?= $terdata["no_hp"] ?></td>
                  </tr>
                  <tr>
                    <td style="padding-top : 10px;padding-bottom : 10px;">Email</td>
                    <td> <?= $terdata["email"] ?></td>
                  </tr>
                  <tr>
                    <td style="padding-top : 10px;padding-bottom : 10px;">Wajib di Pantau</td>
                    <td> <?= $terdata["is_wajib_pantau"] ?></td>
                  </tr>
                  <tr>
                    <td style="padding-top : 10px;padding-bottom : 10px;">Kejadian Ikutan Pasca Imunisasi</td>
                    <td> <?= $terdata["kipi"] ?></td>
                  </tr>
                  <tr>
                    <td style="padding-top : 10px;padding-bottom : 10px;">Keterangan</td>
                    <td> <?= $terdata["keterangan"] ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class='modal fade' id='edit-warga' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
        <h4 class='modal-title' id='myModalLabel'><i class='fa fa-plus text-green'></i> Ubah Penduduk Pendatang / Tidak Tetap</h4>
      </div>

      <div class='modal-body'>
        <div class="row">
          <?php include("district-app/views/covid19/vaksin/form_isian_penduduk.php"); ?>
        </div>
      </div>

      <div class='modal-footer'>
        <button type="button" class="btn btn-social btn-box btn-warning btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
        <a class='btn-ok'>
          <button type="submit" class="btn btn-social btn-box btn-success btn-sm" onclick="$('#'+'form_penduduk').submit();"><i class='fa fa-trash-o'></i> Simpan</button>
        </a>
      </div>
    </div>
  </div>
</div>