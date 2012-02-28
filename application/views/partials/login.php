<?php echo Form::open( '/auth/login', 'POST', array( 'class' => 'form-horizontal' ) ); ?>
<fieldset>
<legend>Login</legend>
<div class="control-group">
	<?php echo Form::label( 'email_address', 'E-mail', array( 'class' => 'control-label' ) ); ?>
	<div class="controls">
		<?php echo Form::text( 'email', Input::old( 'email' ), array(
			'class' => 'span3',
			'placeholder' => 'user@example.com',
		) ); ?>
	</div>
</div>
<div class="control-group">
	<?php echo Form::label( 'password', 'Password', array( 'class' => 'control-label' ) ); ?>
	<div class="controls">
		<?php echo Form::password( 'password', array(
			'class' => 'span3',
			'placeholder' => 'secret',
		) ); ?>
	</div>
</div>
<div class="form-actions">
	<?php echo Form::token(); ?>
	<button type="submit" class="btn btn-primary">Login</button>
</div>
</fieldset>
<?php echo Form::close(); ?>