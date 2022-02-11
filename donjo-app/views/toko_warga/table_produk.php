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
    <h1>Detail UMKM</h1>
    <ol class="breadcrumb">
      <li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="<?= site_url('toko_warga')?>">Detail UMKM</a></li>
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
                <div class="box-header with-border"> <a href="<?= site_url("toko_warga/form_produk/$gallery")?>" class="btn btn-social btn-box btn-success btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"  title="Tambah Produk"> <i class="fa fa-plus"></i> Tambah Produk </a>
                <?php if ($this->CI->cek_hak_akses('h')): ?>
                <a href="#confirm-delete" title="Hapus Data" onclick="deleteAllBox('mainform', '<?= site_url("toko_warga/delete_all_produk/$gallery")?>')" class="btn btn-social btn-box btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hapus-terpilih"><i class='fa fa-trash-o'></i> Hapus Data Terpilih</a>
                <?php endif; ?>
                <a href="<?= site_url("toko_warga")?>" class="btn btn-social btn-box btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"  title="Kembali Ke Daftar Album"> <i class="fa fa-arrow-circle-left "></i>Kembali ke Daftar Toko </a> </div>
              </div>
              <div class="row">
                <?php $this->load->view($folder_themes .'/toko_warga/peta_view.php') ?>
              </div>
          </div>
      </div>
  
  
<div class="box box-warning collapsed-box">
    <div class="box-header"> <i class="fa fa-calendar"></i>
      <h3 class="box-title"><strong>INFO UMKM</strong></h3>
      <!-- tools box -->
      <div class="pull-right box-tools"> 
        <!-- button with a dropdown -->
        <div class="btn-group"> </div>
        <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i> </button>
        <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i> </button>
      </div>
      <!-- /. tools --> 
    </div>

    <div class="box-body no-padding"> 
          <!--The calendar -->
          <div class="col-sm-12">
            <div class="table-responsive">
          <table class="table table-bordered table-striped dataTable table-hover">
            <thead class="bg-gray disabled color-palette">
            </thead>
            <tbody>
            <tr>
                <td width="8%">Nama Toko</td><td width="17%"> <?=$sub['nama']?></td>
                <td width="8%">Nomor Telepon</td><td width="17%"> 0<?=$sub['no_hp_toko']?></td>
                <td width="8%">Jumlah Karyawan</td><td width="17%"> <?=$sub['jumlah_karyawan']?></td>
			      </tr>
            <tr>
                <td width="8%">Kepemilikan Tempat Usaha</td><td width="17%"> <?=$sub['kepemilikan_tempat_usaha']?></td>
                <td width="8%">Lokasi Usaha</td><td width="17%"> <?=$sub['lokasi']?></td>
                <td width="8%">Keterangan Lokasi Usaha</td><td width="17%"> <?=$sub['keterangan_lokasi']?></td>
			      </tr>
            <tr>
                <td width="8%">Sumber Modal</td><td width="17%"> <?=$sub['sumber_modal']?></td>
                <td width="8%">Taksiran Modal/Aset</td><td width="17%"> <?=$sub['taksiran_modal']?></td>
                <td width="8%">Taksiran Omset</td><td width="17%"> <?=$sub['taksiran_omset']?></td>
			      </tr>
            <tr>
                <td width="8%">Kelompok Usaha Perdagangan</td><td width="17%"> <?=$sub['kelompok_usaha_perdagangan']?></td>
                <td width="8%">Sarana Berdagang</td><td width="17%"> <?=$sub['sarana_berdagang']?></td>
                <td width="8%">Area/Kawasan Usaha</td><td width="17%"> <?=$sub['area_usaha']?></td>
			      </tr>
            <tr>
                <td width="8%">Kategori Toko</td><td width="17%"> <?=$sub['kategori_toko']?></td>
                <td width="8%">Website</td><td width="17%"> <?=$sub['website']?></td>
                <td width="8%">Facebook</td><td width="17%"> <?=$sub['fb']?></td>
			      </tr>
            <tr>
                <td width="8%">Instagram</td><td width="17%"> <?=$sub['ig']?></td>
                <td width="8%">Channel Youtube</td><td width="17%"> <?=$sub['youtube']?></td>
                <td width="8%">-</td><td width="17%"> <?=$sub['']?></td>
			      </tr>
            <tr>
                <td width="8%">SKDU</td><td width="17%"> <?=$sub['skdu']?></td>
                <td width="8%">IUD</td><td width="17%"> <?=$sub['iud']?></td>
                <td width="8%">NPWP</td><td width="17%"> <?=$sub['npwp']?></td>
			      </tr>
            <tr>
                <td width="8%">SITU</td><td width="17%"> <?=$sub['situ']?></td>
                <td width="8%">SIUI</td><td width="17%"> <?=$sub['siui']?></td>
                <td width="8%">SIP</td><td width="17%"> <?=$sub['sip']?></td>
			      </tr>
            <tr>
                <td width="8%">SIUP</td><td width="17%"> <?=$sub['siup']?></td>
                <td width="8%">TDP</td><td width="17%"> <?=$sub['tdp']?></td>
                <td width="8%">TDI</td><td width="17%"> <?=$sub['tdi']?></td>
			      </tr>
            <tr>
                <td width="8%">IMB</td><td width="17%"> <?=$sub['imb']?></td>
                <td width="8%">BPOM</td><td width="17%"> <?=$sub['bpom']?></td>
                <td width="8%">HO</td><td width="17%"> <?=$sub['ho']?></td>
			      </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

<div class="box box-warning">
    <div class="box-header with-border"><i class="fa fa-list"></i>
      <h3 class="box-title"><strong>DETAIL PRODUK</strong></h3>
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
        <select class="form-control input-sm " name="filter" onchange="formAction('mainform', '<?= site_url("toko_warga/filter/$gallery")?>')">
          <option value="">Semua</option>
          <option value="1" <?php if ($filter==1): ?>selected<?php endif ?>>Aktif</option>
          <option value="2" <?php if ($filter==2): ?>selected<?php endif ?>>Tidak Aktif</option>
        </select>
      </div>
      <div class="col-sm-6">
        <div class="box-tools">
          <div class="input-group input-group-sm pull-right">
            <input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?=html_escape($cari)?>" onkeypress="if (event.keyCode == 13):$('#'+'mainform').attr('action', '<?= site_url('toko_warga/search/$gallery')?>');$('#'+'mainform').submit();endif">
            <div class="input-group-btn">
              <button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action', '<?= site_url("toko_warga/search/$gallery")?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
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
                <th><input type="checkbox" id="checkall"/></th>
                <th>No</th>
                <th>Aksi</th>
                <th>Foto</th>
                <?php if ($o==2): ?>
                <th><a href="<?= site_url("toko_warga/produk/$gallery/$p/1")?>">Nama Produk <i class='fa fa-sort-asc fa-sm'></i></a></th>
                <?php elseif ($o==1): ?>
                <th><a href="<?= site_url("toko_warga/produk/$gallery/$p/2")?>">Nama Produk <i class='fa fa-sort-desc fa-sm'></i></a></th>
                <?php else: ?>
                <th><a href="<?= site_url("toko_warga/produk/$gallery/$p/1")?>">Nama Produk <i class='fa fa-sort fa-sm'></i></a></th>
                <?php endif; ?>
                <th>Harga</th>
                <th>Diskon</th>
                <th>Deskripsi</th>
                <?php if ($o==4): ?>
                <th nowrap><a href="<?= site_url("toko_warga/produk/$gallery/$p/3")?>">Aktif <i class='fa fa-sort-asc fa-sm'></i></a></th>
                <?php elseif ($o==3): ?>
                <th nowrap><a href="<?= site_url("toko_warga/produk/$gallery/$p/4")?>">Aktif <i class='fa fa-sort-desc fa-sm'></i></a></th>
                <?php else: ?>
                <th nowrap><a href="<?= site_url("toko_warga/produk/$gallery/$p/3")?>">Aktif <i class='fa fa-sort fa-sm'></i></a></th>
                <?php endif; ?>
                <?php if ($o==6): ?>
                <th nowrap><a href="<?= site_url("toko_warga/produk/$gallery/$p/5")?>">Dimuat Pada <i class='fa fa-sort-asc fa-sm'></i></a></th>
                <?php elseif ($o==5): ?>
                <th nowrap><a href="<?= site_url("toko_warga/produk/$gallery/$p/6")?>">Dimuat Pada <i class='fa fa-sort-desc fa-sm'></i></a></th>
                <?php else: ?>
                <th nowrap><a href="<?= site_url("toko_warga/produk/$gallery/$p/5")?>">Dimuat Pada <i class='fa fa-sort fa-sm'></i></a></th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($produk_data as $data): ?>
              <tr>
                <td><input type="checkbox" name="id_cb[]" value="<?=$data['id']?>" /></td>
                <td><?=$data['no']?></td>
                <td nowrap><a href="<?=site_url("toko_warga/urut/$data[id]/1/$sub[id]")?>" class="btn bg-olive btn-box btn-sm"  title="Pindah Posisi Ke Bawah"><i class="fa fa-arrow-down"></i></a> <a href="<?=site_url("toko_warga/urut/$data[id]/2/$sub[id]")?>" class="btn bg-olive btn-box btn-sm"  title="Pindah Posisi Ke Atas"><i class="fa fa-arrow-up"></i></a>
                  <?php if ($data['enabled'] == '2'): ?>
                  <a href="<?= site_url("toko_warga/gallery_lock/".$data['id']."/$gallery")?>" class="btn bg-navy btn-box btn-sm"  title="Aktifkan Gambar"><i class="fa fa-lock">&nbsp;</i></a>
                  <?php elseif ($data['enabled'] == '1'): ?>
                  <a href="<?= site_url("toko_warga/gallery_unlock/".$data['id']."/$gallery")?>" class="btn bg-navy btn-box btn-sm"  title="Non Aktifkan Gambar"><i class="fa fa-unlock"></i></a>
                  <?php endif ?>
                  <br/>
                  <?php if ($this->CI->cek_hak_akses('h')): ?>
                  <a href="<?= site_url("toko_warga/form_produk/$gallery/$data[id]")?>" class="btn btn-warning btn-box btn-sm"  title="Ubah"><i class="fa fa-edit"></i></a> <a href="#" data-href="<?= site_url("toko_warga/delete_produk/$gallery/$data[id]")?>" class="btn bg-maroon btn-box btn-sm"  title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
                  <?php endif; ?></td>
                <td align="center"><label data-rel="popover" data-content="<img width=200 height=200 src=<?= AmbilGaleri($data['gambar'], 'kecil') ?>>"> <img width=50 height=50 class="img-circle" src=<?= AmbilGaleri($data['gambar'], 'kecil') ?>></label></td>
                <td><label data-rel="popover" data-content="<img width=200 height=134 src=<?= AmbilGaleri($data['gambar'], 'kecil') ?>>">
                    <?= $data['nama']?>
                  </label></td>
                <td><?= $data['sebutan_biaya']?> <?= $rupiah($data['harga'])?> / <?= $data['sebutan_ukuran']?></td>
                <td><?= $data['diskon']?>
                  %</td>
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
        <form id="paging" action="<?= site_url("toko_warga/produk/$gallery")?>" method="post" class="form-horizontal">
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
          <li><a href="<?= site_url("toko_warga/produk/$toko_warga/$paging->start_link/$o")?>" aria-label="First"><span aria-hidden="true">Awal</span></a></li>
          <?php endif; ?>
          <?php if ($paging->prev): ?>
          <li><a href="<?= site_url("toko_warga/produk/$toko_warga/$paging->prev/$o")?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
          <?php endif; ?>
          <?php for ($i=$paging->start_link;$i<=$paging->end_link;$i++): ?>
          <li <?=jecho($p, $i, "class='active'")?>><a href="<?= site_url("toko_warga/produk/$toko_warga/$i/$o")?>">
            <?= $i?>
            </a></li>
          <?php endfor; ?>
          <?php if ($paging->next): ?>
          <li><a href="<?= site_url("toko_warga/produk/$toko_warga/$paging->next/$o")?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
          <?php endif; ?>
          <?php if ($paging->end_link): ?>
          <li><a href="<?= site_url("toko_warga/produk/$toko_warga/$paging->end_link/$o")?>" aria-label="Last"><span aria-hidden="true">Akhir</span></a></li>
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
<?php $this->load->view('global/confirm_delete');?>
