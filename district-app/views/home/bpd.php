<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="box box-success box-solid">
    <div class="box-body">
        <div class="row text-center" style="padding-top:20px">
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('bpd_buku_tamu') ?><?php endif; ?>" title="Buku Tamu"><i class="fa fa-users text-green"></i> Buku Tamu</a>
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('bpd_buku_aspirasi') ?><?php endif; ?>" title="Buku Aspirasi"><i class="fa fa-folder text-yellow"></i> Buku Aspirasi</a>
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('bpd_buku_anggota') ?><?php endif; ?>" title="Buku Kegiatan"></span><i class="fa fa-user text-primary"></i> Buku Anggota</a>
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('bpd_buku_kegiatan') ?><?php endif; ?>" title="Buku Anggota"></span><i class="fa fa-bar-chart text-warning"></i> Buku Kegiatan</a>
        </div>
    </div>
</div>