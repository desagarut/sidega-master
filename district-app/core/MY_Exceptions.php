<?php

/*
 *
 * File ini bagian dari:
 *
 * OpenSID
 *
 * Sistem informasi desa sumber terbuka untuk memajukan desa
 *
 * Aplikasi dan source code ini dirilis berdasarkan lisensi GPL V3
 *
 * Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * Hak Cipta 2016 - 2022 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 *
 * Dengan ini diberikan izin, secara gratis, kepada siapa pun yang mendapatkan salinan
 * dari perangkat lunak ini dan file dokumentasi terkait ("Aplikasi Ini"), untuk diperlakukan
 * tanpa batasan, termasuk hak untuk menggunakan, menyalin, mengubah dan/atau mendistribusikan,
 * asal tunduk pada syarat berikut:
 *
 * Pemberitahuan hak cipta di atas dan pemberitahuan izin ini harus disertakan dalam
 * setiap salinan atau bagian penting Aplikasi Ini. Barang siapa yang menghapus atau menghilangkan
 * pemberitahuan ini melanggar ketentuan lisensi Aplikasi Ini.
 *
 * PERANGKAT LUNAK INI DISEDIAKAN "SEBAGAIMANA ADANYA", TANPA JAMINAN APA PUN, BAIK TERSURAT MAUPUN
 * TERSIRAT. PENULIS ATAU PEMEGANG HAK CIPTA SAMA SEKALI TIDAK BERTANGGUNG JAWAB ATAS KLAIM, KERUSAKAN ATAU
 * KEWAJIBAN APAPUN ATAS PENGGUNAAN ATAU LAINNYA TERKAIT APLIKASI INI.
 *
 * @package   OpenSID
 * @author    Tim Pengembang OpenDesa
 * @copyright Hak Cipta 2009 - 2015 Combine Resource Institution (http://lumbungkomunitas.net/)
 * @copyright Hak Cipta 2016 - 2022 Perkumpulan Desa Digital Terbuka (https://opendesa.id)
 * @license   http://www.gnu.org/licenses/gpl.html GPL V3
 * @link      https://github.com/OpenSID/OpenSID
 *
 */

class MY_Exceptions extends CI_Exceptions
{
    /**
     * @var CI_Controller
     */
    protected $ci;

    /**
     * List shared mysql/mariadb error code.
     *
     * @see https://mariadb.com/kb/en/mariadb-error-codes
     *
     * @var array
     */
    protected $db_error_codes = [1029, 1051, 1054, 1062, 1067, 1072, 1109, 1138, 1146, 1166, 1169, 1173, 1176, 1364, 1406, 1978];

    public function __construct()
    {
        parent::__construct();

        $this->ci = get_instance();
        $this->ci->session->unset_userdata(['db_error', 'message', 'message_query', 'heading', 'message_exception']);
    }

    /**
     * {@inheritDoc}
     */
    public function show_error($heading, $message, $template = 'error_general', $status_code = 500)
    {
        if ($template !== 'error_db') {
            return parent::show_error($heading, $message, $template, $status_code);
        }

        if (! empty($error = $this->ci->db->error()) && in_array($error['code'], $this->db_error_codes)) {
            $this->ci->session->db_error          = $error;
            $this->ci->session->message           = '<p>' . (is_array($error) ? implode('</p><p>', $error) : $error) . '</p>';
            $this->ci->session->heading           = $heading;
            $this->ci->session->message_query     = '<p>' . (is_array($message) ? implode('</p><p>', $message) : $message) . '</p>';
            $this->ci->session->message_exception = strip_tags((new \Exception())->getTraceAsString());

            return redirect('periksa');
        }

        return parent::show_error($heading, $message, $template, $status_code);
    }
}
