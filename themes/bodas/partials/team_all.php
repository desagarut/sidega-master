<div class="row">
	<div class="page-pemerintah">
		<?php foreach ($main as $data): ?>
			<div class="block-pemerintah clearfix">
				<div class="col-md-4 block-foto-pemerintah dlab-img-effect zoom-slow">
					<?php if ($data['foto']): ?>
						<img src="<?= AmbilFoto($data['foto'], "besar") ?>" class="img-responsive block-foto-pemerintah" alt="User Image" />
					<?php else: ?>
						<img src="<?= base_url() ?>assets/files/user_pict/kuser.png" class="img-responsive block-foto-pemerintah" alt="User Image" />
					<?php endif ?>
				</div>
				<div class="col-md-8 block-info-pemerintah">
					<div class="row">
						<div class="col-md-5">
							<div class="label-pemerintah">Nama :</div>
						</div>
						<div class="col-md-7">
							<div class="nama-pejabat"><?= $data['nama'] ?></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<div class="label-pemerintah">Jabatan :</div>
						</div>
						<div class="col-md-7">
							<div class="data-pejabat"><?= $data['jabatan'] ?></div>
						</div>
					</div>
					<div class="row">
						<?php if (!empty($data['pamong_nip']) and $data['pamong_nip'] != '-'): ?>
							<div class="col-md-5">
								<div class="label-pemerintah">NIP :</div>
							</div>
							<div class="col-md-7">
								<div class="data-pejabat"><?= $data['pamong_nip'] ?></div>
							</div>
						<?php else: ?>
							<div class="col-md-5">
								<div class="label-pemerintah">NIAP :</div>
							</div>
							<div class="col-md-7">
								<div class="data-pejabat"><?= $data['pamong_niap'] ?></div>
							</div>
						<?php endif; ?>
					</div>
					<div class="row">
						<div class="col-md-5">
							<div class="label-pemerintah">Tempat, Tanggal Lahir :</div>
						</div>
						<div class="col-md-7">
							<div class="data-pejabat"><?= $data['tempatlahir'] . ', ' . tgl_indo($data['tanggallahir']) ?></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<div class="label-pemerintah">Agama :</div>
						</div>
						<div class="col-md-7">
							<div class="data-pejabat"><?= $data['agama'] ?></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<div class="label-pemerintah">Pangkat / Golongan :</div>
						</div>
						<div class="col-md-7">
							<div class="data-pejabat"><?= $data['pamong_pangkat'] ?></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<div class="label-pemerintah">Pendidikan Terakhir :</div>
						</div>
						<div class="col-md-7">
							<div class="data-pejabat"><?= $data['pendidikan_kk'] ?></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<div class="label-pemerintah">Nomor SK :</div>
						</div>
						<div class="col-md-7">
							<div class="data-pejabat"><?= $data['pamong_nosk'] ?></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<div class="label-pemerintah">Tanggal SK :</div>
						</div>
						<div class="col-md-7">
							<div class="data-pejabat"><?= tgl_indo($data['pamong_tglsk']) ?></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<div class="label-pemerintah">Masa Jabatan :</div>
						</div>
						<div class="col-md-7">
							<div class="data-pejabat"><?= $data['pamong_masajab'] ?></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<div class="label-pemerintah">Status :</div>
						</div>
						<div class="col-md-7">
							<div class="data-pejabat">
								<?php if ($data['pamong_status'] == '1'): ?>
									<div title="Aktif">Aktif</div>
								<?php else: ?>
									<div title="Tidak Aktif">Tidak Aktif</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<a href="<?php echo site_url('home/tupoksi/' . $data['pamong_id']); ?>" data-remote="false" data-title="Tupoksi <?php echo $data['jabatan'] ?>" data-toggle="modal" data-target="#modalBox" class="btn btn-sm btn-info" style="float:right">Tupoksi Jabatan</a>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>