<!DOCTYPE html>
<html lang="tr">
<head>
<?php $this->load->view("panel/includes/head");?>
<?php $this->load->view("{$viewFolder}/{$subViewFolder}/page_style");?>
</head>
<body class="simple-page">
  <div class="wrap">
    <section class="app-content">
      <div class="row">
        <?php $this->load->view("{$viewFolder}/{$subViewFolder}/content");?>  
      </div>
    </section>
  </div>
<?php $this->load->view("{$viewFolder}/{$subViewFolder}/page_script");?>
</body>
</html>