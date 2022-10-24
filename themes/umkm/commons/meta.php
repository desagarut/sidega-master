<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php defined('THEME_VERSION') or define('THEME_VERSION', 'V4.8') ?>

<?php $desa_title =  ucwords($this->setting->sebutan_desa) . ' '. $desa['nama_desa'] . ' '. ucwords($this->setting->sebutan_kecamatan) . ' '. $desa['nama_kecamatan'] . ' '. ucwords($this->setting->sebutan_kabupaten) . ' '. $desa['nama_kabupaten']; ?>

<meta content="utf-8" http-equiv="encoding">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name='viewport' content='width=device-width, initial-scale=1' />
<meta name='google' content='notranslate' />
<meta name='theme' content='UMKM' />
<meta name='designer' content='Bambang Andri H' />
<meta name='theme:designer' content='Bambang Andri H' />
<meta name="theme:version" content="<?= THEME_VERSION ?>" />
<meta name="theme-color" content="#00C" />
<meta name="keywords" content="sidega, SIDEGA, SIDeGa, sistem informasi desa garut, web, blog, informasi, website, tema sidega-blue, desa garut, kelurahan garut, kecamatan garut, kabupaten garut, Jawa Barat, indonesia" />
<meta property="og:site_name" content="<?= $desa_title ?>" />
<meta property="og:type" content="article" />
<meta property='og:url' content="<?= current_url(); ?>" />

<?php if(isset($single_artikel)): ?>
	<meta property="og:title" content="<?= htmlspecialchars($single_artikel["judul"]); ?>"/>
	<meta property="og:url" content="<?= site_url('artikel/'.buat_slug($single_artikel))?>"/>
	<meta property="og:image" content="<?= base_url(''); ?><?= LOKASI_FOTO_ARTIKEL?>sedang_<?= $single_artikel['gambar'];?>"/>
	<meta property="og:description" content="<?= potong_teks($single_artikel['isi'], 300)?> ..."/>
<?php else: ?>
	<meta property="og:title" content="<?= $desa_title; ?>"/>
	<meta property="og:url" content="<?= site_url() ?>"/>
	<meta property="og:description" content="<?= $this->setting->website_title . ' '.  $desa_title; ?>"/>
<?php endif; ?>

<?php if (is_file(LOKASI_LOGO_DESA . "favicon.ico")) : ?>
    <link rel="shortcut icon" href="<?= base_url() . LOKASI_LOGO_DESA ?>favicon.ico" />
<?php else : ?>
    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>" />
<?php endif; ?>

<script>
    const BASE_URL = '<?= base_url() ?>';
</script>

<!-- Start Open Web Analytics Tracker -->
<script type="text/javascript">
//<![CDATA[
var owa_baseUrl = 'https://trace.desagarut.id/';
var owa_cmds = owa_cmds || [];
owa_cmds.push(['setSiteId', '<?= $this->setting->trace; ?>']);
owa_cmds.push(['trackPageView']);
owa_cmds.push(['trackClicks']);

(function() {
    var _owa = document.createElement('script'); _owa.type = 'text/javascript'; _owa.async = true;
    owa_baseUrl = ('https:' == document.location.protocol ? window.owa_baseSecUrl || owa_baseUrl.replace(/http:/, 'https:') : owa_baseUrl );
    _owa.src = owa_baseUrl + 'modules/base/dist/owa.tracker.js';
    var _owa_s = document.getElementsByTagName('script')[0]; _owa_s.parentNode.insertBefore(_owa, _owa_s);
}());
//]]>
</script>
<!-- End Open Web Analytics Code -->
<title>
<?php if ($single_artikel["judul"] == ""): ?>
	<?= $this->setting->website_title . ' '.  $desa_title; ?>
<?php else: ?>
	<?= $single_artikel["judul"].' - '.ucwords($this->setting->sebutan_desa) . ' ' . $desa['nama_desa']; ?>
<?php endif; ?>
</title>
        