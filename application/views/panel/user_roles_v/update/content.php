<!-- DOM dataTable -->
<div class="col-md-12">
	<div class="widget">
		<header class="widget-header">
			<h4 class="widget-title">Editing User Role of <?php echo ($items->title) ? $items->title:"";?> </h4>
		</header><!-- .widget-header -->
		<hr class="widget-separator">
		<div class="widget-body">
			<?=form_open("user_role/update/".$items->id);?>
				<div class="form-group">
					<label for="title">User Role</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="User Role" value="<?=$items->title;?>">
					<?php 
					/* HATA KONTROLÜ */
					if (isset($form_error)) { ?>
						<small class="input-form-error pull-right"><?php echo form_error("title");?></small>
					<?php } ?>
				</div>
				<button type="submit" class="btn btn-primary btn-md btn-outline">Save</button>
				<a href="<?=base_url("user_role");?>" class="btn btn-danger btn-md btn-outline">Cancel</a>
			<?=form_close();?>
		</div><!-- .widget-body -->
	</div><!-- .widget -->
</div>