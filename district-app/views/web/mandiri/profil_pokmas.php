<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="tab-pane" id="kelompok"> 
        <h5>Aktivitas Kelompok Masyarakat</h5>
      <div class="box-body" id="kelompok">
        <div class="table-responsive">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped form">
            <tr>
              <th>No</th>
              <th>Nama Kelompok</th>
              <th>Kategori Kelompok</th>
              <th>Status Keanggotaan</th>
            </tr>
            <?php $no=1; foreach($list_kelompok as $kel){?>
            <tr>
              <td align="center" width="2"><?= $no;?></td>
              <td><?= $kel['nama']?></td>
              <td><?= $kel['kategori']?></td>
              <td><?= $data['ketua']?></td>
            </tr>
            <?php $no++;}?>
          </table>
        </div>
      </div>
</div>
