<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row">
            
                <div class="col-lg-8">
                <h2 class="portfolio-title">
                    <?php $article = $single_artikel ?>
                    <?= $article['judul'] ?>
                </h2>
                    <div class="owl-carousel portfolio-details-carousel">
                        <?php if($article['gambar'] && is_file(LOKASI_FOTO_ARTIKEL.'sedang_'.$article['gambar'])) : ?>
                            <img src="<?= AmbilFotoArtikel($article['gambar'],'sedang') ?>" alt="<?= $article['judul'] ?>" class="img-fluid">
                        <?php endif ?>
                      <!--<img src="assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt="">
                      <img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
                      <img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt="">-->
                    </div>
                    <div class="col-lg-12 portfolio-info">
						<?= $article['isi'] ?>
                        <?php for($i = 1; $i <= 3; $i++) : ?>
                            <?php if($article['gambar'.$i] && is_file(LOKASI_FOTO_ARTIKEL.'sedang_'.$article['gambar'.$i])) : ?>
                                <img src="<?= AmbilFotoArtikel($article['gambar'.$i],'sedang') ?>" alt="<?= $article['nama'] ?>" title="<?= $article['nama'] ?>" class="content__image">
                            <?php endif ?>
                        <?php endfor ?>
                    </div>
                </div>
            
                <div class="col-lg-4 portfolio-info">
                    <h3><i class="ri-information-line"></i> Informasi Artikel</h3>
                    <ul>
                        <li><i class="ri-folder-5-fill"></i> <strong>Category</strong>: 	
                        <?php if($article['kategori']) : ?>
                        <span >
                            <a href="<?= site_url('first/kategori/'.$article['kat_slug']) ?>" ><?= $article['kategori'] ?></a>
                        </span>
                        <?php endif ?>
                        </li>
                        <li><i class="ri-eye-line"></i> <strong>Dibaca</strong>: <?= hit($article['hit']) ?></li>
                        <li><i class="ri-time-fill"></i> <strong>Tanggal Upload</strong>: <?= tgl_indo($article['tgl_upload']) ?></li>
                        <li><i class="ri-quill-pen-fill"> </i> <strong>Penulis </strong>: <a href="#"><?= $article['owner'] ?></a></li>
                    </ul>
                    <?php if($article['dokumen']) : ?>
                    <div class="content__attachment --mt-4">
                        <strong>Dokumen Lampiran</strong> :
                        <p>
                        <a href="<?= base_url(LOKASI_DOKUMEN.$article['dokumen']) ?>" class="content__attachment__link">
                            <i class="fa fa-cloud-download content__attachment__icon"></i>
                            <span><?= $article['link_dokumen'] ?></span>
                        </a>
                        </p>
                    </div>
                    <?php endif ?>
                
                    <div>
                    	<span><i class="ri-share-line"></i> Bagikan artikel ini:</span>
                            <ul class="social-media">
                                <li class="social-media__item social-media--facebook">
                                <a href="http://www.facebook.com/sharer.php?u=<?= site_url('artikel/'.buat_slug($article))?>" target="_blank" class="social-media__link"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li class="social-media__item social-media--twitter">
                                <a href="http://twitter.com/share?url=<?= site_url('artikel/'.buat_slug($article)) ?>" target="_blank" class="social-media__link"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li class="social-media__item social-media--telegram">
                                <a href="https://telegram.me/share/url?url=<?= site_url('artikel/'.buat_slug($article))?>&text=<?= $article["judul"]; ?>" target="_blank" class="social-media__link"><i class="fa fa-telegram"></i></a>
                                </li>
                                <li class="social-media__item social-media--whatsapp">
                                <a href="https://api.whatsapp.com/send?text=<?= site_url('artikel/'.buat_slug($article))?>" target="_blank" class="social-media__link"><i class="fa fa-whatsapp"></i></a>
                                </li>
                            </ul>
                    </div>
                    <div>
                    <h3><i class="ri-wechat-line"></i> Komentar</h3>
                        <ul class="--mt-4 content__list">
                        <?php foreach($komentar as $comment) : ?>
                            <li class="--mt-2 --mb-2">
                                <span><i class="fa fa-user --mx-2"></i> <?= $comment['owner'] ?></span>
                                <p><i class="fa fa-comment-o --mx-2"></i> <?= $comment['komentar'] ?></p>
                                <span><i class="fa fa-calendar --mx-2"></i> <?= $comment['tgl_upload'] ?></span>
                            </li>
                            <hr/>
                        <?php endforeach ?>
                        </ul>
                    
						<?php if(is_array($komentar)) : ?>
                        <?php 
                        $k = array();
                        foreach ($komentar as $data) {
                            if ($data['is_archived'] != 1) {
                                array_push($k, $data);
                            }
                        }
                        ?>
                        <?php if(count($k) > 0) : ?>
                            <div class="py-2 pl-4 bg-light align-middle d-flex align-items-center" style="border-left: 3px solid orange">
                                <h4 class="h5 font-weight-bold m-0"><?= count($k) ?> Komentar atas artikel <?= $single_artikel["judul"]?></h4>
                            </div>
                            <ul class="comment-section">
                                <?php foreach($k as $data) : ?>
                                <li class="comment user-comment">
                                    <div class="info">
                                            <a href="#!" title="<?= $data['owner'] ?>"><?= $data['owner'] ?></a>
                                            <span><?= tgl_indo($data['tgl_upload']); ?></span>
                                    </div>
                                    <span class="avatar">
                                            <i class="fa fa-user fa-lg p-2 rounded-circle bg-light"></i>
                                    </span>
                                    <p><?= $data['komentar'] ?></p>
                                </li>
                                <?php endforeach ?>
                            </ul>
                        <?php endif ?>
                        <?php endif ?>
					<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- DesaGarut - Display Persegi -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-1823410826720847"
                         data-ad-slot="5447198760"
                         data-ad-format="auto"
                         data-full-width-responsive="true"></ins>
                    <script>
                         (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>

                        <div class="form-group group-komentar" id="kolom-komentar">
                        <?php if($single_artikel['boleh_komentar']): ?>
                            <div class="mb-3 font-weight-bold h6">Silakan tulis komentar dalam formulir berikut ini (Gunakan bahasa yang santun)</div>
                            <div class="card card-panel shadow-sm border border-default">
                                <div class="card-header bg-info text-light py-2 px-3 mb-2">
                                    <div class="h6 font-weight-bold m-0 py-2"><i class="ri-question-answer-line"></i>	Formulir Komentar</br> <span class="font-weight-normal">(Komentar terbit setelah disetujui Admin)</span></div>
                                </div>
                        
                                <!-- Tampilkan hanya jika 'flash_message' ada -->
                                <?php $label = !empty($_SESSION['validation_error']) ? 'alert-danger' : 'alert-success'; ?>
                                <?php if ($flash_message): ?>
                                    <div class="card-header alert <?= $label?> mx-2 rounded-0"><?= $flash_message?></div>
                                    <?php unset($_SESSION['validation_error']); ?>
                                <?php endif; ?>
                                <div class="card-body py-3 px-3">
                                    <form id="form-komentar" name="form" action="<?= site_url('first/add_comment/'.$single_artikel['id'])?>" method="POST" onSubmit="return validasi(this);">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Nama<span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input class="form-control input-sm" type="text" required name="owner" maxlength="30" value="<?= !empty($_SESSION['post']['owner']) ? $_SESSION['post']['owner'] : $_SESSION['nama'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">No. HP<span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input class="form-control input-sm" type="text" required placeholder="" name="no_hp" maxlength="30" value="<?= $_SESSION['post']['no_hp']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Alamat email</label>
                                            <div class="col-lg-9">
                                                <input class="form-control input-sm" type="text" placeholder="" name="email" maxlength="30" value="<?= $_SESSION['post']['email']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Komentar<span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <textarea class="form-control input-sm" required name="komentar"><?= $_SESSION['post']['komentar'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="offset-lg-3 col-lg-9">
                                                <img id="captcha" src="<?= base_url('securimage/securimage_show.php') ?>" alt="CAPTCHA Image"/ class="img-fluid border border-black">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="offset-lg-3 col-lg-9">
                                                <a href="#!" onclick="document.getElementById('captcha').src = '<?= base_url("securimage/securimage_show.php?")?>'+Math.random(); return false"><small>[ Ganti Gambar ]</small></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="offset-lg-3 col-lg-9">
                                                <input class="form-control input-sm" type="text" required name="captcha_code" maxlength="6" value="<?= $_SESSION['post']['captcha_code'] ?>"/>
                                                <span class="d-block">
                                                    Isikan kode di gambar
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="offset-lg-3 mt-3 col-lg-10">
                                                <button class="btn btn-info btn-md" type="submit"><i class="fa fa-paper-plane"></i> KIRIM KOMENTAR</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php else: ?>
                            <span class="d-block alert alert-warning px-2 py-3"><i class="fa fa-exclamation-triangle pl-1 pr-2"></i> Komentar untuk artikel ini telah ditutup.</span>
                        <?php endif; ?>
                        </div>
                    
                    </div>
                    
					<?php //$this->load->view($folder_themes .'/widgets/arsip_artikel') ?>
                    
                </div>
                
            </div>
        </div>
    </section><!-- End Portfolio Details Section -->


