<?php 
$permissions=json_decode($items->permissions);
?>
<!-- DOM dataTable -->
<div class="col-md-12">
	<div class="widget">
		<header class="widget-header">
			<h4 class="widget-title">Editing previliges for <b><?=$items->title;?> (<?=$items->title;?>)</b> user role</h4>
		</header><!-- .widget-header -->
		<hr class="widget-separator">
		<div class="widget-body">
			<?=form_open("user_role/update_permissions/$items->id");?>
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<th>Modul Name</th>
						<th>View</th>
						<th>Add</th>
						<th>Edit</th>
						<th>Delete</th>
					</thead>
					<tbody>
					<?php foreach (getControllerList() as $controllerName) { ?>
					
						<tr>
							<td><?=$controllerName;?></td>
							<td class="w100 text-center">
								<input 
								<?php echo (isset($permissions->$controllerName) && isset($permissions->$controllerName->read)) ? "checked":"";?>
								name="permissions[<?=$controllerName;?>][read]" type="checkbox" data-switchery data-color="#10c469">
							</td>
							<td class="w100 text-center">
								<input 
								<?php echo (isset($permissions->$controllerName) && isset($permissions->$controllerName->write)) ? "checked":"";?>
								name="permissions[<?=$controllerName;?>][write]" type="checkbox" data-switchery data-color="#10c469">
							</td>
							<td class="w100 text-center">
								<input 
								<?php echo (isset($permissions->$controllerName) && isset($permissions->$controllerName->update)) ? "checked":"";?>
								name="permissions[<?=$controllerName;?>][update]" type="checkbox" data-switchery data-color="#10c469">
							</td>
							<td class="w100 text-center">
								<input 
								<?php echo (isset($permissions->$controllerName) && isset($permissions->$controllerName->delete)) ? "checked":"";?>
								name="permissions[<?=$controllerName;?>][delete]" type="checkbox" data-switchery data-color="#10c469">
							</td>
						</tr>
					
					<?php }	 ?>
					</tbody>
				</table>	
				<hr>

				<button type="submit" class="btn btn-primary btn-md btn-outline">Save</button>
				<a href="<?=base_url("user_role");?>" class="btn btn-danger btn-md btn-outline">Cancel</a>
			<?=form_close();?>
		</div><!-- .widget-body -->
	</div><!-- .widget -->
</div>