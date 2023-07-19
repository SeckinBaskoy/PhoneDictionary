<?php if (isset($form_error)) { $alan_sinifi="input-form-error"; } ?>
<!-- DOM dataTable -->
<div class="col-md-12">
	<div class="widget">
		<header class="widget-header">
			<h4 class="widget-title">You are changing password of <b><?=$items->full_name;?> (<?=$items->user_name;?>)</b></h4>
		</header><!-- .widget-header -->
		<hr class="widget-separator">
		<div class="widget-body">
			<?=form_open("users/update_password/$items->id");?>
				<div class="form-group">
					<?=form_label('Password', 'password',array('class'=>'col-sm-2 col-md-2 col-lg-2 form-label text-right')); ?>
					<div class="col-sm-10 col-md-10 col-lg-10">
						<?=form_password('password', '',array("class"=>"form-control"));?>
						<?php 
					if (isset($form_error)) { ?>
						<small class="input-form-error pull-right"><?php echo form_error("password");?></small>
					<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<?=form_label('re-Password', 're_password',array('class'=>'col-sm-2 col-md-2 col-lg-2 form-label text-right')); ?>
					<div class="col-sm-10 col-md-10 col-lg-10">
						<?=form_password('re_password', '',array("class"=>"form-control"));?>
						<?php 
					if (isset($form_error)) { ?>
						<small class="input-form-error pull-right"><?php echo form_error("re_password");?></small>
					<?php } ?>
					</div>
				</div>
				<button type="submit" class="btn btn-primary btn-md btn-outline">Save</button>
				<a href="<?=base_url("users");?>" class="btn btn-danger btn-md btn-outline">Cancel</a>
			<?=form_close();?>
		</div><!-- .widget-body -->
	</div><!-- .widget -->
</div>