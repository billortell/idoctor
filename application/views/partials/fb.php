			<?php echo Form::open( '/auth/fb', 'POST', array( 'class' => 'form-inline', 'autocomplete' => 'off' ) ); ?>
			<div id="fbreg" class="modal hide fade">
				<div class="modal-header">
					<a class="close" data-dismiss="modal">×</a>
					<h3>Please Choose a unique password for LockerYak</h3>
				</div>
				<div class="modal-body">
					<fieldset>
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
					</fieldset>
				</div>
				<div class="modal-footer">
					<?php echo Form::token(); ?>
					<button type="submit" class="btn btn-primary">Connect</button>
				</div>
			</div>
			<?php echo Form::close(); ?>
