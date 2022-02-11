            <div class='col-md-3'>
				<div class="box box-danger box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Login Warga</h3>
                        <div class="box-tools pull-right">
							<?php if ($this->CI->cek_hak_akses('h')): ?>
                            <a href="<?= site_url('mandiri')?>"><span class="label label-default"> Detail</span></a>
                            <?php endif; ?>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
					</div>
					<div class="box-body">
                        <ul class="users-list clearfix">
                            <?php foreach ($last_login as $key => $data){ ?>
                            <li>
                            
                                <?php if ($data['foto']): ?>
                                    <!--<img src="dist/img/user1-128x128.jpg" alt="Warga">-->
                                    <img src="<?= AmbilFoto($data['foto'])?>" alt="Foto">
                                <?php else: ?>
                                    <img class="user-image" src="<?= base_url()?>assets/files/user_pict/kuser.png" alt="Foto">
                                <?php endif; ?>
                        
                                  <a class="users-list-name" href="<?php echo site_url('penduduk/detail/1/0/'.$data['id']); ?>"><?= $data['nama']?> <?= $data['nik']?></a>
                                  <span class="users-list-date"><?= $data['dusun']?></span>
                            </li>
                            <?php } ?>
                        </ul>
                        <div class="box-footer text-center">
                            <a href="<?= site_url('mandiri'); ?>" class="uppercase">View All Users</a>
                        </div>
                    </div>
                </div>
            </div>
