
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your share button code -->
<div class="row"><h6>Bagikan artikel di: </h6>
<div class="fb-share-button" data-href="<?= $link; ?>" data-layout="button_count"></div>
<a href="https://api.whatsapp.com/send?text=<?= $link; ?>" target="_blank" rel="nofollow noopener" class="button btn-default"><i class="fab fa-whatsapp" style="color:green"></i>&nbsp;WhatsApp</a>
</div>