<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_role extends SB_Controller {

	Public $viewFolder="";

	Public function __construct() {
		parent::__construct();
		$this->viewFolder="panel/user_roles_v";
		
		if (!get_active_user()) {
			redirect(base_url('login'));
		}

		
		$this->load->model("user_role_model");

	}

	public function index()
	{
		$viewData=new stdClass();
		$viewData->viewFolder=$this->viewFolder;
		$viewData->subViewFolder="list";

		$user=get_active_user();

		if (isAdmin()) {
			$where=array();

		} else {
			$where=array(
				"id"=>$user->id
			);
		}

		/* Tablodan verilerin getirilmesi */
		$viewData->items=$this->user_role_model->get_all(
			$where
		);
	
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);
	}

	public function new_form() {
		$viewData=new stdClass();
		$viewData->viewFolder=$this->viewFolder;
		$viewData->subViewFolder="add";
	
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
	}

	public function save() {

		$this->form_validation->set_rules("title","User Role","required|trim");

		$this->form_validation->set_message(
			array(
				"required" => "Information must be entered in the <b>{field}</b> field",
			)
		);

		$validate=$this->form_validation->run();

		if($validate) {
			
			$insert_islemi=$this->user_role_model->add(
				array(
					"title"	=>	PostVal("title"),
					"isActive" =>1,
					"createdAt" => date('Y-m-d H:i:s')
				)
			);

			if ($insert_islemi) {
				
				/* Todo  İşlemle İlgili Alert Sistemi Eklenecek oluşturma */
				$alert=array(
					"title"=>"Successfully",
					"text"=>"Registration successfully added",
					"type"=>"success"
				);
			} else {
				$alert=array(
					"title"=>"Failed",
					"text"=>"An error occurred during the registration process",
					"type"=>"error"
				);
			}

			$this->session->set_flashdata("alert",$alert);

			redirect(base_url('user_role'));

		} else {

		/*  Failed olduysa ilgili hatayı değişkene atayıp formda gösteriyoruz */

			$viewData=new stdClass();
			$viewData->viewFolder=$this->viewFolder;
			$viewData->subViewFolder="add";
			$viewData->form_error=true;
			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	

		}
	}

	public function update_form($id) {
		$viewData=new stdClass();
		$viewData->viewFolder=$this->viewFolder;
		$viewData->subViewFolder="update";

		$viewData->items=$this->user_role_model->get(
			array(
				"id"=>$id
			)
		);
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
	}

	public function update($id) {

		$this->form_validation->set_rules("title","User Role","required|trim");

		$this->form_validation->set_message(
			array(
				"required" => "Information must be entered in the <b>{field}</b> field",
			)
		);

		$validate=$this->form_validation->run();

		if($validate) {
			
			$update_islemi=$this->user_role_model->update(
				array(
					"id"=>$id
				),
				array(
					
					"title"	=>	PostVal("title"),
				)
			);

			if ($update_islemi) {
				
				$alert=array(
					"title"=>"Successfully",
					"text"=>"Registration successfully updated",
					"type"=>"success"
				);
			
			} else {

				$alert=array(
					"title"=>"Failed",
					"text"=>"A problem occurred while updating the registry.",
					"type"=>"error"
				);
			}
		
			$this->session->set_flashdata("alert",$alert);

			redirect(base_url('user_role'));				
		} else {

		/*  Failed olduysa ilgili hatayı değişkene atayıp formda gösteriyoruz */
			$viewData=new stdClass();
			$viewData->viewFolder=$this->viewFolder;
			$viewData->subViewFolder="update";
			$viewData->items=$this->user_role_model->get(
			array(
				"id"=>$id
				)
			);
			$viewData->form_error=true;
			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
		}
	}
	
	public function delete($id) {

		$delete=$this->user_role_model->delete(
			array(
				"id"=>$id
			)
		);

		if ($delete) {

			$alert=array(
				"title"=>"Successfully",
				"text"=>"Record successfully deleted",
				"type"=>"success"
			);
			

		} else {

			$alert=array(
				"title"=>"Failed",
				"text"=>"A problem occurred while deregistering",
				"type"=>"error"
			);
			
		}

		$this->session->set_flashdata("alert",$alert);

		redirect("user_role");
	}



	public function isActiveSetter($id){

	        if($id){

	            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

	            $this->user_role_model->update(
	                array(
	                    "id"    => $id
	                ),
	                array(
	                    "isActive"  => $isActive
	                )
	            );
	        }
	}

	public function permissions_form($id) {
		
		$viewData=new stdClass();
		$viewData->viewFolder=$this->viewFolder;
		$viewData->subViewFolder="permissions";

		$viewData->items=$this->user_role_model->get(
			array(
				"id"=>$id
			)
		);
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
	}

	public function update_permissions($id) {


		$permissions=json_encode($this->input->post("permissions"));
		
			$update_islemi=$this->user_role_model->update(
				array(
					"id"=>$id
				),
				array(
					"permissions"	=>	$permissions
				)
			);

			if ($update_islemi) {

				$alert=array(
					"title"=>"Successfully",
					"text"=>"Yetki tanımı başarılı bir şekilde güncellendi",
					"type"=>"success"
				);
			
			} else {

				$alert=array(
					"title"=>"Failed",
					"text"=>"Yetki tanımı güncelleme sırasında bir problem oluştu",
					"type"=>"error"
				);
			}
		
			$this->session->set_flashdata("alert",$alert);

			redirect(base_url('user_role/permissions_form/'.$id));
}





}
