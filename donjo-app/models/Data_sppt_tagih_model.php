<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Data_sppt_tagih_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->model('pamong_model');
		$this->load->model('data_sppt_model');
	}

    public function fetchAll(){
        $query = $this->db->query("SELECT * FROM tbl_data_sppt_tagih a
        ORDER BY a.id_tagih DESC");

        return $query;

    }

    public function fetchBelumBayar(){
        $query = $this->db->query("SELECT * FROM `tbl_data_sppt_tagih` where ket = 'Belum Bayar'");

        return $query;
    }

    public function fetchData($limit, $start){
        $query = $this->db->query("SELECT * FROM tbl_data_sppt_tagih a
        ORDER BY a.id_tagih DESC
        LIMIT " . $start . ", " . $limit);

        return $query;
    }
    
    public function fetchSingle($id){
        return $this->db->get_where('tbl_data_sppt_tagih', array('id_tagih' => $id_tagih));
    }

    public function insertData($data){
        $this->db->insert('tbl_data_sppt_tagih', $data);
    }

    public function updateData($data){
        $this->db->where("id", $data['id']);
        $this->db->update("tbl_data_sppt_tagih", $data);
    }
    function deleteData($id){
        $this->db->where('id', $id);
        $this->db->delete('tbl_data_sppt_tagih');
    }

    public function insertDataBayar($data){
        $this->db->insert('data_bayar', $data);
    }
}
