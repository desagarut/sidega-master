<?php ?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Manual Input Tagihan SPPT PBB</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Input Tagihan SPPT PBB</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="row">
            <div class="col-md-3">
                <?php $this->load->view('data_sppt/menu.php')?>
            </div>
			<div class="col-md-9">
				<div class="box box-info">
					<div class="box-header">
                        <h3>Tambah Tagihan SPPT PBB</h3>
					</div>
                    <!-- MODAL ADD GLOBAL-->
                    <div class="box-body">
                        <form class="form-horizontal">
                            <div class="box box-header">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" >Tahun</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm " id="Tahun" name="Tahun" placeholder="Tahun"/>
                                    </div>
                                </div>
            
                                <div class='form-group'>
                                    <label class="col-sm-3 control-label" >Kategori Warga</label>
                                    <div class="col-sm-8">
                                    <form action="" id="main" name="main" method="POST" class="form-horizontal">
                                        <div class="btn-group col-sm-9 kiri" data-toggle="buttons">
                                            <label class="btn btn-info btn-box btn-sm col-sm-6 form-check-label <?php (empty($sppt) or $sppt["jenis_wp"] == 1) and print('active') ?>">
                                                <input type="radio" name="jenis_wp" class="form-check-input" value="1" autocomplete="off" <?php selected((empty($sppt) or $sppt["jenis_wp"] == 1), true, true)?> onchange="pilih_wp(this.value);">Terdata
                                            </label>
                                            <label class="btn btn-info btn-box btn-sm col-sm-6 form-check-label <?= ($sppt["jenis_wp"] == 2) and print('active') ?>">
                                                <input type="radio" name="jenis_wp" class="form-check-input" value="2" autocomplete="off" <?php selected(($sppt["jenis_wp"] == 2), true, true)?> onchange="pilih_wp(this.value);">Tidak Terdata
                                            </label>
                                        </div>
                                    
                                        <div id="warga_desa">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" >Cari Nama/Alamat Tagih</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control input-sm select2" style="width: 100%;" id="nik" name="nik" onchange="ubah_wajib_pajak($('#jenis_wp').val());">
                                                        <option value="">-- Silakan Masukan NIK / Nama --</option>
                                                        <?php foreach ($penduduk as $item): ?>
                                                            <option value="<?= $item['id']?>" <?php selected($wajib_pajak['nik'], $item['id'])?>>Nama : <?= $item['nama']." Alamat : ".$item['info']?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php if ($wajib_pajak): ?>
                                                <div class="form-group">
                                                    <label for="nama" class="col-sm-3 control-label">Wajib Pajak</label>
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Nama Penduduk</label>
                                                            <div class="col-sm-9">
                                                                <input  class="form-control input-sm" type="text" placeholder="Nama Wajib Pajak" value="<?= $wajib_pajak["nama"] ?>" disabled >
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">NIK Wajib Pajak</label>
                                                            <div class="col-sm-9">
                                                                <input  class="form-control input-sm" type="text" placeholder="NIK Wajib Pajak" value="<?= $wajib_pajak["nik"] ?>" disabled >
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="alamat"  class="col-sm-3 control-label">Alamat Wajib Pajak</label>
                                                            <div class="col-sm-9">
                                                                <textarea  class="form-control input-sm" placeholder="Alamat Wajib Pajak" disabled><?= "RT ".$wajib_pajak["rt"]." / RT ".$wajib_pajak["rw"]." - ".strtoupper($wajib_pajak["dusun"]) ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                    </form>
                                </div>
            
                                <div class='form-group' id="Pendapatan">
                                    <label class="col-sm-3 control-label" >Kode Rincian</label>
                                    <div class="col-sm-8">
                                        <select class="form-control input-sm" id="Kd_Rincian_pd" name="Kd_Rincian_pd">
                                            <option value="">Pilih Rekening Pendapatan</option>
                                            <?php foreach ($lpendapatan as $data): ?>
                                                <option value="<?= $data['Jenis']?> <?= $data['Nama_Jenis']?>" <?php selected($main['Kd_Rincian'], $data['Jenis']); ?>><?= $data['Jenis'] ?> <?= $data['Nama_Jenis']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
            
                                <div class='form-group' id="Belanja">
                                    <label class="col-sm-3 control-label" >Kode Kegiatan</label>
                                    <div class="col-sm-8">
                                        <select class="form-control input-sm" id="Kd_Keg" name="Kd_Keg">
                                            <option value="">Pilih Rekening Belanja</option>
                                            <?php foreach ($lbelanja as $data): ?>
                                                <option value="<?= $data['Kd_Bid']?> <?= $data['Nama_Bidang']?>" <?php selected($main['Kd_Keg'], $data['Kd_Bid']); ?>><?= $data['Kd_Bid'] ?> <?= $data['Nama_Bidang']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
            
                                <div class='form-group' id="Pembiayaan">
                                    <label class="col-sm-3 control-label" >Kode Rincian</label>
                                    <div class="col-sm-8">
                                        <select class="form-control input-sm" id="Kd_Rincian_by" name="Kd_Rincian_by">
                                            <option value="">Pilih Rekening Pembiayaan</option>
                                            <?php foreach ($lbiaya as $data): ?>
                                                <option value="<?= $data['Jenis']?> <?= $data['Nama_Jenis']?>" <?php selected($main['Kd_Rincian'], $data['Jenis']); ?>><?= $data['Jenis'] ?> <?= $data['Nama_Jenis']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" >Nilai Anggaran</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm " id="Nilai_Anggaran" name="Nilai_Anggaran" placeholder="Nilai Anggaran"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" >Nilai Realisasi</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm " id="Nilai_Realisasi" name="Nilai_Realisasi" placeholder="Nilai Realisasi"/>
                                    </div>
                                </div>
                            </div>
            
                            <div class="modal-footer">
                                <button class="btn btn-social btn-box btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><i class='fa fa-sign-out'></i> Tutup</button>
                                <button class="btn btn-social btn-box btn-info btn-sm" id="btn_simpan"><i class='fa fa-check'></i>Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!--END MODAL ADD GLOBAL-->
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('global/confirm_delete');?>

<!-- MODAL EDIT GLOBAL-->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 class="modal-title" id="myModalLabel">Ubah Anggaran / Realisasi</h3>
			</div>
			<form class="form-horizontal">
				<div class="modal-body">
					<div class="box box-info"></div>

					<input type="hidden" id="id2" name="id_edit"/>

					<div class="form-group">
						<label class="col-sm-3 control-label" >Tahun</label>
						<div class="col-sm-8">
							<input type="text" class="form-control input-sm " id="Tahun2" name="Tahun_edit" placeholder="Tahun"/>
						</div>
					</div>

					<div class='form-group'>
						<label class="col-sm-3 control-label" >Jenis Anggaran</label>
						<div class="col-sm-8">
							<select class="form-control input-sm " id="Kd_Akun2" name="Kd_Akun_edit" disabled>
								<option value="">Pilih Jenis Anggaran</option>
								<?php foreach ($lakun as $data): ?>
									<option value="<?= $data['Akun']?><?= $data['Nama_Akun']?>" <?php selected($main['Kd_Akun'], $data['Akun']); ?>><?= $data['Akun'] ?><?= $data['Nama_Akun']?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>

					<div class='form-group' id="Pendapatan_edit">
						<label class="col-sm-3 control-label" >Kode Rincian</label>
						<div class="col-sm-8">
							<select class="form-control input-sm" id="Kd_Rincian2_pd" name="Kd_Rincian_edit_pd">
								<option value="">Pilih Rekening Pendapatan</option>
								<?php foreach ($lpendapatan as $data): ?>
									<option value="<?= $data['Jenis']?> <?= $data['Nama_Jenis']?>" <?php selected($main_pd['Kd_Rincian'], $data['Jenis']); ?>><?= $data['Jenis'] ?> <?= $data['Nama_Jenis']?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>

					<div class='form-group' id="Belanja_edit">
						<label class="col-sm-3 control-label" >Kode Kegiatan</label>
						<div class="col-sm-8">
							<select class="form-control input-sm" id="Kd_Keg2_bl" name="Kd_Keg_edit_bl">
								<option value="">Pilih Rekening Belanja</option>
								<?php foreach ($lbelanja as $data): ?>
									<option value="<?= $data['Kd_Bid']?> <?= $data['Nama_Bidang']?>" <?php selected($main_bl['Kd_Keg'], $data['Kd_Bid']); ?>><?= $data['Kd_Bid'] ?> <?= $data['Nama_Bidang']?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>

					<div class='form-group' id="Pembiayaan_edit">
						<label class="col-sm-3 control-label" >Kode Rincian</label>
						<div class="col-sm-8">
							<select class="form-control input-sm" id="Kd_Rincian2_by" name="Kd_Rincian_edit_by">
								<option value="">Pilih Rekening Pembiayaan</option>
								<?php foreach ($lbiaya as $data): ?>
									<option value="<?= $data['Jenis']?> <?= $data['Nama_Jenis']?>" <?php selected($main_by['Kd_Rincian'], $data['Jenis']); ?>><?= $data['Jenis'] ?> <?= $data['Nama_Jenis']?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label" >Nilai Anggaran</label>
						<div class="col-sm-8">
							<input type="text" class="form-control input-sm " id="Nilai_Anggaran2" name="Nilai_Anggaran_edit" placeholder="Nilai Anggaran"/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" >Nilai Realisasi</label>
						<div class="col-sm-8">
							<input type="text" class="form-control input-sm " id="Nilai_Realisasi2" name="Nilai_Realisasi_edit" placeholder="Nilai Realisasi"/>
						</div>
					</div>

				</div>

				<div class="modal-footer">
					<button class="btn btn-social btn-box btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><i class='fa fa-sign-out'></i> Tutup</button>
					<button class="btn btn-social btn-box btn-info btn-sm" id="btn_update"><i class='fa fa-check'></i>Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--END MODAL EDIT GLOBAL-->

<!--MODAL SALIN-->
<div class="modal fade" id="ModalSalin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
				<h4 class="modal-title" id="myModalLabel">Tambah/Salin dari Template</h4>
			</div>
			<form class="form-horizontal">
				<div class="modal-body">
					<div class="box box-info"></div>
					<div class="form-group">
						<label class="col-sm-3 control-label" >Tahun Anggaran</label>
						<div class="col-sm-3">
							<input type="text" class="form-control input-sm " id="kodetahun" name="kodetahun" placeholder="Tahun Anggaran"/>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-social btn-box btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><i class='fa fa-sign-out'></i> Tutup</button>
					<button class="btn btn-social btn-box btn-info btn-sm" id="btn_salin1"><i class='fa fa-check'></i>Salin</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--END MODAL SALIN-->

<script type="text/javascript">
$(document).ready(function(){
	//READ/SHOW
	generateTable('data_pendapatan', $('#show_data_pd') , $('#mydata_pd'));
	generateTable_belanja('data_belanja', $('#show_data_bl') , $('#mydata_bl'));
	generateTable('data_pembiayaan', $('#show_data_by') , $('#mydata_by'));

	//ADD
	saveAdd();

	//UPDATE
	getEdit($('#show_data_pd'));
	getEdit($('#show_data_bl'));
	getEdit($('#show_data_by'));
	//Simpan Edit Data
	saveEdit();

	//SALIN TEMPLATE DATA
	salinData();

	//MISC
	tools();
});
</script>


<script>
	$(document).ready(function(){
		$('#tipe').change(function(){
			var id=$(this).val();
			$.ajax({
				url : "<?=site_url('data_sppt/kelasid')?>",
				method : "POST",
				data : {id: id},
				async : true,
				dataType : 'json',
				success: function(data){
					var html = '';
					var i;
					for(i=0; i<data.length; i++){
						html += '<option value='+data[i].id+'>'+data[i].kode+' '+data[i].ndesc+'</option>';
					}
					$('#kelas').html(html);
				}
			});
			return false;
		});

		pilih_wp(<?= $sppt['jenis_wp'] ?: 1?>);

	});

	function pilih_lokasi(pilih)
	{
		if (pilih == 1)
		{
			$("#manual").hide();
			$("#pilih").show();
		}
		else
		{
			$("#manual").removeClass('hidden');
			$("#manual").show();
			$("#pilih").hide();
		}
	}

	function pilih_wp(pilih)
	{
		$('#jenis_wp').val(pilih);
		if (pilih == 1)
		{
			if ($('#nik').val() == '')
			{
				$('input[name=data_sppt]').attr('disabled','disabled');
				$('input[name=nama_wp]').attr('disabled','disabled');
			}
			$('#nama_wp_luar').val('');
			$('#nama_wp_luar').removeClass('required');
			$('#alamat_wp_luar').val('');
			$('#alamat_wp_luar').removeClass('required');
			$("#warga_luar_desa").hide();
			$('#nik').addClass('required');
			$("#warga_desa").show();
		}
		else
		{
			$('#nik').removeClass('required');
			$("#warga_desa").hide();
			$("#warga_luar_desa").show();
			$('#nama_wp_luar').addClass('required');
			$('#alamat_wp_luar').addClass('required');
			$('input[name=data_sppt]').removeAttr('disabled');
			$('input[name=nama_wp]').removeAttr('disabled');
			if ($('#nik').val() != '')
			{
				$('#nik').val('');
				$('#nik').change();
			}
		}
	}

	function ubah_wajib_pajak(jenis_wp)
	{
		$('#main').submit();
	}
</script>
