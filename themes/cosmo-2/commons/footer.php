<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php if($transparansi) $this->load->view($folder_themes .'/partials/apbdesa', $transparansi) ?>

<!-- MOHON TIDAK MEMODIFIKASI TAUTAN PENGEMBANG DI BAWAH INI SEBAGAI BENTUK PENGHARGAAN HAK CIPTA. -->
<footer class="footer">
	<div class="footer__content">
		<div class="footer__copyright">
			<span>Copyright &copy; <?= date('Y') ?> - <a href="#" target="_blank"><strong>SIDeGa <?= AmbilVersi()?></strong></a>
		</div>
		<ul class="social-media">
			<?php foreach($sosmed as $data) : ?>
				<?php if(!empty($data['link'])) : ?>
					<?php $brand = strtolower(str_replace(' ', '-', $data['nama'])) ?>
					<li class="social-media__item social-media--<?= $brand ?>">
						<a href="<?= $data['link'] ?>" class="social-media__link"><i class="fa fa-<?= $brand == 'youtube' ? 'youtube-play' : $brand ?>"></i></a>
					</li>
				<?php endif ?>
			<?php endforeach ?>
            <a href="https://validator.w3.org/feed/check.cgi?url=https%3A//desagarut.net/feed"><img src="https://validator.w3.org/feed/images/valid-rss-rogers.png" alt="[Valid RSS]" title="Validate my RSS feed" /></a>
		</ul>
	</div>
    
</footer>
<!-- Messenger Plugin Obrolan Code -->
    <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v10.0'
          });
        };

        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/id_ID/sdk/xfbml.customerchat.js';
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>

      <!-- Your Plugin Obrolan code -->
      <div class="fb-customerchat"
        attribution="page_inbox"
        page_id="112816673520116">
      </div>