<script type="text/javascript">
  $(function() {
    var keyword = <?= $keyword ?>;
    $("#cari").autocomplete({
      source: keyword,
      maxShowItems: 10,
    });
  });
</script>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Transportasi Warga <?= ucwords($this->setting->sebutan_desa); ?></h1>
    <ol class="breadcrumb">
      <li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transportasi Warga <?= ucwords($this->setting->sebutan_desa); ?></li>
    </ol>
  </section>
  <section class="content" id="maincontent">
    <form id="mainform" name="mainform" action="" method="post">
      <div class="row">
        <div id="umkm" class="col-sm-3">
          <?php $this->load->view('umkm/menu') ?>
        </div>
        <div id="umkm" class="col-sm-9">
          <div class="box box-info">
            <div class="box-header with-border"> <a href="<?= site_url("tawa/form") ?>" class="btn btn-social btn-box btn-success btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah"> <i class="fa fa-plus"></i> Tambah </a> <a href="#confirm-delete" title="Hapus Data Terpilih" onclick="deleteAllBox('mainform', '<?= site_url("tawa/delete_all/$p/$o") ?>')" class="btn btn-social btn-box btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hapus-terpilih"><i class='fa fa-trash-o'></i> Hapus Data Terpilih</a> <a href="<?= site_url("first/toko_show") ?>" class="btn btn-social btn-box btn-primary btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" target="_blank" title="Lihat Toko"> <i class="fa fa-eye"></i> Lihat Halaman Depan </a></div>
            <div class="box-body">
              <div class="row">
                <div class="col-sm-12">
                  <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <form id="mainform" name="mainform" action="" method="post">
                      <div class="row">
                        <div class="col-sm-6">
                          <select class="form-control input-sm " name="filter" onchange="formAction('mainform', '<?= site_url('tawa/filter') ?>')">
                            <option value="">Semua</option>
                            <option value="1" <?php if ($filter == 1) : ?>selected<?php endif ?>>Aktif</option>
                            <option value="2" <?php if ($filter == 2) : ?>selected<?php endif ?>>Tidak Aktif</option>
                          </select>
                        </div>
                        <div class="col-sm-6">
                          <div class="box-tools">
                            <div class="input-group input-group-sm pull-right">
                              <input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?= html_escape($cari) ?>" onkeypress="if (event.keyCode == 13):$('#'+'mainform').attr('action', '<?= site_url('toko_warga/search') ?>');$('#'+'mainform').submit();endif">
                              <div class="input-group-btn">
                                <button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action', '<?= site_url("tawa/search") ?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="table-responsive">
                            <table class="table table-bordered table-striped dataTable table-hover">
                              <thead class="bg-gray disabled color-palette">
                                <tr>
                                  <th><input type="checkbox" id="checkall" /></th>
                                  <th class="text-center">No</th>
                                  <th class="text-center" colspan="2">Aksi</th>
                                  <?php if ($o == 2) : ?>
                                    <th class="text-center"><a href="<?= site_url("tawa/index/$p/1") ?>">Nama Usaha <i class='fa fa-sort-asc fa-sm'></i></a></th>
                                  <?php elseif ($o == 1) : ?>
                                    <th class="text-center"><a href="<?= site_url("tawa/index/$p/2") ?>">Nama Usaha <i class='fa fa-sort-desc fa-sm'></i></a></th>
                                  <?php else : ?>
                                    <th class="text-center"><a href="<?= site_url("tawa/index/$p/1") ?>">Nama Usaha <i class='fa fa-sort fa-sm'></i></a></th>
                                  <?php endif; ?>
                                  <!-- <?php if ($o == 4) : ?>
                                    <th nowrap><a href="<?= site_url("tawa/index/$p/3") ?>">Aktif <i class='fa fa-sort-asc fa-sm'></i></a></th>
                                  <?php elseif ($o == 3) : ?>
                                    <th nowrap><a href="<?= site_url("tawa/index/$p/4") ?>">Aktif <i class='fa fa-sort-desc fa-sm'></i></a></th>
                                  <?php else : ?>
                                    <th nowrap><a href="<?= site_url("tawa/index/$p/3") ?>">Aktif <i class='fa fa-sort fa-sm'></i></a></th>
                                  <?php endif; ?>-->
                                  <th>Nama Pengelola</th>
                                  <th>Jenis Usaha</th>
                                  <th>Kategori </th>
                                  <th>Area Layanan</th>
                                  <th>Lokasi </th>
                                  <?php if ($o == 6) : ?>
                                    <th class="text-center"><a href="<?= site_url("tawa/index/$p/5") ?>">Tanggal <i class='fa fa-sort-asc fa-sm'></i></a></th>
                                  <?php elseif ($o == 5) : ?>
                                    <th class="text-center"><a href="<?= site_url("tawa/index/$p/6") ?>">Tanggal <i class='fa fa-sort-desc fa-sm'></i></a></th>
                                  <?php else : ?>
                                    <th class="text-center"><a href="<?= site_url("tawa/index/$p/5") ?>">Tanggal <i class='fa fa-sort fa-sm'></i></a></th>
                                  <?php endif; ?>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($main as $data) : ?>
                                  <tr>
                                    <td><input type="checkbox" name="id_cb[]" value="<?= $data['id'] ?>" /></td>
                                    <td align="center"><?= $data['no'] ?></td>
                                    <td align="center" nowrap="nowrap"><a href="<?= site_url("tawa/urut/$data[id]/1") ?>" class="btn bg-olive btn-box btn-sm" title="Pindah Posisi Ke Bawah"><i class="fa fa-arrow-down"></i></a> <a href="<?= site_url("tawa/urut/$data[id]/2") ?>" class="btn bg-olive btn-box btn-sm" title="Pindah Posisi Ke Atas"><i class="fa fa-arrow-up"></i></a>
                                      <!--
                                  <?php if ($data['slider'] == '1') : ?>
                                          <a href="<?= site_url("tawa/slider_off/" . $data['id']) ?>" class="btn bg-gray btn-box btn-sm"  title="Keluarkan Dari Slider"><i class="fa fa-play"></i></a>
                                          <?php else : ?>
                                          <a href="<?= site_url("tawa/slider_on/" . $data['id']) ?>" class="btn bg-gray btn-box btn-sm"  title="Tampilkan Di Slider"><i class="fa fa-eject"></i></a>
                                          <?php endif; ?>
 				-->
                                      <br />
                                      <a href="<?= site_url("tawa/form/$data[id]") ?>" class="btn btn-warning btn-box btn-sm" title="Ubah"><i class="fa fa-edit"></i></a>
                                      <?php if ($this->CI->cek_hak_akses('h')) : ?>
                                        <a href="#" data-href="<?= site_url("tawa/delete/$p/$o/$data[id]") ?>" class="btn bg-maroon btn-box btn-sm" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
                                      <?php endif; ?>
                                    </td>
                                    <td align="center">
                                      <a href="<?= site_url("tawa/layanan/$data[id]") ?>" class="btn bg-purple btn-box btn-sm" title="Data layanan"><i class="fa fa-list"></i></a>
                                      <a href="https://wa.me/+62<?= $data['no_hp_toko'] ?>?text=Assalamu'alaikum%2C%20halo%20saya%20tertarik%20dengan%20layanan%20anda%20yang%20ditawarkan%20di%20website%20desa.%20Apakah%20layanannya%20masih%20tersedia%3F" class="btn bg-green btn-box btn-sm" target="_blank" title="Hubungi"><i class="fa fa-whatsapp"></i></a>
                                      <a href="<?= site_url("tawa/lokasi_maps/" . $data['id']); ?>" data-href="#" class="btn bg-primary btn-box btn-sm" title="Lokasi"><i class="fa fa-map"></i></a>
                                      <?php if ($data['enabled'] == '2') : ?>
                                        <a href="<?= site_url("tawa/toko_lock/" . $data['id']) ?>" class="btn bg-orange btn-box btn-sm" title="Aktifkan Album"><i class="fa fa-lock"></i></a>
                                      <?php elseif ($data['enabled'] == '1') : ?>
                                        <a href="<?= site_url("tawa/toko_unlock/" . $data['id']) ?>" class="btn bg-aqua btn-box btn-sm" title="Non Aktifkan Album"><i class="fa fa-unlock"></i></a>
                                      <?php endif ?>
                                    </td>
                                    <td align="center"><label data-rel="popover" data-content="<img width=200 height=200 src=<?= AmbilGaleri($data['gambar'], 'kecil') ?>>"> <strong style="color:#03C"><?= $data['nama'] ?></strong><br /><img width=50 height=50 class="img-circle" src=<?= AmbilGaleri($data['gambar'], 'kecil') ?>></label></td>
                                    <!--<td><?= $data['aktif'] ?></td>-->
                                    <td>Pengelola: <strong><?= $data['nama_pengelola'] ?></strong> <br />
                                      Alamat : <?= $data['lokasi'] ?>
                                    </td>
                                    <td align="center"><?= $data['jenis_usaha'] ?></td>
                                    <td align="left"><?= $data['kelompok_usaha'] ?></td>
                                    <td align="left"><?= $data['area'] ?></td>
                                    <td align="left"><?= $data['lokasi'] ?></td>
                                    <td align="center"><small> daftar: </small><?= tgl_indo($data['created_at']) ?><br />
                                      <small> update: </small><?= tgl_indo($data['updated_at']) ?>
                                    </td>
                                  </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </form>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="dataTables_length">
                          <form id="paging" action="<?= site_url("toko_warga") ?>" method="post" class="form-horizontal">
                            <label> Tampilkan
                              <select name="per_page" class="form-control input-sm" onchange="$('#paging').submit()">
                                <option value="20" <?php selected($per_page, 20); ?>>20</option>
                                <option value="50" <?php selected($per_page, 50); ?>>50</option>
                                <option value="100" <?php selected($per_page, 100); ?>>100</option>
                              </select>
                              Dari <strong>
                                <?= $paging->num_rows ?>
                              </strong> Total Data </label>
                          </form>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="dataTables_paginate paging_simple_numbers">
                          <ul class="pagination">
                            <?php if ($paging->start_link) : ?>
                              <li><a href="<?= site_url("tawa/index/$paging->start_link/$o") ?>" aria-label="First"><span aria-hidden="true">Awal</span></a></li>
                            <?php endif; ?>
                            <?php if ($paging->prev) : ?>
                              <li><a href="<?= site_url("tawa/index/$paging->prev/$o") ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                            <?php endif; ?>
                            <?php for ($i = $paging->start_link; $i <= $paging->end_link; $i++) : ?>
                              <li <?= jecho($p, $i, "class='active'") ?>><a href="<?= site_url("tawa/index/$i/$o") ?>">
                                  <?= $i ?>
                                </a></li>
                            <?php endfor; ?>
                            <?php if ($paging->next) : ?>
                              <li><a href="<?= site_url("tawa/index/$paging->next/$o") ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                            <?php endif; ?>
                            <?php if ($paging->end_link) : ?>
                              <li><a href="<?= site_url("tawa/index/$paging->end_link/$o") ?>" aria-label="Last"><span aria-hidden="true">Akhir</span></a></li>
                            <?php endif; ?>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>
</div>
<?php $this->load->view('global/confirm_delete'); ?>