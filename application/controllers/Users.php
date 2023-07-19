<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends SB_Controller {

	Public $viewFolder="";

	Public function __construct() {
		parent::__construct();
		$this->viewFolder="panel/users_v";
		
		if (!get_active_user()) {
			redirect(base_url('login'));
		}

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
		$viewData->items=$this->Users_model->get_all(
			$where
		);
	
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);
	}

	public function new_form() {
		$viewData=new stdClass();
		
		$user_roles=$this->User_role_model->get_all(
			array(
				"isActive"=>1
			)
		);

		$viewData->user_roles=$user_roles;

		$viewData->viewFolder=$this->viewFolder;
		$viewData->subViewFolder="add";
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
	}

	public function save() {

		$this->form_validation->set_rules("user_name","Username","required|trim|is_unique[users.user_name]");
		$this->form_validation->set_rules("full_name","Full Name","required|trim");
		$this->form_validation->set_rules("user_role_id","User Role","required|trim");
		$this->form_validation->set_rules("password","Password","required|trim");
		$this->form_validation->set_rules("re_password","Re-Password","required|trim|matches[password]");
		$this->form_validation->set_rules("email","e-Mail","required|trim|valid_email|is_unique[users.email]");

		$this->form_validation->set_message(
			array(
				"required" => "Information must be entered in the <b>{field}</b> field",
				"valid_email" =>"Please enter a valid e-mail address in the <b>{field}</b> field",
				"is_unique" => "<b>{field}</b> has been used before.",
				"matches" => "The entered information does not match"
			)
		);

		$validate=$this->form_validation->run();

		/* İlgili form alanlarına bilgi girişi yapıldıysa */

		if($validate) {
			
			$insert_islemi=$this->Users_model->add(
				array(
					
					"full_name"	=>	PostVal("full_name"),
					"user_name"	=>	PostVal("user_name"),
					"password"	=>	md5(PostVal("password")),
					"user_role_id"=>PostVal("user_role_id"),
					"email"		=>	PostVal("email"),
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

			redirect(base_url('users'));

		} else {

		/*  Failed olduysa ilgili hatayı değişkene atayıp formda gösteriyoruz */

			$viewData=new stdClass();
			$user_roles=$this->User_role_model->get_all(
				array(
					"isActive"=>1
				)
			);
			$viewData->user_roles=$user_roles;
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
		$viewData->items=$this->Users_model->get(
			array(
				"id"=>$id
			)
		);
		$user_roles=$this->User_role_model->get_all(
			array(
				"isActive"=>1
			)
		);
		$viewData->user_roles=$user_roles;
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
	}

	public function update($id) {

		$oldUser=$this->Users_model->get(
			array(
				"id"=>$id
			)
		);

		if($oldUser->user_name!=PostVal("user_name")) {
			$this->form_validation->set_rules("user_name","Username","required|trim");
		}
		if($oldUser->email!=PostVal("email")) {
			$this->form_validation->set_rules("email","e-Mail","required|trim|valid_email");
		}
		$this->form_validation->set_rules("full_name","Full Name","required|trim");
		$this->form_validation->set_rules("user_role_id","User Role","required|trim");

		$this->form_validation->set_message(
			array(
				"required" => "Information must be entered in the <b>{field}</b> field",
				"valid_email" =>"Please enter a valid e-mail address in the <b>{field}</b> field",
				"matches" => "The entered information does not match"
			)
		);

		$validate=$this->form_validation->run();

		/* İlgili form alanlarına bilgi girişi yapıldıysa */

		if($validate) {
			
			$update_islemi=$this->Users_model->update(
				array(
					"id"=>$id
				),
				array(
					
					"full_name"	=>	PostVal("full_name"),
					"user_name"	=>	PostVal("user_name"),
					"email"		=>	PostVal("email"),
					"user_role_id"=>PostVal("user_role_id")
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

			redirect(base_url('users'));				
		} else {

		/*  Failed olduysa ilgili hatayı değişkene atayıp formda gösteriyoruz */
			$viewData=new stdClass();
			$viewData->viewFolder=$this->viewFolder;
			$viewData->subViewFolder="update";
			$user_roles=$this->User_role_model->get_all(
				array(
					"isActive"=>1
				)
			);
			$viewData->user_roles=$user_roles;

			$viewData->items=$this->Users_model->get(
			array(
				"id"=>$id
				)
			);
			$viewData->form_error=true;
			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
		}
	}
	
	public function delete($id) {

		$delete=$this->Users_model->delete(
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

		redirect("users");
	}

	public function update_password_form($id) {
		$viewData=new stdClass();
		$viewData->viewFolder=$this->viewFolder;
		$viewData->subViewFolder="password";

		$viewData->items=$this->Users_model->get(
			array(
				"id"=>$id
			)
		);
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
	}

	public function update_password($id) {
		$this->form_validation->set_rules("password","Password","required|trim");
		$this->form_validation->set_rules("re_password","Re-Password","required|trim|matches[password]");

		$this->form_validation->set_message(
			array(
				"required" => "Information must be entered in the <b>{field}</b> field",
				"matches" => "The entered information does not match"
			)
		);

		$validate=$this->form_validation->run();

		if($validate) {

			$update_islemi=$this->Users_model->update(
				array(
					"id"=>$id
				),
				array(
					"password"	=>	md5(PostVal("password"))
				)
			);

			if ($update_islemi) {
				
				$user=$this->Users_model->get(
				array(
					"id"=>$id
				));

				$mesaj="Dear $user->full_name,<p>".base_url()." You have changed your Password registered in our system. We are sending you this reminder e-mail so that you can take note of your login information.</p><p>You can use the following information in your next logins.</p><ul><li><b>Url Address to Login: ".base_url( 'login')."</li><li><b>Your Username : $user->user_name </b></li><li><b> Your Password : ".PostVal("password")."< /b></li></ul><p>Sincerely<br/><p>Support Team</p>";

				$send=send_email($user->email,"Password Changing",$mesaj);


				$alert=array(
					"title"=>"Successfully",
					"text"=>"Your password has been successfully updated",
					"type"=>"success"
				);
			
			} else {

				$alert=array(
					"title"=>"Failed",
					"text"=>"A problem occurred while updating the password",
					"type"=>"error"
				);
			}
		
			$this->session->set_flashdata("alert",$alert);

			redirect(base_url('users'));				
		} else {

		/*  Failed olduysa ilgili hatayı değişkene atayıp formda gösteriyoruz */
			$viewData=new stdClass();
			$viewData->viewFolder=$this->viewFolder;
			$viewData->subViewFolder="password";
			$viewData->items=$this->Users_model->get(
			array(
				"id"=>$id
				)
			);
			$viewData->form_error=true;
			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
		}
	}

	public function isActiveSetter($id){

	    if($id){

	        $isActive = ($this->input->post("data") === "true") ? 1 : 0;

	        $this->Users_model->update(
	            array(
	                "id"    => $id
	            ),
	            array(
	                "isActive"  => $isActive
	            )
	    	);
	    }
	}

	public function login()	{

		$viewData=new stdClass();
		$viewData->viewFolder=$this->viewFolder;
		$viewData->subViewFolder="login";
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);
	}

}
