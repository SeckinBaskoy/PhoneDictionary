<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Birimler_model extends SB_Model{

	public function __construct() {
		parent::__construct();
		$this->tableName="birimi";
	}


}