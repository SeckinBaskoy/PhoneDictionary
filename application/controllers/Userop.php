<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userop extends SB_Controller {

	Public $viewFolder="";

	Public function __construct() {
		parent::__construct();
		$this->viewFolder="panel/users_v";
	}

	public function login()	{

		if(get_active_user()) {
			redirect(base_url('rehber'));
		}

		$viewData=new stdClass();
		$viewData->viewFolder=$this->viewFolder;
		$viewData->subViewFolder="login";

		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);}

	public function do_login() {

		if(get_active_user()) {
			redirect(base_url('rehber'));
		}


		$this->form_validation->set_rules("sign-in-user_name","Username","required|trim");
		$this->form_validation->set_rules("sign-in-password","Password","required|trim");

		$this->form_validation->set_message(
			array(
				"required" => "Information must be entered in the <b>{field}</b> field",
			)
		);

		$validate=$this->form_validation->run();

		/* İlgili form alanlarına bilgi girişi yapıldıysa */

		if($validate==FALSE) {

			$viewData=new stdClass();
			$viewData->viewFolder=$this->viewFolder;
			$viewData->subViewFolder="login";
			$viewData->form_error=true;
			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);

		} else {

			$user=$this->Users_model->get(
				array(
					"user_name"=>PostVal("sign-in-user_name"),
					"password"=>md5(PostVal("sign-in-password")),
					"isActive"=>1
				)
			);

			if ($user) {

				$alert=array(
					"title"=>"Wellcome",
					"text"=>$user->full_name." Wellcome",
					"type"=>"success"
				);

				setUserRoles();

				$this->session->set_flashdata("alert",$alert);
				$this->session->set_userdata("user",$user);

				redirect(base_url('rehber'));

			} else {

				$alert=array(
					"title"=>"Login Failed",
					"text"=>"Please check your login information.",
					"type"=>"error"
				);

				$this->session->set_flashdata("alert",$alert);
				redirect(base_url('login'));

			}

		}}

	public function logout() {

		$alert=array(
			"title"=>"We are waiting for you again",
			"text"=>$user->full_name." you have successfully logged out",
			"type"=>"success"
		);

		setUserRoles();

		$this->session->set_flashdata("alert",$alert);
		$this->session->unset_userdata("user");
		redirect(base_url('login'));
	}

	public function forget_password() {

		if(get_active_user()) {
			redirect(base_url('rehber'));
		}
		$viewData=new stdClass();

		$viewData->viewFolder=$this->viewFolder;
		$viewData->subViewFolder="forget_password";

		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);

	}

	public function reset_password() {

		$this->form_validation->set_rules("reset-password-email","e-Posta Address","required|trim|valid_email");

		$this->form_validation->set_message(
			array(
				"required" => "Information must be entered in the <b>{field}</b> field",
				"valid_email" => "A valid e-mail address must be entered in the <b>{field}</b> field",
			)
		);

		$validate=$this->form_validation->run();

		if($validate=FALSE) {

			$viewData=new stdClass();
			$viewData->viewFolder=$this->viewFolder;
			$viewData->subViewFolder="forget_password";
			$viewData->form_error=true;
			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);

		} else
		{

			$user=$this->Users_model->get(
				array(
					"isActive"=>1,
					"email"=>PostVal("reset-password-email")
				));

			if ($user) {

				$temp_password=random_string();

 				$this->Users_model->update(
                                                array(
                                                        "id"=>$user->id
                                                        ),
                                                array (
                                                        "password"=>md5($temp_password),
                                                        "createdAt" =>  date('Y-m-d H:i:s')
                                                        )
                                                );


				//echo $temp_password;
				//die();

				$mesaj="Dear $user->full_name,<p>".base_url()." Your password registered in our system has been renewed by the system upon your request.</p>
<p>You can login to the system with your new Password.</p><ul><li>Url Address to login: ".base_url('login')."</li><li><b>Your Username: $user ->user_name </b></li>
<li><b> Your Password : $temp_password</b></li></ul><p>Best Regards<br/><p>Support Team</p>";

				$send=send_email($user->email,"I forgot my password",$mesaj);

				if($send) {
					echo "Email sent successfully";
					
					$alert=array(
						"title"=>"Successfully",
						"text"=>"Your password has been successfully sent to your e-mail address.",
						"type"=>"success"
					);

					$this->session->set_flashdata("alert",$alert);

					redirect(base_url("login"));
					die();
				} else {
					echo $this->email->print_debugger();
				}


			} else {

				$alert=array(
					"title"=>"Failed",
					"text"=>"No such user found.",
					"type"=>"error"
				);

				$this->session->set_flashdata("alert",$alert);

				redirect(base_url("Passwordmi-unuttum"));

			}


		}

	}


}
