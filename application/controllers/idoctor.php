<?php
class Idoctor_Controller extends Base_Controller {
	public $restful = true;

	public function __construct() {
		//$this->filter( 'before', 'auth' );
	}

	public function get_index() {
		return View::make( 'idoctor' )
			->nest( 'header', 'private.header', array( 'title' => 'iDoctor' ) )
			->nest( 'navi', 'private.navi' )
			->nest( 'content', 'idoctor.create' )
			->nest( 'footer', 'private.footer' );
	}
	public function get_list() {
		return View::make( 'idoctor' )
			->nest( 'header', 'private.header', array( 'title' => 'iDoctor' ) )
			->nest( 'navi', 'private.navi' )
			->nest( 'content', 'idoctor.list' )
			->nest( 'footer', 'private.footer' );
	}
	public function get_search() {
		return View::make( 'idoctor' )
			->nest( 'header', 'private.header', array( 'title' => 'iDoctor' ) )
			->nest( 'navi', 'private.navi' )
			->nest( 'content', 'idoctor.search' )
			->nest( 'footer', 'private.footer' );
	}
	public function get_create() {
		return View::make( 'idoctor' )
			->nest( 'header', 'private.header', array( 'title' => 'iDoctor' ) )
			->nest( 'navi', 'private.navi' )
			->nest( 'content', 'idoctor.create' )
			->nest( 'footer', 'private.footer' );
	}
	/**
	 * Add a receipt to the database
	 *
	 * @return Redirect
	 */
	public function post_create() {
		$rules = array(
			'first_name'     => 'required|alpha|max:80',
			'last_name'      => 'required|alpha|max:120',
			'phone_number'   => 'required',
		);
		// Validate all input
		$validator = Validator::make( Input::all(), $rules );

		// Send them back with errors
		if( ! $validator->valid() )
			return Redirect::to( 'home' )
				->with( 'errors', $validator->errors )
				->with_input(); // Add errors to the view

		// Set and clean up some input
		$data = Input::all();

		$data['created_at'] = date( 'Y-m-d H:i:s' );

		$data['name'] = $data['first_name'] . ' ' . $data['last_name'];

		// Save the data
		DB::table( 'receipts' )->insert( $data );

		return Redirect::to_action( 'idoctor@list' );
	}
	/**
	 * Return a list of all results
	 *
	 * @return Redirect
	 */
	public function post_search() {
		echo json_encode( DB::table( 'receipts' )->get() );
	}
}
