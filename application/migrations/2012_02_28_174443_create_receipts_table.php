<?php

class Create_Receipts_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create( 'receipts', function( $table )
		{
			// Identifiers
			$table->increments( 'id' );

			// Data fields
			$table->string( 'first_name', 80 );
			$table->string( 'last_name', 120 );
			$table->string( 'name', 201 )->index(); // Holds first + last name
			$table->string( 'phone_number', 20 );
			$table->text( 'problem' );
			$table->text( 'repair' );

			// Stats
			$table->timestamps();

			// Flags
			$table->boolean( 'is_resolved' );
		} );
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop( 'receipts' );
	}

}