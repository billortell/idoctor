<?php echo $header; ?>
  <body>
<?php echo $navi; ?>

	<?php if( !empty( $errors->messages ) ): ?>
	<div class="alert alert-block alert-error fade in">
		<?php HTML::link( '#', '&times;', array(
			'class' => 'close',
			'data-dismiss' => 'alert',
		) ); ?>
		<h4 class="alert-heading">There seems to be a problem...</h4>
		<?php foreach( $errors->messages as $field => $message ) { ?>
		<p><?php echo $message[0]; ?></p>
		<?php } ?>
	</div>
	<?php endif; ?>
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Navigation</li>
              <li>Please login to access the menu.</li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="hero-unit">
            <h1>iDoctor</h1>
            <p>
            	This app serves to allow the entry and modification of iDoctor receipts.
           	</p>
          </div>
          <div class="row-fluid">
            <div class="span10">
              <?php echo $fbauth; ?>
              <?php echo $register; ?>
              <?php echo $login; ?>
            </div><!--/span-->
          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->
<?php echo $footer; ?>