<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="tab-pane" id="bantuan">
<link rel="stylesheet" href="<?= base_url()?>assets/bootstrap/css/jquery-ui.min.css">
<script src="<?= base_url()?>assets/bootstrap/js/jquery-ui.min.js"></script>

<script>
	function show_kartu_peserta(elem){
		var id = elem.attr('target');
		var title = elem.attr('title');
		var url = elem.attr('href');
		$('#'+id+'').remove();

		$('body').append('<div id="'+id+'" title="'+title+'" style="display:none;position:relative;overflow:scroll;"></div>');

		$('#'+id+'').dialog({
			resizable: true,
			draggable: true,
			width: 500,
			height: 'auto',
			open: function(event, ui) {
				$('#'+id+'').load(url);
			}
		});
		$('#'+id+'').dialog('open');
	}
</script>

                <div class="box-header with-border">
                    <h3 class="box-title">Program Bantuan</h3>
                </div>


                <div class="box-body">
                    <?php if ($bantuan_penduduk) : ?>
                        <i class="fa fa-caret-right"></i> <b>SASARAN PENDUDUK</b>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="1">No.</th>
                                        <th class="text-center" width="1">Aksi</th>
                                        <th>Masa Program</th>
                                        <th>Nama Program</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($bantuan_penduduk as $no => $bantuan) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no + 1; ?></td>
                                        <td nowrap>
                                            <?php if($bantuan['no_id_kartu']) : ?>
                                                <button type="button" target="data_peserta" title="Data Peserta" href="<?= site_url("mandiri_web/kartu_peserta/tampil/$bantuan[id]")?>" onclick="show_kartu_peserta($(this));" class="btn btn-success btn-box btn-sm" ><i class="fa fa-eye"></i></button>
                                                <a href="<?= site_url("mandiri_web/kartu_peserta/unduh/$bantuan[id]")?>" class="btn bg-black btn-box btn-sm" title="Kartu Peserta" <?php empty($bantuan['kartu_peserta']) and print('disabled')?>><i class="fa fa-download"></i></a>
                                            <?php endif; ?>
                                        </td>
                                        <td nowrap><?= fTampilTgl($bantuan["sdate"], $bantuan["edate"]);?></td>
                                        <td><?= $bantuan['nama']?></td>
                                        <td width="60%"><?= $bantuan["ndesc"];?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <span>Maaf Anda saat ini tidak terdaftar dalam program bantuan apapun</span>
                    <?php endif; ?>
                </div>
</div>
