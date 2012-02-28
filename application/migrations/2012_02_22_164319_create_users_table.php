<?php

class Create_Users_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'users', function( $table )
		{
			// Identifiers
			$table->increments( 'id' );

			// Data fields
			$table->string( 'email', 120 )->unique();
			$table->string( 'password', 40 );
			$table->string( 'first_name', 80 );
			$table->string( 'last_name', 120 );
			$table->string( 'name', 201 )->index(); // Holds first + last name
			$table->string( 'username', 30 );
			$table->date( 'birthday' );
			$table->string( 'gender', 6 );

			// Stats
			$table->timestamps();

			// Flags
			$table->boolean( 'is_valid_email' );
			$table->boolean( 'is_valid_account' );
			$table->boolean( 'is_facebook_account' );
		} );
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop( 'users' );
	}

}