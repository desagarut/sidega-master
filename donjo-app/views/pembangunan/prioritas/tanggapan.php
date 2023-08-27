<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <section class="content-header">
    <h1>Detail Hasil Penentuan Prioritas </h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
      <li class="breadcrumb-item"><a href="<?= site_url() ?>pembangunan">Pembangunan</a></li>
      <li class="breadcrumb-item active"><a href="<?= site_url() ?>penentuan_prioritas">Penentuan Prioritas</a></li>
      <li class="breadcrumb-item active"><a href="#!">Tanggapan</a></li>
    </ol>
  </section>

  <!-- /.content-header -->
  <section class="content" id="maincontent">
    <div class="row">
      <div class="col-md-3">
        <?php $this->load->view('pembangunan/menu'); ?>
      </div>
      <div class="col-md-9">
        <form id="mainformexcel" name="mainformexcel" method="post" class="form-horizontal">
          <div class="box">
            <div class="row">
              <div class="col-md-12">
                <div class="box-header">
                  <a href="<?= site_url('pembangunan/prioritas') ?>" class="btn btn-success btn-sm " title="Kembali Ke Hasil Penentuan Prioritas">Kembali</a>
                  <a href="<?= site_url('pembangunan/hasil_prioritas_tk_desa') ?>" class="btn btn-success btn-sm " title="Kembali Ke Hasil Penentuan Prioritas">Hasil Penentuan Prioritas</a>
                </div>
                <div class="box-body">
                  <h4 class="text-bold">Informasi Program / Kegiatan</h4>
                  <div class="table-responsive">
                    <table class="table table-hover tabel-rincian">
                      <tbody>
                        <tr>
                          <th width="30%">Nama Dusun</th>
                          <td>:</td>
                          <td><?= $polling->dusun ?></td>
                        </tr>
                        <tr>
                          <th>Nama Usulan Program Kegiatan</th>
                          <td>:</td>
                          <td><?= $polling->nama_program_kegiatan ?></td>
                        </tr>
                        <tr>
                          <td>Sumber Dana</td>
                          <td> : </td>
                          <td><?= $polling->sumber_dana ?></td>
                        </tr>
                        <tr>
                          <td>Lokasi Pembangunan</td>
                          <td> : </td>
                          <td><?= $polling->lokasi ?></td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td>Beri Tanggapan Sekarang?</td>
                          <td></td>
                          <td><a href="<?= site_url("pembangunan_polling/form_tanggapan/"); ?>" class="btn btn-primary" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Tanggapan Anda"> Berikan Tanggapan </a></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="box">
                <div class="box-header">
                  <div class="box-title"><strong>Tanggapan Masyarakat</strong></div>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="table-responsive">
                        <table id="table-polling" class="table table-bordered dataTable table-hover">
                          <thead class="bg-gray">
                            <tr>
                              <th width="20px" class="text-center">No</th>
                              <th width="80px" class="text-center">Aksi</th>
                              <th class="text-center">Nama Responden</th>
                              <th class="text-center">Tanggapan</th>
                              <th width="130px" class="text-center">Tgl Update</th>
                              <th width="130px" class="text-center">Tgl Dibuat</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
  </section>
</div>
  <?php $this->load->view('global/confirm_delete'); ?>
  <script>
    $(function() {
      let tabelDokumentasi = $('#table-polling').DataTable({
        'processing': true,
        'serverSide': true,
        'autoWidth': true,
        'pageLength': 10,
        'order': [
          [3, 'asc']
        ],
        'columnDefs': [{
          'orderable': false,
          'targets': [0, 1, 2]
        }],

        'ajax': {
          'url': "<?= site_url("pembangunan_polling/tanggapan/{$polling->id}") ?>",
          'method': 'POST'
        },
        'columns': [{
            'data': null
          },
          {
            'data': function(data) {
              return `<a href="<?= site_url("pembangunan_polling/form_tanggapan/"); ?>${data.id}" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Tanggapan Anda" class="btn bg-orange btn-box btn-sm"><i class="fa fa-edit"></i> </a>
								<a href="#" data-href="<?= site_url("pembangunan_polling/delete_tanggapan/{$polling->id}/"); ?>${data.id}" class="btn bg-maroon btn-box btn-sm"  title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i></a>
							   `
            },
            'class': 'text-center'
          },
          {
            'data': 'responden'
          },
          {
            'data': function(data) {
              let id_pilihan;
              if (data.id_pilihan == 5) {
                id_pilihan = `Sangat Penting`
              } else if (data.id_pilihan == 4) {
                id_pilihan = `Penting`
              } else if (data.id_pilihan == 3) {
                id_pilihan = `Netral`
              } else if (data.id_pilihan == 2) {
                id_pilihan = `Tidak Penting`
              } else {
                id_pilihan = `Sangat Tidak Penting`
              }

              return `
            ${id_pilihan}
							`
            },
            'class': 'text-center'
          },
          {
            'data': 'updated_at',
            'class': 'text-center'
          },
          {
            'data': 'created_at',
            'class': 'text-center'
          },
        ],
        'language': {
          'url': "<?= base_url('/assets/bootstrap/js/dataTables.indonesian.lang') ?>"
        }
      });

      tabelDokumentasi.on('draw.dt', function() {
        let PageInfo = $('#table-polling').DataTable().page.info();
        tabelDokumentasi.column(0, {
          page: 'current'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1 + PageInfo.start;
        });
      });
    });
  </script>