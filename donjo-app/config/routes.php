<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'first';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['sitemap\.xml'] = "Sitemap/index";
$route['feed\.xml'] = "Feed/index";
$route ['ppid'] = "Api_informasi_publik/ppid";

// Artikel
$route['artikel/(:num)'] = 'first/artikel/$1'; // Contoh : artikel/1
$route['artikel/(:num)/(:num)/(:num)/(:any)'] = 'first/artikel/$4'; // Contoh : artikel/2020/5/15/contoh-artikel

// Artikel lama (Agar url lama masih dpt di akases)
$route['first/artikel/(:num)'] = 'first/artikel/$1'; // Contoh : Contoh : first/artikel/1
$route['first/artikel/(:num)/(:num)/(:num)/(:any)'] = 'first/artikel/$4'; // Contoh : first/artikel/2020/5/15/contoh-artikel

// Kategori artikel
$route['artikel/kategori/(:any)'] = 'first/kategori/$1'; // Contoh : Contoh : artikel/kategori/berita-desa
$route['artikel/kategori/(:any)/(:num)'] = 'first/kategori/$1/$2'; // Contoh : Contoh : artikel/kategori/berita-desa/1

// Route bumindes
/*
$route['bumindes_umum/([a-z_]+)/(:any)'] = "buku_umum/bumindes_umum/$1/$2";
$route['bumindes_umum/([a-z_]+)'] = "buku_umum/bumindes_umum/$1";
$route['bumindes_umum'] = "buku_umum/bumindes_umum";*/

$buku_umum = ['ekspedisi', 'lembaran_desa', 'pengurus', 'surat_keluar', 'surat_masuk'];
foreach ($buku_umum as $menu)
{
	$route["{$menu}/([a-z_]+)/(:any)/(:any)/(:any)"] = "buku_umum/{$menu}/$1/$2/$3/$4";
	$route["{$menu}/([a-z_]+)/(:any)/(:any)"] = "buku_umum/{$menu}/$1/$2/$3";
	$route["{$menu}/([a-z_]+)/(:any)"] = "buku_umum/{$menu}/$1/$2";
	$route["{$menu}/([a-z_]+)"] = "buku_umum/{$menu}/$1";
	$route["{$menu}"] = "buku_umum/{$menu}";
}
/*
$route['dokumen_sekretariat/([a-z_]+)/(:any)/(:any)/(:any)/(:any)'] = "buku_umum/dokumen_sekretariat/$1/$2/$3/$4/$5";
$route['dokumen_sekretariat/([a-z_]+)/(:any)/(:any)/(:any)'] = "buku_umum/dokumen_sekretariat/$1/$2/$3/$4";
$route['dokumen_sekretariat/([a-z_]+)/(:any)/(:any)'] = "buku_umum/dokumen_sekretariat/$1/$2/$3";
$route['dokumen_sekretariat/([a-z_]+)/(:any)'] = "buku_umum/dokumen_sekretariat/$1/$2";
$route['dokumen_sekretariat/([a-z_]+)'] = "buku_umum/dokumen_sekretariat/$1";
$route['dokumen_sekretariat'] = "buku_umum/dokumen_sekretariat";
*/
// Route untuk menghilangkan 'first' dari URL web
$route['index/(:num)'] = 'first/index/$1';
$route['(:num)'] = 'first/index/$1';
$route['arsip'] = 'first/arsip';
$route['arsip/(:num)'] = 'first/arsip/$1';
$route['peraturan_desa'] = 'first/peraturan_desa';
$route['data_analisis'] = 'first/data_analisis';
$route['data_analisis/(.+)'] = 'first/data_analisis/$1';
$route['add_comment/(:any)'] = 'first/add_comment/$1';
$route['ambil_data_covid'] = 'first/ambil_data_covid';
$route['load_aparatur_desa'] = 'first/load_aparatur_desa';
$route['load_apbdes'] = 'first/load_apbdes';
$route['load_aparatur_wilayah/(.+)'] = 'first/load_aparatur_wilayah/$1';
$route['logout'] = 'first/logout';
$route['ganti'] = 'first/ganti';
$route['auth'] = 'first/auth';
$route['peta'] = 'first/peta';
$route['informasi_publik'] = 'first/informasi_publik';

// $route['bumindes_umum/([a-z_]+)/(:any)'] = "buku_umum/bumindes_umum/$1/$2";
// $route['bumindes_umum/([a-z_]+)'] = "buku_umum/bumindes_umum/$1";
// $route['bumindes_umum'] = "buku_umum/bumindes_umum";

// $route['pengurus/([a-z_]+)/(:any)/(:any)/(:any)'] = "buku_umum/pengurus/$1/$2/$3/$4";
// $route['pengurus/([a-z_]+)/(:any)/(:any)'] = "buku_umum/pengurus/$1/$2/$3";
// $route['pengurus/([a-z_]+)/(:any)'] = "buku_umum/pengurus/$1/$2";
// $route['pengurus/([a-z_]+)'] = "buku_umum/pengurus/$1";
// $route['pengurus'] = "buku_umum/pengurus";

// $route['surat_keluar/([a-z_]+)/(:any)/(:any)/(:any)'] = "buku_umum/surat_keluar/$1/$2/$3/$4";
// $route['surat_keluar/([a-z_]+)/(:any)/(:any)'] = "buku_umum/surat_keluar/$1/$2/$3";
// $route['surat_keluar/([a-z_]+)/(:any)'] = "buku_umum/surat_keluar/$1/$2";
// $route['surat_keluar/([a-z_]+)'] = "buku_umum/surat_keluar/$1";
// $route['surat_keluar'] = "buku_umum/surat_keluar";

// $buku_umum = ['ekspedisi', 'lembaran_desa'];
// foreach ($buku_umum as $menu)
// {
// 	$route["{$menu}/([a-z_]+)/(:any)/(:any)/(:any)"] = "buku_umum/{$menu}/$1/$2/$3/$4";
// 	$route["{$menu}/([a-z_]+)/(:any)/(:any)"] = "buku_umum/{$menu}/$1/$2/$3";
// 	$route["{$menu}/([a-z_]+)/(:any)"] = "buku_umum/{$menu}/$1/$2";
// 	$route["{$menu}/([a-z_]+)"] = "buku_umum/{$menu}/$1";
// 	$route["{$menu}"] = "buku_umum/{$menu}";
// }

// $route['surat_masuk/([a-z_]+)/(:any)/(:any)/(:any)'] = "buku_umum/surat_masuk/$1/$2/$3/$4";
// $route['surat_masuk/([a-z_]+)/(:any)/(:any)'] = "buku_umum/surat_masuk/$1/$2/$3";
// $route['surat_masuk/([a-z_]+)/(:any)'] = "buku_umum/surat_masuk/$1/$2";
// $route['surat_masuk/([a-z_]+)'] = "buku_umum/surat_masuk/$1";
// $route['surat_masuk'] = "buku_umum/surat_masuk";

// $route['dokumen_sekretariat/([a-z_]+)/(:any)/(:any)/(:any)/(:any)'] = "buku_umum/dokumen_sekretariat/$1/$2/$3/$4/$5";
// $route['dokumen_sekretariat/([a-z_]+)/(:any)/(:any)/(:any)'] = "buku_umum/dokumen_sekretariat/$1/$2/$3/$4";
// $route['dokumen_sekretariat/([a-z_]+)/(:any)/(:any)'] = "buku_umum/dokumen_sekretariat/$1/$2/$3";
// $route['dokumen_sekretariat/([a-z_]+)/(:any)'] = "buku_umum/dokumen_sekretariat/$1/$2";
// $route['dokumen_sekretariat/([a-z_]+)'] = "buku_umum/dokumen_sekretariat/$1";
// $route['dokumen_sekretariat'] = "buku_umum/dokumen_sekretariat";
