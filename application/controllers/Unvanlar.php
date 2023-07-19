<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class unvanlar extends SB_Controller {

	Public $viewFolder="";

	Public function __construct() {
		parent::__construct();
		$this->viewFolder="panel/unvanlar_v";
		
		if (!get_active_user()) {
			redirect(base_url('login'));
		}
		
		$this->load->model("Unvanlar_model");

	}

	public function index()
	{
		$viewData=new stdClass();
		$viewData->viewFolder=$this->viewFolder;
		$viewData->subViewFolder="list";
		/* Tablodan verilerin getirilmesi */
		$viewData->items=$this->Unvanlar_model->get_all();
	
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);
	}

	public function new_form() {
		$viewData=new stdClass();
		$viewData->viewFolder=$this->viewFolder;
		$viewData->subViewFolder="add";
	
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
	}

	public function save() {

		$this->form_validation->set_rules("unvan_adi","Unvan Adı","required|trim");

		$this->form_validation->set_message(
			array(
				"required" => "Information must be entered in the <b>{field}</b> field"
			)
		);

		$validate=$this->form_validation->run();

		/* İlgili form alanlarına bilgi girişi yapıldıysa */

		if($validate) {
			
			$insert_islemi=$this->Unvanlar_model->add(
				array(
					"unvan_adi"=>PostVal("unvan_adi"),
					"isActive" => true,
					"createdAt" => date('Y-m-d H:i:s')
				)
			);

			if ($insert_islemi) {
				
				/* Todo  İşlemle İlgili Alert Sistemi Eklenecek oluşturma */

				redirect(base_url('unvanlar'));

			} else {

				redirect(base_url('unvanlar'));				

			}


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

		$viewData->items=$this->Unvanlar_model->get(
			array(
				"id"=>$id
			)
		);
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
	}

	public function update($id) {

		$this->form_validation->set_rules("unvan_adi","Unvan Adı","required|trim");

		$this->form_validation->set_message(
			array(
				"required" => "Information must be entered in the <b>{field}</b> field"
			)
		);

		$validate=$this->form_validation->run();

		/* İlgili form alanlarına bilgi girişi yapıldıysa */

		if($validate) {
			
			$update_islemi=$this->Unvanlar_model->update(
				array(
					"id"=>$id
				),
				array(
					"unvan_adi"=>PostVal("unvan_adi"),
				)
			);

			if ($update_islemi) {
				
				/* Todo  İşlemle İlgili Alert Sistemi Eklenecek oluşturma */

				redirect(base_url('unvanlar'));

			} else {

				redirect(base_url('unvanlar'));				

			}


		} else {

		/*  Failed olduysa ilgili hatayı değişkene atayıp formda gösteriyoruz */
			$viewData=new stdClass();
			$viewData->viewFolder=$this->viewFolder;
			$viewData->subViewFolder="update";
			$viewData->items=$this->Unvanlar_model->get(
			array(
				"id"=>$id
				)
			);
			$viewData->form_error=true;
			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
		}
	}
	
	public function delete($id) {

		$delete=$this->Unvanlar_model->delete(
			array(
				"id"=>$id
			)
		);

		if ($delete) {

			redirect("unvanlar");

		} else {

			redirect("unvanlar");

		}



	}


	
public function isActiveSetter($id){

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->Unvanlar_model->update(
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


        $data = $this->input->post("data");

        parse_str($data, $order);

        $items = $order["ord"];

        foreach ($items as $rank => $id){

            $this->Unvanlar_model->update(
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
