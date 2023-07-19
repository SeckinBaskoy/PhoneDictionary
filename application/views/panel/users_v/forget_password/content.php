<div id="back-to-home">
	<a href="<?=base_url("");?>" class="btn btn-outline btn-default" title="Main Site" alt="Main Site"><i class="fa fa-home animated zoomIn"></i></a>
</div>

<div class="simple-page-wrap">
	<div class="simple-page-logo animated swing">
	<a href="<?=base_url("");?>" alt="SB Tasarım | Phone Directory Web Application" title="SB Tasarım | Phone Directory Web Application">
		<span>SB Tasarım | Phone Directory Web Application</span>
	</a>
	</div>

	<div class="simple-page-form animated flipInY" id="reset-password-form">
	<h4 class="form-title m-b-xl text-center">Do you forget password?</h4>

	<?=form_open("reset-password");?>
		<div class="form-group">
			<input id="reset-password-email" name="reset-password-email" type="email" class="form-control" placeholder="e-mail"
			value="<?php echo isset($form_error) ? set_value("reset-password-email"):"";?>">
			<?php if(isset($form_error)) { ?>
				<small class="pull-right input-form-error"><?php echo form_error("reset-password-email");?></small>
			<?php } ?>
		</div>
		<input type="submit" class="btn btn-primary" value="Send me a new Password">
	<?=form_close();?>
	</div><!-- #reset-password-form -->
	<div class="simple-page-footer">
		<p><a href="<?=base_url('login');?>">Login</a></p>
	</div><!-- .simple-page-footer -->
</div><!-- .simple-page-wrap -->