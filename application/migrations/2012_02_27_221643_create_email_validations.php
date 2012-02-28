<?php

class Create_Email_Validations {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'email_validations', function( $table )
		{
			// Identifiers
			$table->increments( 'id' );

			// Data fields
			$table->integer( 'user_id' );
			$table->string( 'email', 120 )->unique();
			$table->string( 'code', 60 );

			// Stats
			$table->timestamps();
		} );
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop( 'email_validations' );
	}

}