<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

        <div class="col-sm-3 col-xs-6"> <a href="<?=site_url('sid_core')?>" class="small-box-footer" title="Lihat Dusun">
          <div class="small-box bg-red">
            <div class="inner">
              <?php foreach ($dusun as $data): ?>
              <h3>
                <?=$data['jumlah']?>
              </h3>
              <?php endforeach; ?>
              <p>Wilayah Dusun</p>
            </div>
            <div class="icon"> <i class="ion ion-location"></i> </div>
          </div>
          </a> </div>
        <div class="col-sm-3 col-xs-6"> <a href="<?=site_url('penduduk/clear')?>" class="small-box-footer" title="Lihat Daftar Penduduk">
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php foreach ($penduduk as $data): ?>
              <h3>
                <?=$data['jumlah']?>
              </h3>
              <?php endforeach; ?>
              <p>Penduduk</p>
            </div>
            <div class="icon"> <i class="ion ion-person"></i> </div>
          </div>
          </a> </div>
        <div class="col-sm-3 col-xs-6"> <a href="<?=site_url('keluarga/clear')?>" class="small-box-footer" title="Lihat Daftar Keluarga">
          <div class="small-box bg-blue">
            <div class="inner">
              <?php foreach ($keluarga as $data): ?>
              <h3>
                <?=$data['jumlah']?>
              </h3>
              <?php endforeach; ?>
              <p>Keluarga</p>
            </div>
            <div class="icon"> <i class="ion ion-ios-people"></i> </div>
          </div>
          </a> </div>
        <div class="col-sm-3 col-xs-6"> <a href="<?=site_url('rtm/clear')?>" class="small-box-footer" title="Lihat Daftar Rumah Tangga">
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php foreach ($rtm as $data): ?>
              <h3>
                <?=$data['jumlah']?>
              </h3>
              <?php endforeach; ?>
              <p>Rumah Tangga</p>
            </div>
            <div class="icon"> <i class="ion ion-ios-home"></i> </div>
          </div>
          </a> </div>
      </div>
      <div class="row">
        <div class="col-sm-2 col-xs-6"> <a class="btn btn-block btn-social bg-maroon" href="<?=site_url('statistik')?>"> <i class="fa fa-pie-chart"></i> Statistik </a></div>
        <div class="col-sm-2 col-xs-6"> <a class="btn btn-block btn-social bg-blue" href="<?=site_url('program_bantuan')?>"> <i class="fa fa-gift"></i> Bantuan </a> </div>
        <div class="col-sm-2 col-xs-6"> <a class="btn btn-block btn-social bg-navy" href="<?=site_url('program_bantuan')?>"> <i class="fa fa-users"></i> Pokmas </a> </div>
        <div class="col-sm-2 col-xs-6"> <a class="btn btn-block btn-social btn-success" href="<?=site_url('laporan_rentan')?>"> <i class="fa fa-wheelchair"></i>Rentan</a> </div>
        <div class="col-sm-2 col-xs-6"> <a class="btn btn-block btn-social bg-purple" href="<?=site_url('dpt')?>"> <i class="fa fa-hand-o-up"></i> DPT </a> </div>
        <div class="col-sm-2 col-xs-6"> <a class="btn btn-block btn-social btn-primary" href="<?=site_url('gis')?>"> <i class="fa fa-gift"></i> Maps </a> </div>
