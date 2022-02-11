<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<aside class="main-sidebar">
	<section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?= gambar_desa($desa['logo']); ?>" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<strong><?= ucwords($this->setting->sebutan_desa . " " . $desa['nama_desa']); ?></strong>
				</br>
				<?php
					$seb_kec = $this->setting->sebutan_kecamatan;
					$nam_kec = $desa['nama_kecamatan'];
					$seb_kab = $this->setting->sebutan_kabupaten;
					$nam_kab = $desa['nama_kabupaten'];
				?>
				<?php	if (strlen($nam_kec)<=12 AND strlen($nam_kab)<=12): ?>
					<?= ucwords($seb_kec . " ".$nam_kec); ?>
					</br>
					<?= ucwords($seb_kab." ".$nam_kab); ?>
				<?php	else: ?>
					<?= ucwords(substr($seb_kec, 0, 3) . ". " . $nam_kec); ?>
					</br>
					<?= ucwords(substr($seb_kab, 0, 3).". " . $nam_kab); ?>
				<?php	endif; ?><br/>
                <?php //$this->load->view('jam.php');?>
            </div>		
        </div>

		<ul class="sidebar-menu" data-widget="tree">
			<!--<li class="header">MENU UTAMA</li>-->
			<?php foreach ($modul AS $mod): ?>
				<?php if ($this->CI->cek_hak_akses('b', $mod['url'])): ?>
					<?php if (count($mod['submodul'])==0): ?>
						<li class="<?= jecho($this->modul_ini, $mod['id'], 'active'); ?>">
							<a href="<?= site_url("$mod[url]"); ?>">
								<i class="fa <?= $mod['ikon']; ?> <?= jecho($this->modul_ini, $mod['id'], 'text-aqua'); ?>"></i><span><?= $mod['modul']; ?></span>
								<span class="pull-right-container"></span>
							</a>
						</li>
					<?php else : ?>
						<li class="treeview <?= jecho($this->modul_ini, $mod['id'], 'active'); ?>">
							<a href="<?= site_url("$mod[url]"); ?>">
								<i class="fa <?= $mod['ikon']; ?> <?= jecho($this->modul_ini, $mod['id'], 'text-aqua'); ?>"></i><span><?= $mod['modul']; ?></span>
								<span class="pull-right-container"><i class='fa fa-angle-left pull-right'></i></span>
							</a>
							<ul class="treeview-menu <?= jecho($this->modul_ini, $mod['id'], 'active'); ?>">
								<?php foreach ($mod['submodul'] as $submod): ?>
									<li class="<?= jecho($this->sub_modul_ini, $submod['id'], 'active'); ?>">
										<a href="<?= site_url("$submod[url]"); ?>">
											<i class="fa <?= ($submod['ikon'] != NULL) ? $submod['ikon'] : 'fa-circle-o'; ?> <?= jecho($this->sub_modul_ini, $submod['id'], 'text-red'); ?>"></i>
											<?= $submod['modul']; ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</li>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</section>
</aside>

