<!-- DOM dataTable -->
<div class="col-md-12">
	<div class="widget">
		<header class="widget-header">
			<h4 class="widget-title">Add New User Role</h4>
		</header><!-- .widget-header -->
		<hr class="widget-separator">
		<div class="widget-body">
			<?=form_open("user_role/save");?>
				<div class="form-group">
					<label for="title">User Role Name</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="User Role Name">
					<?php if (isset($form_error)) { ?>
						<small class="input-form-error pull-right"><?php echo form_error("title");?></small>
					<?php } ?>
				</div>
				<button type="submit" class="btn btn-primary btn-md btn-outline">Save</button>
				<a href="<?=base_url("user_role");?>" class="btn btn-danger btn-md btn-outline">Camcel</a>
			<?=form_close();?>
		</div><!-- .widget-body -->
	</div><!-- .widget -->
</div>