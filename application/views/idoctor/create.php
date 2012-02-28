
<?php echo Form::open( '/idoctor/create', 'POST', array( 'class' => 'form-horizontal' ) ); ?>
<fieldset>
<legend>Add a Receipt</legend>
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
	<?php echo Form::label( 'phone_number', 'Phone #', array( 'class' => 'control-label' ) ); ?>
	<div class="controls">
		<?php echo Form::text( 'phone_number', Input::old( 'phone_number' ), array(
			'class' => 'span3',
			'placeholder' => '432-555-0123',
		) ); ?>
	</div>
</div>
<div class="control-group">
	<?php echo Form::label( 'problem', 'Problem', array( 'class' => 'control-label' ) ); ?>
	<div class="controls">
		<?php echo Form::textarea( 'problem', Input::old( 'problem' ), array(
			'class' => 'span6',
			'placeholder' => 'Enter a description of the problem.',
		) ); ?>
	</div>
</div>
<div class="control-group">
	<?php echo Form::label( 'repair', 'What I have done', array( 'class' => 'control-label' ) ); ?>
	<div class="controls">
		<?php echo Form::textarea( 'repair', Input::old( 'repair' ), array(
			'class' => 'span6',
			'placeholder' => 'Replaced glass screen.',
		) ); ?>
	</div>
</div>
<div class="control-group">
	<?php echo Form::label( 'is_resolved', 'Resolved?', array( 'class' => 'control-label' ) ); ?>
	<div class="controls">
		<?php
			echo Form::select(
				'is_resolved', array(
					'0' => 'No',
					'1' => 'Yes'
				), Input::old( 'is_resolved', 0 )
			);
		?>
	</div>
</div>
<div class="form-actions">
	<button type="submit" class="btn btn-primary">Add it</button>
</div>
</fieldset>
<?php echo Form::close(); ?>
