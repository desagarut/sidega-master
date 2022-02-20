<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

                    <div class="tab-pane" id="rumah"> 
                      <!-- The Rumah --> 
                      <!-- timeline item -->
                      <ul class="timeline timeline-inverse">
                      <?php foreach ($list_rumah as $key => $data): ?>
                        <li> <i class="fa fa-camera bg-purple"></i>
                          <div class="timeline-item"> <span class="time"><i class="fa fa-clock-o"></i>diunggah: <?= tgl_indo2($data['tgl_upload']); ?></span>
                            <h3 class="timeline-header"><a href="#"><?= $key + 1; ?>. Foto <?= $data['nama']?></a></h3>
                            <div class="timeline-body" align="center">
                            	<img class="img-responsive img-circle" src="<?= base_url().LOKASI_RUMAH?><?= urlencode($data['satuan']); ?>" alt="Foto Rumah Penduduk">
                                <p><small>Nama file: <a href="<?= base_url().LOKASI_RUMAH?><?= urlencode($data['satuan']); ?>" >
                                    <?= $data['satuan']; ?>
                                    </a></small></p>
                          <!--    <table class="table table-bordered table-striped table-hover detail">
                                <tr>
                                  <th class="padat">No</th>
                                  
                                  <th width="20%">Nama </th>
                                  <th width="40%">Foto</th>
                                  <th width="15%">File</th>
                                  <th width="15%">Tanggal Upload</th>
                                </tr>
                                <?php //foreach ($list_rumah as $key => $data): ?>
                                <tr>
                                  <td class="text-center"></td>
                                  
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                                <?php //endforeach;?>
                              </table>-->
                              
                            </div>
                          </div>
                        </li><?php endforeach;?>
                        <!-- END timeline item -->
                        <li> <i class="fa fa-clock-o bg-gray"></i> </li>
                        
                      </ul>
                    </div>
                    
