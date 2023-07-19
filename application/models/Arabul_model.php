<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Arabul_model extends SB_Model{

	public function __construct() {
		parent::__construct();
		$this->tableName="Telefon_Rehberi";
	}


	public function bulgetir_data($query)
	{
	    $this->db->select("*");
	    $this->db->from("Telefon_Rehberi");

	    if ($query != '') {
	        $q = $query;
	        $this->db->group_start();
	        $this->db->like('birimi', $q);    
	        $this->db->or_like('gorevi', $q);
	        $this->db->or_like('unvani', $q);
	        $this->db->or_like('adi_soyadi', $q);
	        $this->db->or_like('telefon', $q);
	        $this->db->group_end();
	    }

	    $this->db->where('isActive', '1');
	    $this->db->order_by('rank', 'ASC');

	    return $this->db->get();
	}


}
