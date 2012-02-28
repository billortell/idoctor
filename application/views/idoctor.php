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
              <li class="active"><a href="#">Home</a></li>
              <li><a href="<?php echo URL::to_action( 'idoctor@create' ); ?>">Create Receipt</a></li>
              <li><a href="<?php echo URL::to_action( 'idoctor@list' ); ?>">List Receipts</a></li>
              <li><a href="<?php echo URL::to_action( 'idoctor@search' ); ?>">Search Receipts</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <?php echo $content; ?>
        </div><!--/span-->
      </div><!--/row-->
<?php echo $footer; ?>