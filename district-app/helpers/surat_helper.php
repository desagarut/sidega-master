<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Spipu\Html2Pdf\Exception\ExceptionFormatter;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;

/**
 * SuratExportDesa
 *
 * Mengembalikan path surat ubahan desa apabila ada.
 * Cek folder semua komponen surat dulu, baru cek folder export
 *
 * @param mixed $nama_surat
 *
 * @return string
 */
function SuratExportDesa($nama_surat)
{
    $surat_export_desa = LOKASI_SURAT_DESA . $nama_surat . '/' . $nama_surat . '.rtf';
    if (is_file($surat_export_desa)) {
        return $surat_export_desa;
    }

    $surat_export_desa = LOKASI_SURAT_EXPORT_DESA . $nama_surat . '.rtf';
    if (is_file($surat_export_desa)) {
        return $surat_export_desa;
    }

    return '';
}

/**
 * SuratExport
 *
 * Mengembalikan path surat export apabila ada, dengan prioritas:
 *    1. surat export ubahan desa
 *    2. surat export asli SID
 *
 * @param mixed $nama_surat
 *
 * @return string
 */
function SuratExport($nama_surat)
{
    if (SuratExportDesa($nama_surat) != '') {
        return SuratExportDesa($nama_surat);
    }
    if (is_file("template-surat/{$nama_surat}/{$nama_surat}.rtf")) {
        return "template-surat/{$nama_surat}/{$nama_surat}.rtf";
    }

    return '';
}

function ikut_case($format, $str)
{
    $str = strtolower($str);
    if (ctype_upper($format[0]) && ctype_upper($format[1])) {
        return strtoupper($str);
    }
    if (ctype_upper($format[0])) {
        return ucwords($str);
    }

    return $str;
}

/**
 * Membuat string yang diisi &nbsp; di awal dan di akhir, dengan panjang yang ditentukan.
 *
 * @param            string      Text yang akan ditambahi awal dan akhiran
 * @param            awal     Jumlah karakter &nbsp; pada awal text
 * @param            panjang  Panjang string yang dihasilkan,
 *                            di mana setiap &nbsp; dihitung sebagai satu karakter
 * @param mixed $str
 * @param mixed $awal
 * @param mixed $panjang
 *
 * @return string berisi text yang telah diberi awalan dan akhiran &nbsp;
 */
function padded_string_fixed_length($str, $awal, $panjang)
{
    $padding         = '&nbsp;';
    $panjang_padding = strlen($padding);
    $panjang_text    = strlen($str);
    $str             = str_pad($str, ($awal * $panjang_padding) + $panjang_text, $padding, STR_PAD_LEFT);

    return str_pad($str, (($panjang - $panjang_text) * $panjang_padding) + $panjang_text, $padding, STR_PAD_RIGHT);
}

function padded_string_center($str, $panjang)
{
    $padding         = '&nbsp;';
    $panjang_padding = strlen($padding);
    $panjang_text    = strlen($str);
    $to_pad          = ($panjang - $panjang_text) / 2;

    for ($i = 0; $i < $to_pad; $i++) {
        $str = $padding . $str . $padding;
    }

    return $str;
}

function strip_kosong($str)
{
    return empty($str) ? '-' : $str;
}

// Simpan laporan html sebagai file PDF
function buat_pdf($isi, $file, $style = null, $orientation = 'P', $page_size = 'A4')
{
    // CSS perlu ditambahkan secara eksplisit
    $style     = $style ?: APPPATH . '../assets/css/report.css';
    $style_isi = "<style>\n " . file_get_contents($style) . "</style>\n" . $isi;

    // Konversi ke PDF menggunakan html2pdf
    try {
        $html2pdf = new Html2Pdf($orientation, $page_size);
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($style_isi);
        $html2pdf->output($file . '.pdf', 'FI');
    } catch (Html2PdfException $e) {
        file_put_contents($file . '_asli', $isi);
        echo $isi;
        echo '<br>================================================<br>';
        $html2pdf->clean();
        $formatter = new ExceptionFormatter($e);
        echo $formatter->getHtmlMessage();
    }
}
