<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.js" integrity="sha512-/F8GvcdSUiYuL8wFMLRspx/PemIOOZBMiro7M9Wwn9V/wfzIH+RwIauASTQdJqaaZdSHBP4lmtq6VH5bbTNaJw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="box box-success box-solid">&nbsp;
  <div class="box-body">
    <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('u')) : ?><?= site_url('web') ?><?php endif; ?>" title="Tulis Berita"><i class="fa fa-bullhorn text-yellow"></i>Tulis Berita</a>
    <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('surat') ?><?php endif; ?>" title="Buat Surat"> <i class="fa fa-pencil text-blue"></i> Buat Surat <span class="badge bg-green">
        <?= $jumlah_surat ?>
      </span></a>
    <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('surat_masuk') ?><?php endif; ?>" title="Surat Masuk"><span class="badge bg-aqua"></span><i class="fa fa-envelope text-green"></i> Surat Masuk </a>
    <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('u')) : ?><?= site_url('permohonan_surat_admin') ?><?php endif; ?>"> <i class="fa fa-envelope-o text-maroon"></i> Surat Online <span class="badge bg-maroon">
        <?= $permohonan_surat ?>
      </span></a>
    <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('mandiri') ?><?php endif; ?>" title="Buat PIN Layanan Mandiri Warga "> <i class="fa fa-key"></i> Buat PIN </a>
    <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('u')) : ?><?= site_url('mailbox') ?><?php endif; ?>"> <i class="fa fa-commenting-o text-maroon"></i> Pesan Warga <span class="badge bg-maroon">
        <?= $status ?>
      </span></a>
    <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('u')) : ?><?= site_url('komentar') ?><?php endif; ?>"><i class="fa fa-comments-o text-blue"></i> <span class="badge bg-blue">
        <?= $komentar ?>
      </span>Komentar </a>
    <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('data_sppt/rekap') ?><?php endif; ?>"><i class="fa fa-dollar text-green"></i> <span class="badge bg-red">
        <?php if ($this->CI->cek_hak_akses('h')) : ?>
          <?php
          if (isset($data)) {
            $d = $data->row();
          ?>
            <?= $d->terhutang ?>
          <?php
          }
          ?>
        <?php endif; ?>
      </span>SPPT PBB </a>
  </div>
</div>
