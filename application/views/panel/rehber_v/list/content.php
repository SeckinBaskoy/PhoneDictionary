<div class="col-md-12">
	<div class="widget">
		<header class="widget-header">
			<h4 class="widget-title">Phone Directory Listing
			<?php if(isAllowedWriteModule()){?>
			<a href="<?=base_url("rehber/new_form");?>" class="btn pull-right btn-xs btn-primary btn-outline"><i class="fa fa-plus"></i> Add New</a>
			<?php }?>
			</h4>
		</header>
		<hr class="widget-separator">
		<div class="widget-body">
			<div class="table-responsive">
				<?php if(empty($items)) { ?>
				<div class="alert alert-info text-center">
								<p>No record found. <a href="<?=base_url("rehber/new_form");?>">Click here</a> to add new record.</p>
							</div>
				<?php } else { ?>
				<table id="default-datatable" data-plugin="DataTable" class="table table-hover" cellspacing="0">
					<thead>
						<tr>
							<th class="col-xs-1 col-sm-1 col-md-1 col-lg-1"><i class="fa fa-reorder"></i></th> 
							<th class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Unit</th>
							<th class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Position / Location</th>
							<th class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Title / Full Name</th>
							<th class="col-xs-1 col-sm-1 col-md-1 col-lg-1">Phone</th>
							<th class="col-xs-1 col-sm-1 col-md-1 col-lg-1">State</th>
							<th class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($items as $item) { ?>
						<tr>
							<td><?=$item->id;?></td>
							<td><?=($item->birimi) ? $item->birimi:'';?></td>
              				<td><?=$item->gorevi;?></td>
              				<td><?=($item->unvani) ?  $item->unvani:'';?> <?=($item->adi_soyadi) ? $item->adi_soyadi:'';?></td>
              				<td><?=$item->telefon;?></td>
							<td>
								<input 
									data-url="<?=base_url("rehber/isActiveSetter/").$item->id;?>"
									class="isActive form-control"
									type="checkbox" 
									data-color="#10c469"
									<?php echo ($item->isActive) ? "checked" :"";?>
									>
							</td>
							<td>
								<?php if(isAllowedDeleteModule()){?>
								<a href="#"	data-url="<?=base_url('rehber/delete/').$item->id;?>" class="btn btn-sm btn-danger  remove-btn" title="Delete"><i class="fa fa-trash"></i> </a>
								<?php } ?>
								<?php if(isAllowedUpdateModule()){?>
								<a href="<?=base_url('rehber/update_form/').$item->id;?>" class="btn btn-sm btn-info " title="Edit"><i class="fa fa-pencil-square-o"></i> </a>
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
</div>
