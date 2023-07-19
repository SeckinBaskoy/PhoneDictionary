<!-- DOM dataTable -->
<div class="col-md-12">
	<div class="widget">
		<header class="widget-header">
			<h4 class="widget-title">Listing Title Definitions 
				<?php if(isAllowedWriteModule()){?>
				<a href="<?=base_url("unvanlar/new_form");?>" class="btn pull-right btn-xs btn-primary btn-outline"><i class="fa fa-plus"></i> Add New</a>
				<?php } ?>
			</h4>
		</header>
		<hr class="widget-separator">
		<div class="widget-body">
			<div class="table-responsive">
				<?php if(empty($items)) { ?>
				<div class="alert alert-info text-center">
								<p>There is no record found. Please <a href="<?=base_url("unvanlar/new_form");?>">click here</a> for adding new record.</p>
							</div>
				<?php } else { ?>
				<table id="default-datatable" data-plugin="DataTable" class="table table-hover" cellspacing="0"><?php // data-plugin="DataTable" ?>
					<thead>
						<tr>
							<th class="col-xs-1 col-sm-1 col-md-1 col-lg-1">#id</th>
							<th class="col-xs-6 col-sm-6 col-md-6 col-lg-6">Title</th>
							<th class="col-xs-1 col-sm-1 col-md-1 col-lg-1">State</th>
							<th class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($items as $item) { ?>
						<tr>
							<td><?=$item->id;?></td> <?php //$item->id;?>
							<td><?=$item->unvan_adi;?></td>
							<td>
								<input 
									data-url="<?=base_url("unvanlar/isActiveSetter/").$item->id;?>"
									class="isActive form-control" type="checkbox" data-color="#10c469"
									<?php echo ($item->isActive) ? "checked" : "";?>
									>
							</td>
							<td>
							<?php if(isAllowedDeleteModule()){?>
								<a href="#"	data-url="<?=base_url('unvanlar/delete/').$item->id;?>"	class="btn btn-sm btn-danger btn-outline remove-btn"><i class="fa fa-trash"></i> Delete</a>
							<?php } ?>
							<?php if(isAllowedUpdateModule()){?>
								<a href="<?=base_url('unvanlar/update_form/').$item->id;?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-pencil-square-o"></i> Edit</a>
							<?php } ?>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			<?php } ?>
			</div>
		</div><!-- .widget-body -->
	</div><!-- .widget -->
</div><!-- END column -->