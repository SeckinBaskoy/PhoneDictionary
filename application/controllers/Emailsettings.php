<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailsettings extends SB_Controller {

	Public $viewFolder="";

	Public function __construct() {
		parent::__construct();
		$this->viewFolder="panel/email_settings_v";
		
		if (!get_active_user()) {
			redirect(base_url('login'));
		}

		
		$this->load->model("emailsettings_model");

	}

	public function index()
	{
		$viewData=new stdClass();
		$viewData->viewFolder=$this->viewFolder;
		$viewData->subViewFolder="list";
		/* Tablodan verilerin getirilmesi */
		$viewData->items=$this->emailsettings_model->get_all();
	
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);
	}

	public function new_form() {
		$viewData=new stdClass();
		$viewData->viewFolder=$this->viewFolder;
		$viewData->subViewFolder="add";
	
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
	}

	public function save() {

		/*
		protocol - Protokol
		port - Port Numarası
		host - e-Mail Sunucusu
		user - e-Mail Adresi 
		password - Password
		kimden - Kimden Gidecek (from)
		kime - Kime Gidecek (to)
		user_name - Görünen İsim
		isActive
		*/
		$this->form_validation->set_rules("protocol","Protokol","required|trim");
		$this->form_validation->set_rules("port","Port ","required|trim");
		$this->form_validation->set_rules("host","e-Mail Server","required|trim");
		$this->form_validation->set_rules("user","e-Mail Address","required|trim|valid_email");
		$this->form_validation->set_rules("password","Password","required|trim");
		$this->form_validation->set_rules("kimden","From","required|trim|valid_email");
		$this->form_validation->set_rules("kime","To Where","required|trim|valid_email");
		$this->form_validation->set_rules("user_name","Alias Name","required|trim");

		$this->form_validation->set_message(
			array(
				"required" => "Information must be entered in the <b>{field}</b> field",
				"valid_email" =>"Please enter a valid e-mail address in the <b>{field}</b> field",
			)
		);

		$validate=$this->form_validation->run();

		/* İlgili form alanlarına bilgi girişi yapıldıysa */

		if($validate) 
		{
			
			$insert_islemi=$this->emailsettings_model->add(
				array(
					"protocol"	=>	PostVal("protocol"),
					"host"		=>	PostVal("host"),
					"port"		=>	PostVal("port"),
					"user"		=>	PostVal("user"),					
					"password"	=>	PostVal("password"),
					"kimden"	=>	PostVal("kimden"),
					"kime"		=>	PostVal("kime"),
					"user_name"	=>	PostVal("user_name"),
					"isActive" 	=> 	true,
					"createdAt" => 	date('Y-m-d H:i:s')
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

			redirect(base_url('emailsettings'));

		} else {

			//echo validation_errors();

		/*  Failed olduysa ilgili hatayı değişkene atayıp formda gösteriyoruz */
			$alert=array(
				"title"=>"Failed",
				"text"=>"An error occurred during the registration process",
				"type"=>"error"
			);
			$this->session->set_flashdata("alert",$alert);
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

		$viewData->items=$this->emailsettings_model->get(
			array(
				"id"=>$id
			)
		);
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
	}

	public function update($id) {
		
		$this->form_validation->set_rules("protocol","Protokol","required|trim");
		$this->form_validation->set_rules("port","Port","required|trim");
		$this->form_validation->set_rules("host","e-Mail Server","required|trim");
		$this->form_validation->set_rules("user","e-Mail Address","required|trim|valid_email");
		$this->form_validation->set_rules("password","Password","required|trim");
		$this->form_validation->set_rules("kimden","From","required|trim|valid_email");
		$this->form_validation->set_rules("kime","To Where","required|trim|valid_email");
		$this->form_validation->set_rules("user_name","Alias Name","required|trim");

		$this->form_validation->set_message(
			array(
				"required" => "Information must be entered in the <b>{field}</b> field",
				"valid_email" =>"Please enter a valid e-mail address in the <b>{field}</b> field",
			)
		);

		$validate=$this->form_validation->run();

		/* İlgili form alanlarına bilgi girişi yapıldıysa */

		if($validate) {
			
			$update_islemi=$this->emailsettings_model->update(
				array(
					"id"=>$id
				),
				array(
					"protocol"	=>	PostVal("protocol"),
					"host"		=>	PostVal("host"),
					"port"		=>	PostVal("port"),
					"user"		=>	PostVal("user"),					
					"password"	=>	PostVal("password"),
					"kimden"	=>	PostVal("kimden"),
					"kime"		=>	PostVal("kime"),
					"user_name"	=>	PostVal("user_name"),
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

			redirect(base_url('emailsettings'));				
		} else {

		/*  Failed olduysa ilgili hatayı değişkene atayıp formda gösteriyoruz */
			$viewData=new stdClass();
			$viewData->viewFolder=$this->viewFolder;
			$viewData->subViewFolder="update";
			$viewData->items=$this->emailsettings_model->get(
			array(
				"id"=>$id
				)
			);
			$viewData->form_error=true;
			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
		}
	}
	
	public function delete($id) {

		$delete=$this->emailsettings_model->delete(
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

		redirect("emailsettings");
	}

	
public function isActiveSetter($id){

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->emailsettings_model->update(
                array(
                    "id"    => $id
                ),
                array(
                    "isActive"  => $isActive
                )
            );
        }
}










}
