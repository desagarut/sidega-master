<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-08-07 08:30:14 --> Curl error: SSL certificate problem: certificate has expired
ERROR - 2023-08-07 08:30:14 --> Array
(
    [url] => https://trace.desagarut.id/index.php/api/track/desa?token=da39a3ee5e6b4b0d3255bfef95601890afd80709
    [content_type] => 
    [http_code] => 0
    [header_size] => 0
    [request_size] => 0
    [filetime] => -1
    [ssl_verify_result] => 10
    [redirect_count] => 0
    [total_time] => 0.148939
    [namelookup_time] => 0.039806
    [connect_time] => 0.060856
    [pretransfer_time] => 0
    [size_upload] => 0
    [size_download] => 0
    [speed_download] => 0
    [speed_upload] => 0
    [download_content_length] => -1
    [upload_content_length] => -1
    [starttransfer_time] => 0
    [redirect_time] => 0
    [redirect_url] => 
    [primary_ip] => 103.102.1.98
    [certinfo] => Array
        (
        )

    [primary_port] => 443
    [local_ip] => 192.168.2.87
    [local_port] => 60478
    [http_version] => 0
    [protocol] => 2
    [ssl_verifyresult] => 0
    [scheme] => HTTPS
    [appconnect_time_us] => 0
    [connect_time_us] => 60856
    [namelookup_time_us] => 39806
    [pretransfer_time_us] => 0
    [redirect_time_us] => 0
    [starttransfer_time_us] => 0
    [total_time_us] => 148939
)

ERROR - 2023-08-07 08:35:54 --> Severity: error --> Exception: Call to undefined method Pembangunan_model::upload_gambar_pembangunan() D:\laragon\www\sidega-master\donjo-app\models\Pembangunan_model.php 133
ERROR - 2023-08-07 08:37:46 --> Severity: error --> Exception: Call to undefined function Cekfoto() D:\laragon\www\sidega-master\donjo-app\models\Pembangunan_model.php 139
ERROR - 2023-08-07 09:29:47 --> Query error: Unknown column 'judul' in 'field list' - Invalid query: UPDATE `gambar_gallery` SET `judul` = 'SNIPER', `sumber_dana` = 'Pendapatan Asli Daerah', `volume` = '350 kilo', `tahun_anggaran` = '2023', `pelaksana_kegiatan` = 'sfdasfafsasa', `id_lokasi` = '112', `lokasi` = NULL, `keterangan` = 'sdadasdas', `created_at` = '2023-08-07 09:29:47', `updated_at` = '2023-08-07 09:29:47', `anggaran` = '1235486', `foto` = 'v2Flur_sedang1.jpg'
WHERE `id` = '3'
