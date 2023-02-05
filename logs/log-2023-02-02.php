ERROR - 2023-02-02 17:17:34 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT COUNT(u.id) AS id 
		FROM tweb_penduduk u
		LEFT JOIN tweb_keluarga d ON u.id_kk = d.id
		LEFT JOIN tweb_rtm b ON u.id_rtm = b.no_kk
		LEFT JOIN tweb_wil_clusterdesa a ON d.id_cluster = a.id
		LEFT JOIN tweb_wil_clusterdesa a2 ON u.id_cluster = a2.id
		LEFT JOIN tweb_penduduk_pendidikan_kk n ON u.pendidikan_kk_id = n.id
		LEFT JOIN tweb_penduduk_pendidikan sd ON u.pendidikan_sedang_id = sd.id
		LEFT JOIN tweb_penduduk_pekerjaan p ON u.pekerjaan_id = p.id
		LEFT JOIN tweb_penduduk_kawin k ON u.status_kawin = k.id
		LEFT JOIN tweb_penduduk_sex x ON u.sex = x.id
		LEFT JOIN tweb_penduduk_agama g ON u.agama_id = g.id
		LEFT JOIN tweb_penduduk_warganegara v ON u.warganegara_id = v.id
		LEFT JOIN tweb_golongan_darah m ON u.golongan_darah_id = m.id
		LEFT JOIN tweb_cacat f ON u.cacat_id = f.id
		LEFT JOIN tweb_penduduk_hubungan hub ON u.kk_level = hub.id
		LEFT JOIN tweb_sakit_menahun j ON u.sakit_menahun_id = j.id
		LEFT JOIN log_penduduk log ON u.id = log.id_pend and log.id_detail in (2,3,4)
		LEFT JOIN covid19_pemudik c ON c.id_terdata = u.id
		LEFT JOIN ref_status_covid rc ON c.status_covid = rc.nama
		LEFT JOIN user ux ON u.updated_by = ux.id
		LEFT JOIN user ucreate ON u.created_by = ucreate.id WHERE 1  AND u.status = 1 AND u.status_dasar = Array
ERROR - 2023-02-02 17:17:34 --> Severity: error --> Exception: Call to a member function row_array() on bool D:\laragon\www\sidega-master\donjo-app\models\Penduduk_model.php 228
ERROR - 2023-02-02 17:22:57 --> Query error: Unknown table 'u' in field list - Invalid query: SELECT COUNT(u.id) as jml
ERROR - 2023-02-02 17:22:57 --> Severity: error --> Exception: Call to a member function row() on bool D:\laragon\www\sidega-master\donjo-app\models\Penduduk_model.php 245
ERROR - 2023-02-02 17:24:56 --> Query error: Unknown table 'u' in field list - Invalid query: SELECT COUNT(u.id) as jml
ERROR - 2023-02-02 17:24:56 --> Severity: error --> Exception: Call to a member function row() on bool D:\laragon\www\sidega-master\donjo-app\models\Penduduk_model.php 245
ERROR - 2023-02-02 17:26:29 --> Query error: Unknown table 'u' in field list - Invalid query: SELECT COUNT(u.id) as jml
ERROR - 2023-02-02 17:26:29 --> Severity: error --> Exception: Call to a member function row() on bool D:\laragon\www\sidega-master\donjo-app\models\Penduduk_model.php 245
