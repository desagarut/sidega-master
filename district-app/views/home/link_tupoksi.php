<div class="box box-success box-solid">
    <div class="box-body">
        <div class="row text-center" style="padding-top:20px">
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('u')) : ?><?= site_url('penduduk/clear') ?><?php endif; ?>" title="Pemerintahan"><i class="fa fa-users text-blue"></i>Pemerintahan</a>
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('pembangunan') ?><?php endif; ?>" title="Pembangunan"> <i class="fa fa-building text-blue"></i> Pembangunan</a>
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('pemberdayaan_masyarakat') ?><?php endif; ?>" title="Pemberdayaan Masyarakat"><span class="badge bg-aqua"></span><i class="fa fa-hand-rock-o text-blue"></i> Pemberdayaan</a><br/>
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('pembinaan_masyarakat') ?><?php endif; ?>" title="Pembinaan Kemasyarakatan"><span class="badge bg-aqua"></span><i class="fa fa-hand-paper-o text-blue"></i> Pembinaan</a>
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('bidang_bencana_darurat_mendesak') ?><?php endif; ?>" title="Kebencanaan"><span class="badge bg-aqua"></span><i class="fa fa-object-ungroup text-blue"></i>Bencana, Darurat & Mendesak</a>
        </div>
    </div>
</div>