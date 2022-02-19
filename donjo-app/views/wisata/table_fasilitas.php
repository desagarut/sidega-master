<script type="text/javascript">
	$(function()
	{
		var keyword = <?= $keyword?> ;
		$( "#cari" ).autocomplete(
		{
			source: keyword,
			maxShowItems: 10,
		});
	});
</script>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Detail Fasilitas Wisata</h1>
    <ol class="breadcrumb">
      <li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="<?= site_url('wisata')?>">Fasilitas Wisata</a></li>
      <li class="active">
        <?= $sub['nama']?>
      </li>
    </ol>
  </section>
  
  <section class="content" id="maincontent">
  <form id="mainform" name="mainform" action="" method="post">
      <div class="row">
          <div class="col-md-12">
              <div class="box box-warning">
                <div class="box-header with-border"> <a href="<?= site_url("wisata")?>" class="btn btn-social btn-box btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"  title="Kembali Ke Daftar Album"> <i class="fa fa-arrow-circle-left "></i>Kembali </a> <a href="<?= site_url("wisata/form_fasilitas/$gallery")?>" class="btn btn-social btn-box btn-success btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"  title="Tambah Fasilitas"> <i class="fa fa-plus"></i> Tambah Fasilitas </a> </div>
              </div>
              
              <div class="row">
                <?php $this->load->view($folder_themes .'/wisata/peta_view.php') ?>
              </div>
          </div>
      </div>
      
      <div class="box box-warning collapsed-box">
        <div class="box-header"> <i class="fa fa-calendar"></i>
          <h3 class="box-title"><strong>INFO WISATA</strong></h3>
          <!-- tools box -->
          <div class="pull-right box-tools"> 
            <!-- button with a dropdown -->
            <div class="btn-group"> </div>
            <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-plus"></i> </button>
            <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i> </button>
          </div>
          <!-- /. tools --> 
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding"> 
          <!--The calendar -->
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-bordered table-striped dataTable table-hover">
                <thead class="bg-gray disabled color-palette">
                <h5><strong>INFORMASI OBJEK WISATA</strong></h5>
                  </thead>
                
                <tbody>
                  <tr>
                    <td width="8%">Nama Objek Wisata</td>
                    <td width="17%"><?=$sub['nama']?></td>
                    <td width="8%">Nomor Telepon</td>
                    <td width="17%"> 0
                      <?=$sub['no_hp_pengelola']?></td>
                    <td width="8%">Jumlah Karyawan</td>
                    <td width="17%"><?=$sub['jumlah_karyawan']?></td>
                  </tr>
                  <tr>
                    <td width="8%">Kepemilikan Objek Wisata</td>
                    <td width="17%"><?=$sub['kepemilikan_objek_wisata']?></td>
                    <td width="8%">Lokasi Wisata</td>
                    <td width="17%"><?=$sub['lokasi']?></td>
                    <td width="8%">Keterangan Lokasi Wisata</td>
                    <td width="17%"><?=$sub['keterangan_lokasi']?></td>
                  </tr>
                  <tr>
                    <td width="8%">Sumber Modal</td>
                    <td width="17%"><?=$sub['sumber_dana']?></td>
                    <td width="8%">Taksiran Modal/Aset</td>
                    <td width="17%"><?=$sub['taksiran_modal']?></td>
                    <td width="8%">Taksiran Omset</td>
                    <td width="17%"><?=$sub['taksiran_omset']?></td>
                  </tr>
                  <tr>
                    <td width="8%">Jenis Wisata</td>
                    <td width="17%"><?=$sub['jenis_wisata']?></td>
                    <td width="8%">Daya Tarik Utama</td>
                    <td width="17%"><?=$sub['daya_tarik_utama']?></td>
                    <td width="8%">Luas Area</td>
                    <td width="17%"><?=$sub['luas_area']?></td>
                  </tr>
                  <tr>
                    <td width="8%">Jarak Tempuh</td>
                    <td width="17%"><?=$sub['jarak_tempuh']?></td>
                    <td width="8%">Waktu Tempuh</td>
                    <td width="17%"><?=$sub['waktu_tempuh']?></td>
                    <td width="8%">Cara Tempuh</td>
                    <td width="17%"><?=$sub['cara_tempuh']?></td>
                  </tr>
                </tbody>
              </table>
              
              <table class="table table-bordered table-striped dataTable table-hover">
                <thead class="bg-orange disabled color-palette">
                <h5><strong>INFORMASI SOSIAL MEDIA</strong></h5>
                  </thead>
                
                <tbody>
                  <tr>
                    <td width="8%">Website</td>
                    <td width="17%"><?=$sub['website']?></td>
                    <td width="8%">Facebook</td>
                    <td width="17%"><?=$sub['fb']?></td>
                    <td width="8%">-</td>
                    <td width="17%">-</td>
                  </tr>
                  <tr>
                    <td width="8%">Instagram</td>
                    <td width="17%"><?=$sub['ig']?></td>
                    <td width="8%">Channel Youtube</td>
                    <td width="17%"><?=$sub['youtube']?></td>
                    <td width="8%">-</td>
                    <td width="17%"><?=$sub['']?></td>
                  </tr>
                </tbody>
              </table>
              
              <table class="table table-bordered table-striped dataTable table-hover">
                <thead class="bg-gray disabled color-palette">
                <h5><strong>PERIZINAN</strong></h5>
                  </thead>
                
                <tbody>
                <tr>
                  <td width="8%">SKDU</td>
                  <td width="17%"><?=$sub['skdu']?></td>
                  <td width="8%">IUD</td>
                  <td width="17%"><?=$sub['iud']?></td>
                  <td width="8%">NPWP</td>
                  <td width="17%"><?=$sub['npwp']?></td>
                </tr>
                <tr>
                  <td width="8%">SITU</td>
                  <td width="17%"><?=$sub['situ']?></td>
                  <td width="8%">SIUI</td>
                  <td width="17%"><?=$sub['siui']?></td>
                  <td width="8%">SIP</td>
                  <td width="17%"><?=$sub['sip']?></td>
                </tr>
                <tr>
                  <td width="8%">SIUP</td>
                  <td width="17%"><?=$sub['siup']?></td>
                  <td width="8%">TDP</td>
                  <td width="17%"><?=$sub['tdp']?></td>
                  <td width="8%">TDI</td>
                  <td width="17%"><?=$sub['tdi']?></td>
                </tr>
                <tr>
                  <td width="8%">IMB</td>
                  <td width="17%"><?=$sub['imb']?></td>
                  <td width="8%">BPOM</td>
                  <td width="17%"><?=$sub['bpom']?></td>
                  <td width="8%">HO</td>
                  <td width="17%"><?=$sub['ho']?></td>
                </tr>
                </tbody>
              </table>
              
            </div>
          </div>
        </div>
      </div>
      
      <div class="box box-warning">
          <div class="box-header with-border"><i class="fa fa-list"></i>
            <h3 class="box-title"><strong>DETAIL FASILITAS</strong></h3>
            <!-- tools box -->
            <div class="pull-right box-tools"> 
            <!-- button with a dropdown -->
            <div class="btn-group"> </div>
            <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i> </button>
            <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i> </button>
            </div>
            <!-- /. tools --> 
            </div>
          
          <div class="box-body">
              <div class="row">
              <div class="col-sm-12">
              <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                  <form id="mainform" name="mainform" action="" method="post">
                    <div class="row">
                      <div class="col-sm-6">
                        <select class="form-control input-sm " name="filter" onchange="formAction('mainform', '<?= site_url("wisata/filter/$gallery")?>')">
                          <option value="">Semua</option>
                          <option value="1" <?php if ($filter==1): ?>selected<?php endif ?>>Aktif</option>
                          <option value="2" <?php if ($filter==2): ?>selected<?php endif ?>>Tidak Aktif</option>
                        </select>
                        <?php if ($this->CI->cek_hak_akses('h')): ?>
                        <a href="#confirm-delete" title="Hapus Data" onclick="deleteAllBox('mainform', '<?= site_url("wisata/delete_all_fasilitas/$gallery")?>')" class="btn btn-social btn-box btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hapus-terpilih"><i class='fa fa-trash-o'></i> Hapus Data Terpilih</a>
                        <?php endif; ?>
<a href="<?= site_url("wisata/form_fasilitas/$gallery")?>" class="btn btn-social btn-box btn-success btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"  title="Tambah Fasilitas"> <i class="fa fa-plus"></i> Tambah Fasilitas </a>
                      </div>
                      <div class="col-sm-6">
                        <div class="box-tools">
                          <div class="input-group input-group-sm pull-right">
                            <input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?=html_escape($cari)?>" onkeypress="if (event.keyCode == 13):$('#'+'mainform').attr('action', '<?= site_url('wisata/search/$gallery')?>');$('#'+'mainform').submit();endif">
                            <div class="input-group-btn">
                              <button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action', '<?= site_url("wisata/search/$gallery")?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="table-responsive">
                          <table class="table table-bordered table-striped dataTable table-hover">
                            <thead class="bg-orange">
                              <tr>
                                <th><input type="checkbox" id="checkall"/></th>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>Foto</th>
                                <?php if ($o==2): ?>
                                <th><a href="<?= site_url("wisata/fasilitas/$gallery/$p/1")?>">Nama Fasilitas <i class='fa fa-sort-asc fa-sm'></i></a></th>
                                <?php elseif ($o==1): ?>
                                <th><a href="<?= site_url("wisata/fasilitas/$gallery/$p/2")?>">Nama Fasilitas <i class='fa fa-sort-desc fa-sm'></i></a></th>
                                <?php else: ?>
                                <th><a href="<?= site_url("wisata/fasilitas/$gallery/$p/1")?>">Nama Fasilitas <i class='fa fa-sort fa-sm'></i></a></th>
                                <?php endif; ?>
                                <th>Tiket/Harga/Biaya</th>
                                <th>Deskripsi</th>
                                <?php if ($o==4): ?>
                                <th nowrap><a href="<?= site_url("wisata/fasilitas/$gallery/$p/3")?>">Aktif <i class='fa fa-sort-asc fa-sm'></i></a></th>
                                <?php elseif ($o==3): ?>
                                <th nowrap><a href="<?= site_url("wisata/fasilitas/$gallery/$p/4")?>">Aktif <i class='fa fa-sort-desc fa-sm'></i></a></th>
                                <?php else: ?>
                                <th nowrap><a href="<?= site_url("wisata/fasilitas/$gallery/$p/3")?>">Aktif <i class='fa fa-sort fa-sm'></i></a></th>
                                <?php endif; ?>
                                <?php if ($o==6): ?>
                                <th nowrap><a href="<?= site_url("wisata/fasilitas/$gallery/$p/5")?>">Dimuat Pada <i class='fa fa-sort-asc fa-sm'></i></a></th>
                                <?php elseif ($o==5): ?>
                                <th nowrap><a href="<?= site_url("wisata/fasilitas/$gallery/$p/6")?>">Dimuat Pada <i class='fa fa-sort-desc fa-sm'></i></a></th>
                                <?php else: ?>
                                <th nowrap><a href="<?= site_url("wisata/fasilitas/$gallery/$p/5")?>">Dimuat Pada <i class='fa fa-sort fa-sm'></i></a></th>
                                <?php endif; ?>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($fasilitas_data as $data): ?>
                              <tr>
                                <td><input type="checkbox" name="id_cb[]" value="<?=$data['id']?>" /></td>
                                <td><?=$data['no']?></td>
                                <td nowrap><a href="<?=site_url("wisata/urut/$data[id]/1/$sub[id]")?>" class="btn bg-green btn-box btn-sm"  title="Pindah Posisi Ke Bawah"><i class="fa fa-arrow-down"></i></a> <a href="<?=site_url("wisata/urut/$data[id]/2/$sub[id]")?>" class="btn bg-green btn-box btn-sm"  title="Pindah Posisi Ke Atas"><i class="fa fa-arrow-up"></i></a>
                                  <?php if ($data['enabled'] == '2'): ?>
                                  <a href="<?= site_url("wisata/wisata_lock/".$data['id']."/$gallery")?>" class="btn bg-gray btn-box btn-sm"  title="Aktifkan Gambar"><i class="fa fa-lock">&nbsp;</i></a>
                                  <?php elseif ($data['enabled'] == '1'): ?>
                                  <a href="<?= site_url("wisata/wisata_unlock/".$data['id']."/$gallery")?>" class="btn bg-green btn-box btn-sm"  title="Non Aktifkan Gambar"><i class="fa fa-unlock"></i></a>
                                  <?php endif ?>
                                  <br/>
                                  <?php if ($this->CI->cek_hak_akses('h')): ?>
                                  <a href="<?= site_url("wisata/form_fasilitas/$gallery/$data[id]")?>" class="btn bg-orange btn-box btn-sm"  title="Ubah"><i class="fa fa-edit"></i></a> <a href="#" data-href="<?= site_url("wisata/delete_fasilitas/$gallery/$data[id]")?>" class="btn bg-maroon btn-box btn-sm"  title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
                                  <?php endif; ?></td>
                                <td class="text-center"><label data-rel="popover" data-content="<img width=200 height=200 src=<?= AmbilGaleri($data['gambar'], 'kecil') ?>>"> <img width=50 height=50 class="img-circle" src=<?= AmbilGaleri($data['gambar'], 'kecil') ?>></label></td>
                                <td><label data-rel="popover" data-content="<img width=200 height=134 src=<?= AmbilGaleri($data['gambar'], 'kecil') ?>>">
                                    <?= $data['nama']?>
                                  </label></td>
                                <td><?= $data['sebutan_biaya']?> <?= $rupiah($data['harga'])?> / <?= $data['sebutan_ukuran']?></td>
                                <td><?=$data['deskripsi']?></td>
                                <td><?= $data['aktif']?></td>
                                <td nowrap><?= tgl_indo2($data['tgl_upload'])?></td>
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
                        <form id="paging" action="<?= site_url("wisata/fasilitas/$gallery")?>" method="post" class="form-horizontal">
                          <label> Tampilkan
                            <select name="per_page" class="form-control input-sm" onchange="$('#paging').submit()">
                              <option value="20" <?php selected($per_page, 20); ?> >20</option>
                              <option value="50" <?php selected($per_page, 50); ?> >50</option>
                              <option value="100" <?php selected($per_page, 100); ?> >100</option>
                            </select>
                            Dari <strong>
                            <?= $paging->num_rows?>
                            </strong> Total Data </label>
                        </form>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                          <?php if ($paging->start_link): ?>
                          <li><a href="<?= site_url("wisata/fasilitas/$wisata/$paging->start_link/$o")?>" aria-label="First"><span aria-hidden="true">Awal</span></a></li>
                          <?php endif; ?>
                          <?php if ($paging->prev): ?>
                          <li><a href="<?= site_url("wisata/fasilitas/$wisata/$paging->prev/$o")?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                          <?php endif; ?>
                          <?php for ($i=$paging->start_link;$i<=$paging->end_link;$i++): ?>
                          <li <?=jecho($p, $i, "class='active'")?>><a href="<?= site_url("wisata/fasilitas/$wisata/$i/$o")?>">
                            <?= $i?>
                            </a></li>
                          <?php endfor; ?>
                          <?php if ($paging->next): ?>
                          <li><a href="<?= site_url("wisata/fasilitas/$wisata/$paging->next/$o")?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                          <?php endif; ?>
                          <?php if ($paging->end_link): ?>
                          <li><a href="<?= site_url("wisata/fasilitas/$wisata/$paging->end_link/$o")?>" aria-label="Last"><span aria-hidden="true">Akhir</span></a></li>
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
  </form>
  </section>
</div>
<?php $this->load->view('global/confirm_delete');?>
