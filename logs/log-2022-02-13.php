<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-02-13 10:15:10 --> Query error: Expression #13 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'sidega_2022.cu.id_pend' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT `c`.*, `c`.`id` as `id_letterc`, `c`.`created_at` as `tanggal_daftar`, `cu`.`id_pend`, `u`.`nik` AS `nik`, `u`.`nama` as `namapemilik`, `w`.*, (CASE WHEN c.jenis_pemilik = 1 THEN u.nama ELSE c.nama_pemilik_luar END) AS namapemilik, (CASE WHEN c.jenis_pemilik = 1 THEN CONCAT("RT ", `w`.`rt`, " / RW ", `w`.`rw`, " - ", w.dusun) ELSE c.alamat_pemilik_luar END) AS alamat, COUNT(DISTINCT p.id) AS jumlah
FROM `letterc` `c`
LEFT JOIN `mutasi_letterc` `m` ON `m`.`id_letterc_masuk` = `c`.`id` or `m`.`letterc_keluar` = `c`.`id`
LEFT JOIN `persil` `p` ON `p`.`id` = `m`.`id_persil` or `c`.`id` = `p`.`letterc_awal`
LEFT JOIN `ref_persil_kelas` `k` ON `k`.`id` = `p`.`kelas`
LEFT JOIN `letterc_penduduk` `cu` ON `cu`.`id_letterc` = `c`.`id`
LEFT JOIN `tweb_penduduk` `u` ON `u`.`id` = `cu`.`id_pend`
LEFT JOIN `tweb_wil_clusterdesa` `w` ON `w`.`id` = `u`.`id_cluster`
GROUP BY `c`.`id`, `cu`.`id`
ORDER BY cast(c.nomor as unsigned)
 LIMIT 50
ERROR - 2022-02-13 10:15:10 --> Severity: error --> Exception: Call to a member function result_array() on bool F:\laragon\www\sidesci-5.1\donjo-app\models\Letterc_model.php 107
ERROR - 2022-02-13 11:07:06 --> Query error: Incorrect datetime value: '2022-02-13 11:07:03am' for column 'tgl_bayar' at row 1 - Invalid query: UPDATE `tbl_data_sppt_tagih` SET `tahun_tagih` = '2022', `status` = 'Lunas', `tgl_bayar` = '2022-02-13 11:07:03am', `updated_by` = '1'
WHERE `id_tagih` = '1'
ERROR - 2022-02-13 11:07:33 --> Query error: Incorrect datetime value: '2022-02-13 11:07:30am' for column 'tgl_bayar' at row 1 - Invalid query: UPDATE `tbl_data_sppt_tagih` SET `tahun_tagih` = '2022', `status` = 'Lunas', `tgl_bayar` = '2022-02-13 11:07:30am', `updated_by` = '1'
WHERE `id_tagih` = '2'
ERROR - 2022-02-13 04:13:32 --> Severity: error --> Exception: Class 'CI_Controller' not found F:\laragon\www\sidesci-5.1\system\core\CodeIgniter.php 369
ERROR - 2022-02-13 11:17:55 --> Query error: Incorrect datetime value: '2022-02-13 11:17:52am' for column 'tgl_bayar' at row 1 - Invalid query: UPDATE `tbl_data_sppt_tagih` SET `tahun_tagih` = '2022', `status` = 'Lunas', `tgl_bayar` = '2022-02-13 11:17:52am', `updated_by` = '1'
WHERE `id_tagih` = '1'
ERROR - 2022-02-13 11:20:50 --> Query error: Incorrect datetime value: '2022-02-13 11:20:47am' for column 'tgl_bayar' at row 1 - Invalid query: UPDATE `tbl_data_sppt_tagih` SET `tahun_tagih` = '2022', `status` = 'Lunas', `tgl_bayar` = '2022-02-13 11:20:47am', `updated_by` = '1'
WHERE `id_tagih` = '2'
ERROR - 2022-02-13 11:27:12 --> Query error: Incorrect datetime value: '2022-02-13 11:27:11am' for column 'tgl_bayar' at row 1 - Invalid query: UPDATE `tbl_data_sppt_tagih` SET `tahun_tagih` = '2022', `status` = 'Lunas', `tgl_bayar` = '2022-02-13 11:27:11am', `updated_by` = '1'
WHERE `id_tagih` = '1'
ERROR - 2022-02-13 11:27:18 --> Query error: Incorrect datetime value: '2022-02-13 11:27:17am' for column 'tgl_bayar' at row 1 - Invalid query: UPDATE `tbl_data_sppt_tagih` SET `tahun_tagih` = '2022', `status` = 'Lunas', `tgl_bayar` = '2022-02-13 11:27:17am', `updated_by` = '1'
WHERE `id_tagih` = '1'
ERROR - 2022-02-13 11:31:49 --> Query error: Incorrect datetime value: '2022-02-13 11:31:47am' for column 'tgl_bayar' at row 1 - Invalid query: UPDATE `tbl_data_sppt_tagih` SET `tahun_tagih` = '2022', `status` = 'Lunas', `tgl_bayar` = '2022-02-13 11:31:47am', `updated_by` = '1'
WHERE `id_tagih` = '2'
ERROR - 2022-02-13 11:32:32 --> Query error: Incorrect datetime value: '2022-02-13 11:32:30am' for column 'tgl_bayar' at row 1 - Invalid query: UPDATE `tbl_data_sppt_tagih` SET `tahun_tagih` = '2021', `status` = 'Lunas', `tgl_bayar` = '2022-02-13 11:32:30am', `updated_by` = '1'
WHERE `id_tagih` = '4'
ERROR - 2022-02-13 11:33:37 --> Query error: Incorrect datetime value: '2022-02-13 11:33:36am' for column 'tgl_bayar' at row 1 - Invalid query: UPDATE `tbl_data_sppt_tagih` SET `tahun_tagih` = '2021', `status` = 'Lunas', `tgl_bayar` = '2022-02-13 11:33:36am', `updated_by` = '1'
WHERE `id_tagih` = '12'
ERROR - 2022-02-13 11:38:37 --> Query error: Incorrect datetime value: '2022-02-13 11:38:35am' for column 'tgl_bayar' at row 1 - Invalid query: UPDATE `tbl_data_sppt_tagih` SET `tahun_tagih` = '2021', `status` = 'Lunas', `tgl_bayar` = '2022-02-13 11:38:35am', `updated_by` = '1'
WHERE `id_tagih` = '12'
ERROR - 2022-02-13 11:38:53 --> Query error: Incorrect datetime value: '2022-02-13 11:38:52am' for column 'tgl_bayar' at row 1 - Invalid query: UPDATE `tbl_data_sppt_tagih` SET `tahun_tagih` = '2021', `status` = 'Lunas', `tgl_bayar` = '2022-02-13 11:38:52am', `updated_by` = '1'
WHERE `id_tagih` = '12'
ERROR - 2022-02-13 11:39:05 --> Query error: Incorrect datetime value: '2022-02-13 11:38:59am' for column 'tgl_bayar' at row 1 - Invalid query: UPDATE `tbl_data_sppt_tagih` SET `tahun_tagih` = '2021', `status` = 'Lunas', `tgl_bayar` = '2022-02-13 11:38:59am', `updated_by` = '1'
WHERE `id_tagih` = '12'
ERROR - 2022-02-13 11:39:25 --> Query error: Incorrect datetime value: '2022-02-13 11:39:24am' for column 'tgl_bayar' at row 1 - Invalid query: UPDATE `tbl_data_sppt_tagih` SET `tahun_tagih` = '2021', `status` = 'Lunas', `tgl_bayar` = '2022-02-13 11:39:24am', `updated_by` = '1'
WHERE `id_tagih` = '12'
ERROR - 2022-02-13 11:40:27 --> Query error: Incorrect datetime value: '2022-02-13 11:40:25am' for column 'tgl_bayar' at row 1 - Invalid query: UPDATE `tbl_data_sppt_tagih` SET `tahun_tagih` = '2021', `status` = 'Lunas', `tgl_bayar` = '2022-02-13 11:40:25am', `updated_by` = '1'
WHERE `id_tagih` = '12'
ERROR - 2022-02-13 11:41:10 --> Query error: Incorrect datetime value: '2022-02-13 11:41:08am' for column 'tgl_bayar' at row 1 - Invalid query: UPDATE `tbl_data_sppt_tagih` SET `tahun_tagih` = '2021', `status` = 'Lunas', `tgl_bayar` = '2022-02-13 11:41:08am', `updated_by` = '1'
WHERE `id_tagih` = '12'
ERROR - 2022-02-13 11:42:07 --> Query error: Incorrect datetime value: '2022-02-13 11:42:06am' for column 'tgl_bayar' at row 1 - Invalid query: UPDATE `tbl_data_sppt_tagih` SET `tahun_tagih` = '2021', `status` = 'Lunas', `tgl_bayar` = '2022-02-13 11:42:06am', `updated_by` = '1'
WHERE `id_tagih` = '12'
ERROR - 2022-02-13 11:43:02 --> Query error: Incorrect datetime value: '2022-02-13 11:43:00am' for column 'tgl_bayar' at row 1 - Invalid query: UPDATE `tbl_data_sppt_tagih` SET `tahun_tagih` = '2021', `status` = 'Lunas', `tgl_bayar` = '2022-02-13 11:43:00am', `updated_by` = '1'
WHERE `id_tagih` = '12'
ERROR - 2022-02-13 11:47:06 --> Query error: Incorrect integer value: '' for column 'denda' at row 1 - Invalid query: INSERT INTO `tbl_data_sppt_tagih` (`nomor`, `nama_wp`, `letak_op`, `tahun_tagih`, `pbb_terhutang`, `denda`, `iuran`, `total_tagih`, `status`, `created_by`, `updated_by`) VALUES ('123456789001', 'AHLUL', 'Mangsit 1', '2018', '15000', '', '', '', 'Belum Bayar', '1', '1')
ERROR - 2022-02-13 12:19:55 --> Query error: Incorrect integer value: '' for column 'iuran' at row 1 - Invalid query: INSERT INTO `tbl_data_sppt_tagih` (`nomor`, `nama_wp`, `letak_op`, `tahun_tagih`, `pbb_terhutang`, `denda`, `iuran`, `total_tagih`, `status`, `created_by`, `updated_by`) VALUES ('123456789001', 'AHLUL', 'Mangsit 1', '2014', '15000', '15000', '', '', 'Belum Bayar', '1', '1')
ERROR - 2022-02-13 12:23:21 --> Query error: Incorrect integer value: '' for column 'denda' at row 1 - Invalid query: INSERT INTO `tbl_data_sppt_tagih` (`nomor`, `nama_wp`, `letak_op`, `tahun_tagih`, `pbb_terhutang`, `denda`, `iuran`, `total_tagih`, `status`, `created_by`, `updated_by`) VALUES ('123456789001', 'AHLUL', 'Mangsit 1', '2014', '15000', '', '', '', 'Belum Bayar', '1', '1')
ERROR - 2022-02-13 07:42:18 --> 404 Page Not Found: Identitas/index
