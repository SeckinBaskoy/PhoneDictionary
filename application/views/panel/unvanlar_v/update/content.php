<!-- DOM dataTable -->
<div class="col-md-12">
	<div class="widget">
		<header class="widget-header">
			<h4 class="widget-title">Editing Title Definition of <?php echo ($items->unvan_adi) ? $items->unvan_adi:"";?></h4>
		</header><!-- .widget-header -->
		<hr class="widget-separator">
		<div class="widget-body">
			<?=form_open("unvanlar/update/".$items->id);?>
				<div class="form-group">
					<label for="unvan_adi">Title</label>
					<input type="text" class="form-control" id="unvan_adi" name="unvan_adi" placeholder="title" value="<?=$items->unvan_adi;?>">
					<?php 
					/* HATA KONTROLÜ */
					if (isset($form_error)) { ?>
						<small class="input-form-error pull-right"><?php echo form_error("unvan_adi");?></small>
					<?php } ?>
				</div>
				<button type="submit" class="btn btn-primary btn-md btn-outline">Save</button>
				<a href="<?=base_url("unvanlar");?>" class="btn btn-danger btn-md btn-outline">Cancel</a>
			<?=form_close();?>
		</div><!-- .widget-body -->
	</div><!-- .widget -->
</div>