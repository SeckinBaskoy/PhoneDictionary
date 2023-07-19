<!-- DOM dataTable -->
<div class="col-md-12">
	<div class="widget">
		<header class="widget-header">
			<h4 class="widget-title">Add New Unit Identification</h4>
		</header><!-- .widget-header -->
		<hr class="widget-separator">
		<div class="widget-body">
			<?=form_open("birimler/save");?>
				<div class="form-group">
					<label for="birim_adi">Unit Name</label>
					<input type="text" class="form-control" id="birim_adi" name="birim_adi" placeholder="Enter Unit Name Please">
					

					<?php 
					
					/* HATA KONTROLÜ */

					if (isset($form_error)) { ?>
						<small class="input-form-error pull-right"><?php echo form_error("birim_adi");?></small>
					<?php } ?>


				</div>
				<button type="submit" class="btn btn-primary btn-md btn-outline">Save</button>
				<a href="<?=base_url("birimler");?>" class="btn btn-danger btn-md btn-outline">Cancel</a>
			<?=form_close();?>
		</div><!-- .widget-body -->
	</div><!-- .widget -->
</div>