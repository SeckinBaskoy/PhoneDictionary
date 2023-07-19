<div id="back-to-home">
	<a href="<?=base_url("");?>" class="btn btn-outline btn-default" title="Main" alt="Main"><i class="fa fa-home animated zoomIn"></i></a>
</div>

<div class="simple-page-wrap">
	<div class="simple-page-logo animated swing">
	<a href="<?=base_url("");?>" alt="SB Tasarım | Phone Directory Web Application" title="SB Tasarım | Phone Directory Web Application">
		<span>SB Tasarım | Phone Directory Web Application</span>
	</a>
	</div><!-- logo -->
	<div class="simple-page-form animated flipInY" id="login-form">
		<h4 class="form-title m-b-xl text-center">Please enter you login information to below form</h4>
		<?=form_open("userop/do_login");?>
			<div class="form-group">
				<input id="sign-in-user_name" type="text" class="form-control" placeholder="Username" name="sign-in-user_name">
				<?php if(isset($form_error)) { ?>
				<small class="pull-right input-form-error"><?php echo form_error("sign-in-user_name");?></small>
				<?php } ?>
			</div>

			<div class="form-group">
				<input id="sign-in-password" type="password" class="form-control" placeholder="Password" name="sign-in-password">
				<?php if(isset($form_error)) { ?>
				<small class="pull-right input-form-error"><?php echo form_error("sign-in-password");?></small>
				<?php } ?>
			</div>

			<input type="submit" class="btn btn-primary" value="LOGIN">
		<?=form_close();?>
	</div><!-- #login-form -->
	<div class="simple-page-footer">
		<p><a href="<?=base_url('parolami-unuttum');?>">Do you forget your password?</a></p>
	</div><!-- .simple-page-footer -->
</div><!-- .simple-page-wrap -->