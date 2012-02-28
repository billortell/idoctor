			<?php echo Form::open( '/auth/register', 'POST', array( 'class' => 'form-horizontal', 'autocomplete' => 'off' ) ); ?>
			<fieldset>
			<legend>Register with iDoctor or Sign in with Facebook</legend>
			<div class="control-group">
				<?php echo Form::label( 'full_name', 'Name', array( 'class' => 'control-label' ) ); ?>
				<div class="controls">
					<?php echo Form::text( 'first_name', Input::old( 'first_name' ), array(
						'class' => 'span3',
						'placeholder' => 'John',
					) ); ?>

					<?php echo Form::text( 'last_name', Input::old( 'last_name' ), array(
						'class' => 'span3',
						'placeholder' => 'Doe',
					) ); ?>
				</div>
			</div>

			<div class="control-group">
				<?php echo Form::label( 'email', 'E-Mail Address', array( 'class' => 'control-label' ) ); ?>
				<div class="controls">
					<?php echo Form::text( 'email', Input::old( 'email' ), array(
						'class' => 'span8',
						'placeholder' => 'johndoe@lockeryak.com',
					) ); ?>
				</div>
			</div>

			<div class="control-group">
				<?php echo Form::label( 'password', 'Password', array( 'class' => 'control-label' ) ); ?>
				<div class="controls">
					<?php echo Form::password( 'password', array(
						'class' => 'span3',
						'placeholder' => 'Secret',
					) ); ?>
					<?php echo Form::password( 'password_confirmation', array(
						'class' => 'span3',
						'placeholder' => 'Confirm',
					) ); ?>
				</div>
			</div>
			<div class="control-group">
				<?php echo Form::label( 'gender', 'Gender', array( 'class' => 'control-label' ) ); ?>
				<div class="controls">
					<?php
						echo Form::select(
							'gender', array(
								'Male' => 'Male',
								'Female' => 'Female'
							), Input::old( 'birthday', 'Male' )
						);
					?>
				</div>
			</div>

			<div class="form-actions">
				<?php echo Form::token(); ?>
				<button type="submit" class="btn btn-primary">Sign Up</button>
				<a class="btn" data-toggle="modal" href="#fbreg">Connect with Facebook</a>
			</div>
			</fieldset>
			<?php echo Form::close(); ?>
			<script>
			/* Update datepicker plugin so that MM/DD/YYYY format is used. */
			$.extend($.fn.datepicker.defaults, {
				parse: function (string) {
					var matches;
					if ((matches = string.match(/^(\d{2,2})\/(\d{2,2})\/(\d{4,4})$/))) {
						return new Date(matches[3], matches[1] - 1, matches[2]);
					} else {
						return null;
					}
				},
				format: function (date) {
					var
					month = (date.getMonth() + 1).toString(),
					dom = date.getDate().toString();
					if (month.length === 1) {
						month = "0" + month;
					}
					if (dom.length === 1) {
						dom = "0" + dom;
					}
					return month + "/" + dom + "/" + date.getFullYear();
				}
			});  
			</script>