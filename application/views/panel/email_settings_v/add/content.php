<?php if (isset($form_error)) { $alan_sinifi="input-form-error"; } ?>
<!-- DOM dataTable -->
<div class="col-md-12">
	<div class="widget">
		<header class="widget-header">
			<h4 class="widget-title">Add New e-Mail Accountr</h4>
		</header><!-- .widget-header -->
		<hr class="widget-separator">
		<div class="widget-body">
			<?=form_open("emailsettings/save");?>
				<div class="form-group">
					<?=form_label('Protocol', 'protocol',array('class'=>'col-sm-3 col-md-3 col-lg-3 form-label text-right')); ?>
					<div class="col-sm-9 col-md-9 col-lg-9">
						<?=form_input('protocol', '',array("class"=>"form-control"));?>
					</div>
				</div>
				<div class="form-group">
					<?=form_label('Server Name', 'host',array('class'=>'col-sm-3 col-md-3 col-lg-3 form-label text-right')); ?>
					<div class="col-sm-9 col-md-9 col-lg-9">
						<?=form_input('host', '',array("class"=>"form-control"));?>
					</div>
				</div>
				<div class="form-group">
					<?=form_label('Port', 'port',array('class'=>'col-sm-3 col-md-3 col-lg-3 form-label text-right')); ?>
					<div class="col-sm-9 col-md-9 col-lg-9">
						<?=form_input('port', '',array("class"=>"form-control"));?>
					</div>
				</div>
				<div class="form-group">
					<?=form_label('e-Mail Address (user)', 'user',array('class'=>'col-sm-3 col-md-3 col-lg-3 form-label text-right')); ?>
					<div class="col-sm-9 col-md-9 col-lg-9">
						<?=form_input('user', '',array("class"=>"form-control"));?>
					</div>
				</div>
				<div class="form-group">
					<?=form_label('Password', 'password',array('class'=>'col-sm-3 col-md-3 col-lg-3 form-label text-right')); ?>
					<div class="col-sm-9 col-md-9 col-lg-9">
						<?=form_input('password', '',array("class"=>"form-control"));?>
					</div>
				</div>
				<div class="form-group">
					<?=form_label('From', 'kimden',array('class'=>'col-sm-3 col-md-3 col-lg-3 form-label text-right')); ?>
					<div class="col-sm-9 col-md-9 col-lg-9">
						<?=form_input('kimden', '',array("class"=>"form-control"));?>
					</div>
				</div>
				<div class="form-group">
					<?=form_label('To', 'kime',array('class'=>'col-sm-3 col-md-3 col-lg-3 form-label text-right')); ?>
					<div class="col-sm-9 col-md-9 col-lg-9">
						<?=form_input('kime', '',array("class"=>"form-control"));?>
					</div>
				</div>
				<div class="form-group">
					<?=form_label('Alias Name', 'user_name',array('class'=>'col-sm-3 col-md-3 col-lg-3 form-label text-right')); ?>
					<div class="col-sm-9 col-md-9 col-lg-9">
						<?=form_input('user_name', '',array("class"=>"form-control"));?>
					</div>
				</div>

				<button type="submit" class="btn btn-primary btn-md btn-outline">Save</button>
				<a href="<?=base_url("emailsettings");?>" class="btn btn-danger btn-md btn-outline">Cancel</a>
			<?=form_close();?>
		</div><!-- .widget-body -->
	</div><!-- .widget -->
</div>