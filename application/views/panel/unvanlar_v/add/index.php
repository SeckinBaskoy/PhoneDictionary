<!DOCTYPE html>
<html lang="tr">
<head>
<?php $this->load->view("panel/includes/head");?>
</head>
  
<body class="menubar-left menubar-unfold menubar-light theme-primary">

<?php $this->load->view("panel/includes/navbar");?>
<?php $this->load->view("panel/includes/aside");?>

  <main id="app-main" class="app-main">
    <div class="wrap">
      <section class="app-content">
         <div class="row">
            <?php $this->load->view("{$viewFolder}/{$subViewFolder}/content");?>  
         </div>
       </section>
    </div>
    <?php $this->load->view("panel/includes/footer");?>
  </main>

<?php $this->load->view("panel/includes/include_script");?>
</body>
</html>