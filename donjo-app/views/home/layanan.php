<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.js" integrity="sha512-/F8GvcdSUiYuL8wFMLRspx/PemIOOZBMiro7M9Wwn9V/wfzIH+RwIauASTQdJqaaZdSHBP4lmtq6VH5bbTNaJw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class='col-md-4'>
  <div class="box box-success box-solid">&nbsp;
    <div class="box-body"> <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('u')): ?><?=site_url('web')?><?php endif;?>" title="Tulis Berita"><i class="fa fa-bullhorn text-yellow"></i>Tulis Berita</a> <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')): ?><?=site_url('surat')?><?php endif;?>" title="Buat Surat"> <i class="fa fa-pencil text-blue"></i> Buat Surat <span class="badge bg-green">
      <?=$jumlah_surat?>
      </span></a> <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')): ?><?=site_url('surat_masuk')?><?php endif;?>" title="Surat Masuk"><span class="badge bg-aqua"></span><i class="fa fa-envelope text-green"></i> Surat Masuk </a> <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')): ?><?=site_url('surat_keluar')?><?php endif;?>" title="Surat Keluar"> <i class="fa fa-envelope-o text-orange"></i> Surat Keluar </a> <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')): ?><?=site_url('permohonan_surat_admin')?><?php endif;?>"> <i class="fa fa-paper-plane-o text-aqua"></i> Surat Online <span class="badge bg-green">
      <?=$permohonan_surat?>
      </span> </a> <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')): ?><?=site_url('mandiri')?><?php endif;?>" title="Buat PIN Layanan Mandiri Warga "> <i class="fa fa-key"></i> Buat PIN </a> <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('u')): ?><?=site_url('mailbox')?><?php endif;?>"> <i class="fa fa-commenting-o text-maroon"></i> Pesan Warga <span class="badge bg-maroon">
      <?=$status?>
      </span></a> <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('u')): ?><?=site_url('komentar')?><?php endif;?>"><i class="fa fa-comments-o text-blue"></i> <span class="badge bg-blue">
      <?=$komentar?>
      </span>Komentar </a> <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')): ?><?=site_url('data_sppt')?><?php endif;?>"><i class="fa fa-dollar text-green"></i> <span class="badge bg-red">
      <?php if ($this->CI->cek_hak_akses('h')): ?>
      <?php 
					if(isset($data)){ 
					$d = $data->row();
					?>
      <?=$d->terhutang?>
      <?php
					}
					?>
      <?php endif;?>
      </span>SPPT PBB </a>
      <div class="btn btn-app">
        <button type='submit' class='btn btn-social btn-box btn-success btn-sm pull-center' title="Chat Group Komunitas Desa Garut" onclick="window.open('https://chat.whatsapp.com/IR2VtLpT2Fx0ujlNMm3nD9')"><i class='fa fa-whatsapp'></i>Bantuan?</button>
        <p style="font-size:9px; color:#666" align="center"><i>Komunitas Desa Garut</i></p>
      </div>
      <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('u')): ?><?=site_url('covid19_vaksin')?><?php endif;?>"><i class="fa fa-plus text-red"></i> <span class="badge bg-blue">
      </span>Vaksin Covid-19 </a> 
    </div>
  </div>
</div>
<script>                  
  function drawMouseSpeedDemo() {
    var mrefreshinterval = 500; // update display every 500ms
    var lastmousex = -1;
    var lastmousey = -1;
    var lastmousetime;
    var mousetravel = 0;
    var mpoints = [];
    var mpoints_max = 30;
    $('html').mousemove(function (e) {
      var mousex = e.pageX;
      var mousey = e.pageY;
      if (lastmousex > -1) {
        mousetravel += Math.max(Math.abs(mousex - lastmousex), Math.abs(mousey - lastmousey));
      }
      lastmousex = mousex;
      lastmousey = mousey;
    });
    var mdraw = function () {
      var md = new Date();
      var timenow = md.getTime();
      if (lastmousetime && lastmousetime != timenow) {
        var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000);
        mpoints.push(pps);
        if (mpoints.length > mpoints_max)
          mpoints.splice(0, 1);
        mousetravel = 0;
        $('#mousespeed').sparkline(mpoints, {width: mpoints.length * 2, tooltipSuffix: ' pixels per second'});
      }
      lastmousetime = timenow;
      setTimeout(mdraw, mrefreshinterval);
    };
    // We could use setInterval instead, but I prefer to do it this way
    setTimeout(mdraw, mrefreshinterval);
  }
</script> 