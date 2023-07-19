<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rehber extends SB_Controller {

	Public $viewFolder="";

	Public function __construct() {
		parent::__construct();
		$this->viewFolder="panel/rehber_v";

		$this->load->model("Arabul_model");
		$this->load->model("Unvanlar_model");
		$this->load->model("Birimler_model");
		$this->load->model("Rehber_model");


	}

	public function index()
	{
		if (!isAllowedViewModule()) {
			redirect(base_url("dashboard"));
		}
		$viewData=new stdClass();
		$viewData->viewFolder=$this->viewFolder;
		$viewData->subViewFolder="list";
		
		$viewData->items=$this->Arabul_model->get_all(
			array(),
			'id asc'
		);

		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);
	}

	public function new_form() {

		if(!isAllowedWriteModule()){
			redirect(base_url("rehber"));
		}

		$viewData=new stdClass();
		$viewData->viewFolder=$this->viewFolder;
		$viewData->subViewFolder="add";
		$viewData->birimler=$this->Birimler_model->get_all();
		$viewData->unvanlar=$this->Unvanlar_model->get_all();
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
	}

	public function save() {

		if(!isAllowedWriteModule()){
			redirect(base_url($this->router->fetch_class()));
		}

		$this->form_validation->set_rules("birim_adi","Unit","required|trim");
		//$this->form_validation->set_rules("adi_soyadi","Full Name","required|trim");
		$this->form_validation->set_rules("telefon","Phone Number(s)","required|trim");


		$this->form_validation->set_message(
			array(
				"required" => "Information must be entered in the <b>{field}</b> field"
			)
		);

		$validate=$this->form_validation->run();

		/* İlgili form alanlarına bilgi girişi yapıldıysa */

		if($validate) {
			
			$insert_islemi=$this->Rehber_model->add(
				array(
					"birim"		=>PostVal("birim_adi"),
					"gorevi"	=>(PostVal("gorevi")) ? PostVal("gorevi"):'',
					"unvan"		=>(PostVal("unvani")<>"0") ? PostVal("unvani"):'',
					"adi_soyadi"=>PostVal("adi_soyadi"),
					"telefon"	=>PostVal("telefon"),
					"isActive" 	=> true,
					"createdAt"	=> date("Y-m-d H:i:s")
				)
			);

			if ($insert_islemi) {
				
				$alert=array(
					"text"=>"Successfully",
					"type"=>"success"
				);

			} else {

				$alert=array(
					"text"=>"Failed",
					"type"=>"error"
				);

			}
		// İşlem Sonucu Sessiona yazma işlemi
		
		$this->session->set_flashdata("alert",$alert);

		redirect(base_url('rehber'));

		} else {

		/*  Failed olduysa ilgili hatayı değişkene atayıp formda gösteriyoruz */

			$viewData=new stdClass();
			$viewData->viewFolder=$this->viewFolder;
			$viewData->subViewFolder="add";
			$viewData->birimler=$this->Birimler_model->get_all();
			$viewData->unvanlar=$this->Unvanlar_model->get_all();
			$viewData->form_error=true;
			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	

		}
	}

	public function update_form($id) {
		
		if(!isAllowedUpdateModule()){
			redirect(base_url($this->router->fetch_class()));
		}

		$viewData=new stdClass();
		$viewData->viewFolder=$this->viewFolder;
		$viewData->subViewFolder="update";
		
		$viewData->birimler=$this->Birimler_model->get_all();
		$viewData->unvanlar=$this->Unvanlar_model->get_all();
		$viewData->items=$this->Rehber_model->get(
			array(
				"id"=>$id
			)
		);
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
	}

	public function update($id) {

		if(!isAllowedUpdateModule()){
			redirect(base_url($this->router->fetch_class()));
		}

		$this->form_validation->set_rules("birim_adi","Unit","required|trim");
		//$this->form_validation->set_rules("adi_soyadi","Full Name","required|trim");
		$this->form_validation->set_rules("telefon","Phone Number(s)","required|trim");


		$this->form_validation->set_message(
			array(
				"required" => "Information must be entered in the <b>{field}</b> field"
			)
		);

		$validate=$this->form_validation->run();

		if($validate) {
			
			$update_islemi=$this->Rehber_model->update(
				array(
					"id"=>$id
				),
				array(
					"birim"		=>PostVal("birim_adi"),
					"gorevi"	=>(PostVal("gorevi")) ? PostVal("gorevi"):'',
					"unvan"		=>(PostVal("unvani")<>"0") ? PostVal("unvani"):'',
					"adi_soyadi"=>PostVal("adi_soyadi"),
					"telefon"	=>PostVal("telefon")
				)
			);

			if ($update_islemi) {
				
				/* Todo  İşlemle İlgili Alert Sistemi Eklenecek oluşturma */

				redirect(base_url('rehber'));

			} else {

				redirect(base_url('rehber'));				

			}


		} else {

		/*  Failed olduysa ilgili hatayı değişkene atayıp formda gösteriyoruz */
			$viewData=new stdClass();
			$viewData->viewFolder=$this->viewFolder;
			$viewData->subViewFolder="update";
			$viewData->items=$this->Rehber_model->get(
			array(
				"id"=>$id
				)
			);
			$viewData->birimler=$this->Birimler_model->get_all();
			$viewData->unvanlar=$this->Unvanlar_model->get_all();
			$viewData->form_error=true;
			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
		}
	}
	
	public function delete($id) {

		if(!isAllowedDeleteModule()){
			redirect(base_url($this->router->fetch_class()));
		}

		$delete=$this->Rehber_model->delete(
			array(
				"id"=>$id
			)
		);

		if ($delete) {

			redirect(base_url('rehber'));

		} else {

			redirect(base_url('rehber'));

		}
	}


	
	public function isActiveSetter($id){
			if(!isAllowedUpdateModule()){
				//redirect(base_url($this->router->fetch_class()));
				die();
			}
	        if($id){

	            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

	            $this->Rehber_model->update(
	                array(
	                    "id"    => $id
	                ),
	                array(
	                    "isActive"  => $isActive
	                )
	            );
	        }
	}

	public function rankSetter(){
			if(!isAllowedUpdateModule()){
				//redirect(base_url($this->router->fetch_class()));
				die();
			}

	        $data = $this->input->post("data");

	        parse_str($data, $order);

	        $items = $order["ord"];

	        foreach ($items as $rank => $id){

	            $this->Rehber_model->update(
	                array(
	                    "id"        => $id,
	                    "rank !="   => $rank
	                ),
	                array(
	                    "rank"      => $rank
	                )
	            );

	        }
	}




}
