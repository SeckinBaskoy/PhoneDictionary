<?php defined('BASEPATH') OR exit('No direct script access allowed'); class Www extends SB_Controller {
	Public function __construct() {
		parent::__construct();
	}
	public function index()
	{
		$this->load->view('web/anasayfa');
	}
	public function bulgetir() {
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
				$output = '';
				$query = '';
				$this->load->model('arabul_model');
				if(PostVal('query'))
				{
					$query = PostVal('query');
				}
				$items = $this->arabul_model->bulgetir_data($query);
				?>
				<div class="widget-body">
      			<div class="table-responsive">
        		<?php if(empty($items)) { ?>
        			<div class="alert alert-info text-center">
                		<p>There are no records here.</p>
              		</div>
        		<?php } else { ?>
        		<table id="default-datatable" data-plugin="DataTable" class="table table-hover" cellspacing="0" width="100%">
          			<thead>
            			<tr>
              				<th class="col-xs-3 col-sm-3 col-md-3 col-lg-4">Unit</th>
              				<th class="col-xs-2 col-sm-2 col-md-2 col-lg-3">Position / Place Name</th>
              				<th class="col-xs-2 col-sm-2 col-md-2 col-lg-3">Title, Name Surname</th>
              				<th class="col-xs-1 col-sm-1 col-md-1 col-lg-2">Phone Numbers</th>
            			</tr>
          			</thead>
          			<tbody>
          			<?php foreach ($items->result() as $item) { ?>
            			<tr>
              				<td><?=($item->birimi) ? $item->birimi:'';?></td>
              				<td><?=$item->gorevi;?></td>
              				<td>
							<?php
							if ($item->unvani>"0") {
									$bulunan_isim=$item->adi_soyadi;
							} else {
								$bulunan_isim=$item->adi_soyadi;
							}
							?>
							<?php
								echo $bulunan_isim;
							?>
							</td>
              				<td><?=$item->telefon;?></td>
						</tr>
          			<?php } ?>
          			</tbody>
        		</table>
      			<?php } ?>
      			</div>
    			</div> <?php
		}
	}
}
