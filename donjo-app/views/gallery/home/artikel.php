<!-- widget Arsip Artikel -->

<style type="text/css">
	#arsip_artikel .nav > li.active > a { color: green }
	#arsip_artikel img { width: 30%; margin:0 6px 4px 0; float: left;}
	#arsip_artikel td { padding-bottom: 2px; }
</style>
<div class='col-md-4'>
  <div class='box box-success box-solid'>
    <div class="box-header with-border">
      <h3 class="box-title">Artikel</h3>
      <div class="box-tools pull-right"> <a href="<?=site_url()?>web"><span class="label label-warning">Buka</span></a>
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
	<div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <form id="mainform" name="mainform" action="" method="post">
                        <div class="row">
                            <div class="col-sm-6">
                                <select class="form-control input-sm " name="status" onchange="formAction('mainform', '<?= site_url("web/filter/status/$cat")?>')">
                                    <option value="">Semua Artikel</option>
                                    <option value="1" <?php selected($status, 1); ?>>Aktif</option>
                                    <option value="2" <?php selected($status, 2); ?>>Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <div class="box-tools">
                                    <div class="input-group input-group-sm pull-right">
                                        <input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?=html_escape($cari)?>" onkeypress="if (event.keyCode == 13):$('#'+'mainform').attr('action', '<?= site_url('web/filter/cari/$cat')?>');$('#'+'mainform').submit();endif">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action', '<?= site_url("web/filter/cari/$cat")?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered dataTable table-striped table-hover tabel-daftar">
                                        <thead class="bg-gray disabled color-palette">
                                            <tr>
                                                <th><input type="checkbox" id="checkall"/></th>
                                                <th>No</th>
                                                <th>Aksi</th>
                                                <?php if ($o==2): ?>
                                                    <th width="50%"><a href="<?= site_url("web/index/$p/1")?>">Judul <i class='fa fa-sort-asc fa-sm'></i></a></th>
                                                <?php elseif ($o==1): ?>
                                                    <th width="50%"><a href="<?= site_url("web/index/$p/2")?>">Judul <i class='fa fa-sort-desc fa-sm'></i></a></th>
                                                <?php else: ?>
                                                    <th width="50%"><a href="<?= site_url("web/index/$p/1")?>">Judul <i class='fa fa-sort fa-sm'></i></a></th>
                                                <?php endif; ?>
                                                <?php if ($o==4): ?>
                                                    <th nowrap><a href="<?= site_url("web/index/$p/3")?>">Hit <i class='fa fa-sort-asc fa-sm'></i></a></th>
                                                <?php elseif ($o==3): ?>
                                                    <th nowrap><a href="<?= site_url("web/index/$p/4")?>">Hit <i class='fa fa-sort-desc fa-sm'></i></a></th>
                                                <?php else: ?>
                                                    <th nowrap><a href="<?= site_url("web/index/$p/3")?>">Hit <i class='fa fa-sort fa-sm'></i></a></th>
                                                <?php endif; ?>
                                                <?php if ($o==6): ?>
                                                    <th nowrap><a href="<?= site_url("web/index/$p/5")?>">Diposting Pada <i class='fa fa-sort-asc fa-sm'></i></a></th>
                                                <?php elseif ($o==5): ?>
                                                    <th nowrap><a href="<?= site_url("web/index/$p/6")?>">Diposting Pada <i class='fa fa-sort-desc fa-sm'></i></a></th>
                                                <?php else: ?>
                                                    <th nowrap><a href="<?= site_url("web/index/$p/5")?>">Diposting Pada <i class='fa fa-sort fa-sm'></i></a></th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($main as $data): ?>
                                                <tr>
                                                    <td class="padat"><input type="checkbox" name="id_cb[]" value="<?=$data['id']?>" <?php $data['boleh_ubah'] or print('disabled')?> /></td>
                                                    <td class="padat"><?=$data['no']?></td>
                                                    <td class="aksi">
                                                        <?php if ($data['boleh_ubah']): ?>
                                                            <a href="<?= site_url("web/form/$data[id]")?>" class="btn bg-orange btn-box btn-sm" title="Ubah Data"><i class="fa fa-edit"></i></a>
                                                            <?php if ($this->CI->cek_hak_akses('h')): ?>
                                                                <a href="#" data-href="<?= site_url("web/delete/$data[id]")?>" class="btn bg-maroon btn-box btn-sm" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
                                                            <?php endif; ?>
                                                            <a href="<?= site_url("web/ubah_kategori_form/$data[id]")?>" class="btn bg-purple btn-box btn-sm" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Ubah Kategori" title="Ubah Kategori"><i class="fa fa-folder-open"></i></a>
                                                            <?php if ($data['boleh_komentar'] == 1): ?>
                                                                <a href="<?= site_url("web/komentar_lock/$data[id]/2")?>" class="btn bg-info btn-box btn-sm" title="Tutup Komentar Artikel"><i class="fa fa-comment-o"></i></a>
                                                            <?php else: ?>
                                                                <a href="<?= site_url("web/komentar_lock/$data[id]/1")?>" class="btn bg-info btn-box btn-sm" title="Buka Komentar Artikel"><i class="fa fa-comment"></i></a>
                                                            <?php endif ?>
                                                            <?php if ($data['enabled'] == '1'): ?>
                                                                <a href="<?= site_url("web/artikel_lock/$data[id]/2"); ?>" class="btn bg-navy btn-box btn-sm" title="Non Aktifkan Artikel"><i class="fa fa-unlock"></i></a>
                                                                <a href="<?= site_url("web/headline/$data[id]")?>" class="btn bg-teal btn-box btn-sm" title="Jadikan Headline">
                                                                    <i class="<?= ($data['headline']==1) ? 'fa fa-star-o' : 'fa fa-star' ?>"></i>
                                                                </a>
                                                                <a href="<?= site_url("web/slide/$data[id]"); ?>" class="btn bg-gray btn-box btn-sm" title="<?= ($data['headline']==3) ? 'Keluarkan dari slide' : 'Masukkan ke dalam slide' ?>">
                                                                    <i class="<?= ($data['headline']==3) ? 'fa fa-pause' : 'fa fa-play' ?>"></i>
                                                                </a>
                                                            <?php else: ?>
                                                                <a href="<?= site_url("web/artikel_lock/$data[id]/1"); ?>" class="btn bg-navy btn-box btn-sm" title="Aktifkan Artikel"><i class="fa fa-lock"></i></a>
                                                            <?php endif ?>
                                                        <?php endif; ?>
                                                        <a href="<?= site_url('artikel/'.buat_slug($data)); ?>" target="_blank" class="btn bg-green btn-box btn-sm" title="Lihat Artikel"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                    <td><?= $data['judul']?></td>
                                                    <td nowrap><?= hit($data['hit'])?></td>
                                                    <td nowrap><?= tgl_indo2($data['tgl_upload'])?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php $this->load->view('global/paging');?>
                </div>
            </div>
        </div>
	</div>
  </div>
</div>
