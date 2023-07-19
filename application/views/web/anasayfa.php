<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('web/includes/head');

?>
<div class="container">
  <form id="sorguformu">
    <div class="form-group">
  		<input type="text" name="search_text" id="search_text" placeholder="Welcome! I can help you find the phone number of the person you want. Please enter the name of the person or institution you want to search" class="form-control" />
 	  </div>
  </form>
</div>
<p><br></p>
<div class="container">
  <div id="sonuclar" class="table-responsive">
  </div>
  <p></p>
</div>
<div style="clear:both"></div>
<?php $this->load->view('web/includes/foot');?>

