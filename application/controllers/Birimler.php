<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Birimler extends SB_Controller {

	Public $viewFolder="";

	Public function __construct() {
		parent::__construct();
		$this->viewFolder="panel/birimler_v";
		
		$this->load->model("Birimler_model");

		if (!get_active_user()) {
			redirect(base_url('login'));
		}

	}

	public function index()
	{
		$viewData=new stdClass();
		$viewData->viewFolder=$this->viewFolder;
		$viewData->subViewFolder="list";
		/* Tablodan verilerin getirilmesi */
		$viewData->items=$this->Birimler_model->get_all(
			array(),
			array(),
			"rank ASC"
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

		$this->form_validation->set_rules("birim_adi","Unit","required|trim");

		$this->form_validation->set_message(
			array(
				"required" => "Information must be entered in the <b>{field}</b> field"
			)
		);

		$validate=$this->form_validation->run();

		/* İlgili form alanlarına bilgi girişi yapıldıysa */

		if($validate) {
			
			$insert_islemi=$this->Birimler_model->add(
				array(
					"birim_adi"=>PostVal("birim_adi"),
					"isActive" => true
				)
			);

			if ($insert_islemi) {
				
				$alert=array(
					'title'=>'Successfully',
					'text'=>'Registration successfully added',
					'type'=>'success'
				);

			} else {

				$alert=array(
					'title'=>'Failed',
					'text'=>'An error occurred during the registration process',
					'type'=>'error'
				);

			}

		$this->session->set_flashdata('alert',$alert);
		
		redirect(base_url('birimler'));				

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

		$viewData->items=$this->Birimler_model->get(
			array(
				"id"=>$id
			)
		);
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
	}

	public function update($id) {

		$this->form_validation->set_rules("birim_adi","Unit","required|trim");

		$this->form_validation->set_message(
			array(
				"required" => "Information must be entered in the <b>{field}</b> field"
			)
		);

		$validate=$this->form_validation->run();

		/* İlgili form alanlarına bilgi girişi yapıldıysa */

		if($validate) {
			
			$update_islemi=$this->Birimler_model->update(
				array(
					"id"=>$id
				),
				array(
					"birim_adi"=>PostVal("birim_adi"),
				)
			);

			if ($update_islemi) {
				
				/* Todo  İşlemle İlgili Alert Sistemi Eklenecek oluşturma */

				redirect(base_url('birimler'));

			} else {

				redirect(base_url('birimler'));				

			}


		} else {

		/*  Failed olduysa ilgili hatayı değişkene atayıp formda gösteriyoruz */
			$viewData=new stdClass();
			$viewData->viewFolder=$this->viewFolder;
			$viewData->subViewFolder="update";
			$viewData->items=$this->Birimler_model->get(
			array(
				"id"=>$id
				)
			);
			$viewData->form_error=true;
			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);	
		}
	}
	
	public function delete($id) {

		$delete=$this->Birimler_model->delete(
			array(
				"id"=>$id
			)
		);
		
		if ($delete) {
				
				$alert=array(
					'title'=>'Successfully',
					'text'=>'Record successfully deleted',
					'type'=>'success'
				);

			} else {

				$alert=array(
					'title'=>'Failed',
					'text'=>'Kayıt silme işlemi sırasında bir hata oluştu',
					'type'=>'error'
				);

			}

		$this->session->set_flashdata('alert',$alert);
		
		redirect(base_url('birimler'));			



	}


	
public function isActiveSetter($id){

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->Birimler_model->update(
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

            $this->Birimler_model->update(
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
