<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_role_model extends SB_Model{

	public function __construct() {
		parent::__construct();
		$this->tableName="user_roles";
	}


}