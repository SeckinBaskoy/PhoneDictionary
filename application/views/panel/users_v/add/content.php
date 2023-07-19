<!-- DOM dataTable -->
<div class="col-md-12">
	<div class="widget">
		<header class="widget-header">
			<h4 class="widget-title">Adding New User</h4>
		</header><!-- .widget-header -->
		<hr class="widget-separator">
		<div class="widget-body">
			<?=form_open("users/save");?>
				<div class="form-group">
					<?=form_label('Full Name', 'full_name',array('class'=>'col-sm-2 col-md-2 col-lg-2 form-label text-right')); ?>
					<div class="col-sm-10 col-md-10 col-lg-10">
						<?=form_input('full_name', '',array("class"=>"form-control"));?>
					</div>
				</div>
				<div class="form-group">
					<?=form_label('User Name', 'user_name',array('class'=>'col-sm-2 col-md-2 col-lg-2 form-label text-right')); ?>
					<div class="col-sm-10 col-md-10 col-lg-10">
						<?=form_input('user_name', '',array("class"=>"form-control"));?>
					</div>
				</div>

				<div class="form-group">
					<?=form_label('User Role', 'user_role_id',array('class'=>'col-sm-2 col-md-2 col-lg-2 form-label text-right')); ?>
					<div class="col-sm-10 col-md-10 col-lg-10">
						<?=form_dropdown('user_role_id', SecenekDoldur($user_roles,"title"),set_value('user_role_id',0),array("class"=>"form-control"));?>
					</div>
					<?php 
					if (isset($form_error)) { ?>
						<small class="input-form-error pull-right"><?php echo form_error("user_role_id");?></small>
					<?php } ?>
				</div>

				<div class="form-group">
					<?=form_label('Password', 'password',array('class'=>'col-sm-2 col-md-2 col-lg-2 form-label text-right')); ?>
					<div class="col-sm-10 col-md-10 col-lg-10">
						<?=form_password('password', '',array("class"=>"form-control"));?>
					</div>
				</div>
				<div class="form-group">
					<?=form_label('re-Password', 're_password',array('class'=>'col-sm-2 col-md-2 col-lg-2 form-label text-right')); ?>
					<div class="col-sm-10 col-md-10 col-lg-10">
						<?=form_password('re_password', '',array("class"=>"form-control"));?>
					</div>
				</div>
				<div class="form-group">
					<?=form_label('e-Mail', 'email',array('class'=>'col-sm-2 col-md-2 col-lg-2 form-label text-right')); ?>
					<div class="col-sm-10 col-md-10 col-lg-10">
						<?php $emaildata = ['type'  => 'email','name'  => 'email','id' => 'email','class' => 'form-control'];?>
						<?=form_input($emaildata);?>
					</div>

				</div>

				<button type="submit" class="btn btn-primary btn-md btn-outline">Save</button>
				<a href="<?=base_url("users");?>" class="btn btn-danger btn-md btn-outline">Cancel</a>
			<?=form_close();?>
		</div><!-- .widget-body -->
	</div><!-- .widget -->
</div>