ERROR - 2023-08-08 20:55:49 --> Query error: Column 'keterangan' in where clause is ambiguous - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `tbl_perencanaan_desa_dok` `d`
JOIN `tbl_perencanaan_desa` `p` ON `d`.`id_perencanaan_desa` = `p`.`id`
WHERE `d`.`id_perencanaan_desa` = '17'
AND   (
`d`.`keterangan` LIKE '%sd%' ESCAPE '!'
OR  `keterangan` LIKE '%sd%' ESCAPE '!'
 )
ERROR - 2023-08-08 20:55:49 --> Severity: error --> Exception: Call to a member function num_rows() on bool D:\laragon\www\sidega-master\system\database\DB_query_builder.php 1429
