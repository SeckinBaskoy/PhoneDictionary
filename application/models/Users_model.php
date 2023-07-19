<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends SB_Model{

	public function __construct() {
		parent::__construct();
		$this->tableName="users";
	}


}