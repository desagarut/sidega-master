<!-- ======= Gallery Youtube ======= -->
<div class="container">
  <div class="row g-4">
    <div class="single_category wow fadeInDown" style="margin-bottom: 20px;">
      <h2> <span class="bold_line"><span></span></span> <span class="solid_line"></span> <span class="title_text">Pengaduan</span></h2>
    </div>

    <div class="row">
      <div class="col-md-12">

        <form method="post" action="/login">
          <input type="text" name="username" placeholder="Username" required />
          <input type="password" name="password" placeholder="Password" required />

          <!-- Cloudflare Turnstile widget -->
          <div class="cf-turnstile" data-sitekey="0x4AAAAAACUYeHOFo92Kxjzr" data-theme="light"></div>

          <button type="submit">Login</button>
        </form>

        <!-- Load Turnstile script -->
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
      </div>
    </div>
  </div>
</div>

<?php
// Ambil token Turnstile dari form
$token = $_POST['cf-turnstile-response'];
$secret = 'SECRET_KEY_KAMU'; // dari Cloudflare

// Kirim request verifikasi ke Cloudflare
$response = file_get_contents("https://challenges.cloudflare.com/turnstile/v0/siteverify", false, stream_context_create([
    'http' => [
        'method' => 'POST',
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'content' => http_build_query([
            'secret' => $secret,
            'response' => $token,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ]),
    ]
]));

$result = json_decode($response, true);

if ($result['success']) {
    // Lolos human check, proses login atau register
    echo "Human Verified ✅";
    // Proses login seperti biasa...
} else {
    // Gagal, kemungkinan bot atau error
    echo "Verifikasi gagal ❌";
}
?>