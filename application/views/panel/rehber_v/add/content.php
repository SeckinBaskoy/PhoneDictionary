<!-- DOM dataTable -->
<div class="col-md-12">
	<div class="widget">
		<header class="widget-header">
			<h4 class="widget-title">Add New Record</h4>
		</header><!-- .widget-header -->
		<hr class="widget-separator">
		<div class="widget-body">
			<?=form_open("rehber/save",array("class"=>"form-horizontal"));?>
				<div class="form-group">
					<?=form_label('Unit', 'birim_adi',array('class'=>'col-sm-2 col-md-2 col-lg-2 form-label text-right')); ?>
					<div class="col-sm-10 col-md-10 col-lg-10">
						<?=form_dropdown('birim_adi', SecenekDoldur($birimler,"Birim_Adi"),set_value('birim_adi',0),array("class"=>"form-control"));?>
					</div>
					<?php 
					if (isset($form_error)) { ?>
						<small class="input-form-error pull-right"><?php echo form_error("birim_adi");?></small>
					<?php } ?>
				</div>
				<div class="form-group">
					<?=form_label('Position / Place Name', 'gorevi',array('class'=>'col-sm-2 col-md-2 col-lg-2 form-label text-right')); ?>
					<div class="col-sm-10 col-md-10 col-lg-10">
						<?=form_input('gorevi', '',array("class"=>"form-control"));?>
					</div>
					<?php 
					if (isset($form_error)) { ?>
						<small class="input-form-error pull-right"><?php echo form_error("gorevi");?></small>
					<?php } ?>

				</div>
				<div class="form-group">
					
					<?=form_label('Title (if applicable)', 'unvani',array('class'=>'col-sm-2 col-md-2 col-lg-2 form-label text-right')); ?>
					
					<div class="col-sm-10 col-md-10 col-lg-10">
					<?=form_dropdown('unvani', SecenekDoldur($unvanlar,"unvan_adi"),set_value('unvan_adi',0),array("class"=>"form-control"));?>
					</div>
					<?php 
					if (isset($form_error)) { ?>
						<small class="input-form-error pull-right"><?php echo form_error("unvani");?></small>
					<?php } ?>

				</div>
				<div class="form-group">
					<?=form_label('Full Name', 'adi_soyadi',array('class'=>'col-sm-2 col-md-2 col-lg-2 form-label text-right')); ?>
					<div class="col-sm-10 col-md-10 col-lg-10">
						<?=form_input('adi_soyadi', '',array("class"=>"form-control"));?>
					</div>
					<?php 
					if (isset($form_error)) { ?>
						<small class="input-form-error pull-right"><?php echo form_error("adi_soyadi");?></small>
					<?php } ?>
				</div>

				<div class="form-group">
					<?=form_label('Phone Number(s)', 'telefon',array('class'=>'col-sm-2 col-md-2 col-lg-2 form-label text-right')); ?>
					<div class="col-sm-10 col-md-10 col-lg-10">
						<?=form_input('telefon', '',array("class"=>"form-control"));?>
					</div>
					<?php 
					if (isset($form_error)) { ?>
						<small class="input-form-error pull-right"><?php echo form_error("telefon");?></small>
					<?php } ?>
				</div>
				<?=form_submit("submit","Save",array("class"=>"btn btn-primary btn-md btn-outline"));?>
				<!--<button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>-->
				<a href="<?=base_url("rehber");?>" class="btn btn-danger btn-md btn-outline">Cancel</a>
			<?=form_close();?>
		</div><!-- .widget-body -->
	</div><!-- .widget -->
</div>