<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Identitas <?= $desa; ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda'); ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('identitas_desa'); ?>"></i> Identitas <?= $desa; ?></a></li>
			<li class="active">Ubah Identitas <?= $desa; ?></li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="row">
			<form id="mainform" action="<?= $form_action; ?>" method="POST" enctype="multipart/form-data" class="form-horizontal" id="validasi">
				<div class="col-md-3">
					<div class="box box-primary">
						<div class="box-body box-profile">
							<img class="profile-user-img img-responsive img-circle" src="<?= gambar_desa($main['logo']); ?>" alt="Logo">
							<br/>
							<p class="text-center text-bold">Lambang <?= $desa; ?></p>
							<p class="text-muted text-center text-red">(Kosongkan, jika logo tidak berubah)</p>
							<br/>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control" id="file_path" >
								<input type="file" class="hidden" id="file" name="logo">
								<input type="hidden" name="old_logo" value="<?= $main['logo']; ?>">
								<span class="input-group-btn">
									<button type="button" class="btn btn-info btn-box" id="file_browser"><i class="fa fa-search"></i> Browse</button>
								</span>
							</div>
						</div>
					</div>
					<div class="box box-primary">
						<div class="box-body box-profile">
							<img class="img-responsive" src="<?= gambar_desa($main['kantor_desa'], TRUE); ?>" alt="Kantor <?= $desa; ?>">
							<br/>
							<p class="text-center text-bold">Kantor <?= $desa; ?></p>
							<p class="text-muted text-center text-red">(Kosongkan, jika kantor <?= $desa; ?> tidak berubah)</p>
							<br/>
							<div class="input-group input-group-sm">
								<input type="text" class="form-control" id="file_path2" >
								<input type="file" class="hidden" id="file2" name="kantor_desa">
								<input type="hidden" name="old_kantor_desa" value="<?= $main['kantor_desa']; ?>">
								<span class="input-group-btn">
									<button type="button" class="btn btn-info btn-box" id="file_browser2"><i class="fa fa-search"></i> Browse</button>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="box box-primary">
						<div class="box-header with-border">
							<a href="<?= site_url('identitas_desa'); ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Data <?= $desa; ?>"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Data Identitas <?= $desa; ?></a>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="nama">Nama <?= $desa; ?></label>
								<div class="col-sm-8">
									<input id="nama_desa" name="nama_desa" class="form-control input-sm nama_terbatas required" maxlength="50" type="text" placeholder="Nama <?= $desa; ?>" value="<?= $main["nama_desa"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="kode_desa">Kode <?= $desa; ?></label>
								<div class="col-sm-2">
									<input id="kode_desa" name="kode_desa" class="form-control input-sm bilangan required"  minlength="10" maxlength="10" type="text" placeholder="Kode <?= $desa; ?>" value="<?= $main["kode_desa"]; ?>" ></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="kode_pos">Kode Pos <?= $desa; ?></label>
								<div class="col-sm-2">
									<input id="kode_pos" name="kode_pos" class="form-control input-sm number" minlength="5" maxlength="5" type="text" placeholder="Kode Pos <?= $desa; ?>" value="<?= $main["kode_pos"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="nama_kepala_desa">Kepala <?= $desa; ?></label>
								<div class="col-sm-8">
									<input id="nama_kepala_desa" name="nama_kepala_desa" class="form-control input-sm nama required" maxlength="50" type="text" placeholder="Kepala <?= $desa; ?>" value="<?= $main["nama_kepala_desa"]?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="nip_kepala_desa">NIP Kepala <?=$desa; ?></label>
								<div class="col-sm-8">
									<input id="nip_kepala_desa" name="nip_kepala_desa" class="form-control input-sm nomor_sk" maxlength="50" type="text" placeholder="NIP Kepala <?= $desa; ?>" value="<?= $main["nip_kepala_desa"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="alamat_kantor">Alamat Kantor <?= $desa; ?></label>
								<div class="col-sm-8">
									<textarea id="alamat_kantor" name="alamat_kantor" class="form-control input-sm alamat required" maxlength="100" placeholder="Alamat Kantor <?= $desa; ?>" rows="3" style="resize:none;"><?= $main["alamat_kantor"]; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="email_desa">E-Mail <?= $desa; ?></label>
								<div class="col-sm-8">
									<input id="email_desa" name="email_desa" class="form-control input-sm email" maxlength="50" type="text" placeholder="E-Mail <?= $desa; ?>" value="<?= $main["email_desa"]?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="telepon">Telpon <?= $desa; ?></label>
								<div class="col-sm-8">
									<input id="telepon" name="telepon" class="form-control input-sm bilangan" type="text" maxlength="15" placeholder="Telpon <?= $desa; ?>" value="<?= $main["telepon"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="website">Website <?= $desa; ?></label>
								<div class="col-sm-8">
									<input id="website" name="website" class="form-control input-sm url" maxlength="50" type="text" placeholder="Website <?= $desa; ?>" value="<?= $main["website"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="nama_kecamatan">Nama <?= $kecamatan; ?></label>
								<div class="col-sm-8">
									<input id="nama_kecamatan" name="nama_kecamatan" class="form-control input-sm nama_terbatas required" maxlength="50" type="text" placeholder="Nama <?= $kecamatan; ?>" value="<?= $main["nama_kecamatan"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="kode_kecamatan">Kode <?= $kecamatan; ?></label>
								<div class="col-sm-2">
									<input id="kode_kecamatan" name="kode_kecamatan" class="form-control input-sm bilangan required" type="text" minlength="6" maxlength="6" placeholder="Kode <?= $kecamatan; ?>" value="<?= $main['kode_kecamatan']; ?>" ></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="nama_kecamatan">Nama <?= ucwords($this->setting->sebutan_camat)?></label>
								<div class="col-sm-8">
									<input id="nama_kepala_camat" name="nama_kepala_camat" class="form-control input-sm nama required" maxlength="50" type="text" placeholder="Nama <?= ucwords($this->setting->sebutan_camat); ?>" value="<?= $main["nama_kepala_camat"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="nip_kepala_camat">NIP <?= ucwords($this->setting->sebutan_camat); ?></label>
								<div class="col-sm-4">
									<input id="nip_kepala_camat" name="nip_kepala_camat" class="form-control input-sm nomor_sk" maxlength="50" type="text" placeholder="NIP <?= ucwords($this->setting->sebutan_camat)?>" value="<?= $main["nip_kepala_camat"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="nama_kabupaten">Nama <?= $kabupaten; ?></label>
								<div class="col-sm-8">
									<input id="nama_kabupaten" name="nama_kabupaten" class="form-control input-sm nama_terbatas required" maxlength="50" type="text" placeholder="Nama <?= $kabupaten; ?>" value="<?= $main["nama_kabupaten"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="kode_kabupaten">Kode <?= $kabupaten; ?></label>
								<div class="col-sm-2">
									<input id="kode_kabupaten" name="kode_kabupaten" class="form-control input-sm bilangan required" minlength="4" maxlength="4" type="text" placeholder="Kode <?= $kabupaten; ?>" value="<?= $main["kode_kabupaten"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="propinsi">Provinsi</label>
								<div class="col-sm-4">
									<select name="nama_propinsi" class="form-control select2 input-sm required" onchange="$('input[name=kode_propinsi]').val($(this).find(':selected').data('kode'));" style="width: 100%;">
										<option value="">Pilih Provinsi</option>
										<?php foreach ($list_provinsi AS $data): ?>
											<option value="<?= $data['nama']; ?>" data-kode="<?= $data['kode']; ?>" <?= selected(strtolower($main['nama_propinsi']), strtolower($data['nama'])); ?>><?= $data['nama']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="kode_propinsi">Kode Provinsi</label>
								<div class="col-sm-2">
									<input id="kode_propinsi" name="kode_propinsi" class="form-control input-sm bilangan required" minlength="2" maxlength="2" type="text" placeholder="Kode Provinsi" value="<?= $main["kode_propinsi"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="batas_utara">Batas Utara <?= $batas_utara; ?></label>
								<div class="col-sm-8">
									<input id="batas_utara" name="batas_utara" class="form-control input-sm nama_terbatas required" maxlength="50" type="text" placeholder="Nama Utara" value="<?= $main["batas_utara"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="batas_selatan">Batas Selatan <?= $batas_selatan; ?></label>
								<div class="col-sm-8">
									<input id="batas_selatan" name="batas_selatan" class="form-control input-sm nama_terbatas required" maxlength="50" type="text" placeholder="Nama Selatan" value="<?= $main["batas_selatan"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="batas_timur">Batas Timur <?= $batas_timur; ?></label>
								<div class="col-sm-8">
									<input id="batas_timur" name="batas_timur" class="form-control input-sm nama_terbatas required" maxlength="50" type="text" placeholder="Nama Timur" value="<?= $main["batas_timur"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="batas_barat">Batas Barat <?= $batas_barat; ?></label>
								<div class="col-sm-8">
									<input id="batas_barat" name="batas_barat" class="form-control input-sm nama_terbatas required" maxlength="50" type="text" placeholder="Nama Barat" value="<?= $main["batas_barat"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="batas_barat">Luas Wilayah </label>
								<div class="col-sm-8">
									<input id="luas_wilayah" name="luas_wilayah" class="form-control input-sm" maxlength="10" type="text" placeholder="" value="<?= $main["luas_wilayah"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="batas_barat">Ketinggian Diatas Permukaan Laut (mdpl)</label>
								<div class="col-sm-8">
									<input id="mdpl" name="mdpl" class="form-control input-sm" maxlength="50" type="text" placeholder="" value="<?= $main["mdpl"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="batas_barat">Terluar di Indonesia</label>
								<div class="col-sm-8">
									<input id="terluar_id" name="terluar_id" class="form-control input-sm" maxlength="50" type="text" placeholder="" value="<?= $main["terluar_id"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="batas_barat">Terluar di Provinsi</label>
								<div class="col-sm-8">
									<input id="terluar_prov" name="terluar_prov" class="form-control input-sm" maxlength="50" type="text" placeholder="" value="<?= $main["terluar_prov"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="batas_barat">Terluar di Kabupaten</label>
								<div class="col-sm-8">
									<input id="terluar_kab" name="terluar_kab" class="form-control input-sm" maxlength="50" type="text" placeholder="" value="<?= $main["terluar_kab"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="batas_barat">Terluar di Kecamatan</label>
								<div class="col-sm-8">
									<input id="terluar_kec" name="terluar_kec" class="form-control input-sm" maxlength="50" type="text" placeholder="" value="<?= $main["terluar_kec"]; ?>"></input>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="profil_singkat">Profil Singkat <?= $desa; ?></label>
								<div class="col-sm-8">
									<textarea id="profil_singkat" name="profil_singkat" class="form-control input-sm alamat" placeholder="Profil Singkat <?= $desa; ?>" rows="3" style="resize:auto;"><?= $main["profil_singkat"]; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="visi">Visi <?= $desa; ?></label>
								<div class="col-sm-8">
									<textarea id="visi" name="visi" class="form-control input-sm" placeholder="Visi <?= $desa; ?>" rows="3" style="resize:auto;"><?= $main["visi"]; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="misi">Misi <?= $desa; ?></label>
								<div class="col-sm-8">
									<textarea id="misi" name="misi" class="form-control input-sm" placeholder="Misi <?= $desa; ?>" rows="3" style="resize:auto;"><?= $main["misi"]; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="strategi">Strategi <?= $desa; ?></label>
								<div class="col-sm-8">
									<textarea id="strategi" name="strategi" class="form-control input-sm" placeholder="strategi <?= $desa; ?>" rows="3" style="resize:auto;"><?= $main["strategi"]; ?></textarea>
								</div>
							</div>
						</div>
						<div class='box-footer'>
							<button type='reset' class='btn btn-social btn-box btn-danger btn-sm' ><i class='fa fa-times'></i> Batal</button>
							<button type='submit' class='btn btn-social btn-box btn-info btn-sm pull-right'><i class='fa fa-check'></i> Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>
</div>
