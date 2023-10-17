<div class='col-md-4'>
  <div class="box box-danger box-solid">
        <div class='box-body'>
            <div class="col-md-12">
                
              <div class="progress-group">
                <a href="<?=site_url('program_bantuan')?>" class="small-box-footer" title="Lihat Program Bantuan">
                <span class="progress-number">
                    <b><?=$bantuan['jumlah']?></b> / 
                        <?php foreach ($penduduk as $data): ?>
                        <?=$data['jumlah']?>
                        <?php endforeach; ?>
                </span></a>
                    <?php if ($this->CI->cek_hak_akses('u')): ?>
                    <a href="<?= site_url("{$this->controller}/dialog_pengaturan")?>" class="inner text-white pengaturan" title="Pengaturan Program Bantuan" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Pengaturan Program Bantuan"><i class="fa fa-gear"></i></a>
                    <p> <?=$bantuan['nama']?></p>
                    <?php endif; ?>
               
                <div class="progress sm">
                  <div class="progress-bar progress-bar-aqua" style="width: 10%"></div>
                </div>
              </div> 
              
              <div class="progress-group">
                <a href="<?=site_url('kelompok/clear')?>" class="small-box-footer" title="Lihat Daftar Kelompok Masyarakat">
                <span class="progress-number">
                    <b><?php foreach ($kelompok as $data): ?><?=$data['jumlah']?></h3><?php endforeach; ?></b> / 
                    <?php foreach ($penduduk as $data): ?><?=$data['jumlah']?><?php endforeach; ?>
                </span>
                    <p><i class="fa fa-eye"></i> Jumlah Pokmas</p>
                </a>
                <div class="progress sm">
                  <div class="progress-bar progress-bar-success" style="width: 4%"></div>
                </div>
              </div>                    
            
            </div>
        </div>
    </div>
</div>
