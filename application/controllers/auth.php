<?php
class Auth_Controller extends Base_Controller {
	public $restful = true;

	public function __construct() {
		$this->filter( 'before', 'guest' )->except( array( 'logout', 'validate' ) );

		// Note: We may not always require CSRF on login for system based logins so ignore it here.
		$this->filter( 'before', 'csrf' )->on( 'post' )->except( array( 'login' ) );
	}
	/**
	 * No direct access needed
	 *
	 * @return NULL
	 */
	public function get_index() {
		return Redirect::to( 'home' );
	}
	/**
	 * No direct access needed
	 *
	 * @return NULL
	 */
	public function get_login() {
		return View::make( 'home' )
			->nest( 'header', 'public.header', array( 'title' => 'Login' ) )
			->nest( 'navi', 'public.navi' )
			->nest( 'register', 'partials.login' )
			->nest( 'footer', 'public.footer' );
	}
	/**
	 * Verify login information and authenticate the client
	 *
	 * @param array
	 * @return Redirect
	 */
	public function post_login( $data = NULL ) {
		if( !empty( $data ) ) // Directly set the data so we can use it as normal
			Input::$input = $data;
		else // If this is a non-system call require CSRF
			$this->filter( 'before', 'csrf' );

		$rules = array(
			'email' 		=> 'required|email',
			'password'		=> 'required|min:6',
		);
		// Validate all input
		$validator = Validator::make( Input::all(), $rules );

		// Send them back with errors
		if( ! $validator->valid() )
			return Redirect::to( 'home' )->with( 'errors', $validator->errors ); // Add errors to the view

		// Attempt to authenticate
		if( Auth::attempt( Input::get( 'email' ), Input::get( 'password' ) ) )
		{
			// Trigger log in event.
			if( Bundle::exists( 'activity' ) )
				Activity::trigger( 1, 'logged in', Auth::user()->id );

			// Send them to the auth view
			return Redirect::to_action( 'idoctor@index' );
		}
		else
			return Redirect::to( 'home' )->with( 'errors', array( 'messages' => array( 'username' => 'The username or password did not match.' ) ) );
	}
	/**
	 * Handle logout requests by cleaning up the session
	 *
	 * @return Redirect
	 */
	public function get_logout() {
		// Trigger log out event
		if( Bundle::exists( 'activity' ) )
			Activity::trigger( 1, 'logged out', Auth::user()->id );

		// Destory the session
		Auth::logout();

		// Send them home
		return Redirect::to( 'home' );
	}
	/**
	 * Handle redirect from FB and save the users profile data.
	 *
	 * @return Redirect
	 */
	public function get_fb() {
		// Re-build object
		$facebook = new Facebook\SDK( array(
			'appId'  => Config::get( 'facebook.app_id' ),
			'secret' => Config::get( 'facebook.secret' ),
			'cookie' => true
		) );

		// Auth request params
		$params = array(
			'scope' => Config::get( 'facebook.scope' ),
			'redirect_uri' => Config::get( 'facebook.redirect_uri' ),
		);

		// Build the FB user
		$user = $facebook->getUser();
		if( $user ) // Request FB profile data
			$fb_user = $facebook->api( '/me' );

		// Something went wrong
		if( ! $fb_user )
			return Redirect::to( 'home' )->with( 'errors', 'Unable to connect with Facebook.' );

		// Clone and adjust
		$lk_user = $fb_user;
		$lk_user['password'] = Crypter::decrypt( Session::get( 'password' ) ); // Pull in password
		$lk_user['password_confirmation'] = $lk_user['password']; // Pass validation
		$lk_user['is_facebook_account'] = true; // Flag from_facebook

		// Remove the session password
		Session::forget( 'password' );

		// Register the user, do not require email validation
		$this->post_register( $lk_user, false );

		return Redirect::to( 'home' );
	}
	/**
	 * Choose a password to use with FB profile data.
	 * POST will have the users password in it and redirect to FB for auth request.
	 *
	 * @return Redirect
	 */
	public function post_fb() {
		// Give a form to set a password
		$rules = array(
			'password' => 'required|confirmed|min:6',
		);
		// Validate all input
		$validator = Validator::make( Input::all(), $rules );

		// Send them back with errors
		if( ! $validator->valid() )
			return Redirect::to( 'home' )->with( 'errors', $validator->errors ); // Add errors to the view

		// Store the password temporary in our session, use some encryption in case non-SSL
		Session::put( 'password', Crypter::encrypt( Input::get( 'password' ) ) );

		// Re-build object
		$facebook = new Facebook\SDK( array(
			'appId'  => Config::get( 'facebook.app_id' ),
			'secret' => Config::get( 'facebook.secret' ),
			'cookie' => true
		) );

		// Auth request params
		$params = array(
			'scope' => Config::get( 'facebook.scope' ),
			'redirect_uri' => Config::get( 'facebook.redirect_uri' ),
		);
		return Redirect::to( $facebook->getLoginUrl( $params ) );
	}
	/**
	 * Validate registration data for our system
	 *
	 * @param array
	 * @param boolean
	 * @return Redirect with array
	 */
	public function post_register( $data = NULL, $email_confirm = false ) {
		if( !empty( $data ) )
			Input::$input = $data; 

		$rules = array(
			'first_name'     => 'required|alpha|max:80',
			'last_name'      => 'required|alpha|max:120',
			'gender'         => 'required',
			'email'			 => 'required|email|unique:users',
			'password'       => 'required|confirmed|min:6',
		);
		// Validate all input
		$validator = Validator::make( Input::all(), $rules );

		// Send them back with errors
		if( ! $validator->valid() )
			return Redirect::to( 'home' )
				->with( 'errors', $validator->errors )
				->with_input( 'except', array( 'password', 'password_confirm' ) ); // Add errors to the view

		// Set and clean up some input
		$user_data = Input::all();

		$user_data['name'] = $user_data['first_name'] . ' ' . $user_data['last_name'];
		$user_data['password'] = Hash::make( Input::get( 'password' ) );
		$user_data['is_valid_email'] = false;

		unset( $user_data['csrf_token'] );
		unset( $user_data['password_confirmation'] );

		// Save the data
		$user_id = DB::table( 'users' )->insert_get_id( $user_data );

		// Handle email confirmation
		if( ! $mail_confirm )
		{
			$code = Str::random( array_get( $arguments, 0, 32 ) );

			// Generate an email validation key
			DB::table( 'email_validations' )
				->insert( array(
					'email' => $user_data['email'], 
					'user_id' => $user_id, 
					'code' => $code,
				)
			);
		}
		else
		{
			// Flag as valid
			DB::table( 'users' )->where( 'id', '=', $user_id )->update( array( 'is_valid_email' => true ) );

			// Remove entries from the validation table
			DB::table( 'email_validations' )->where( 'user_id', '=', $user_id )->delete();
		}

		// Try to authenticate by passing the data to the login object.
		$this->post_login( Input::all() );
		
		return Redirect::to( 'home' );
	}
	/**
	 * Validate email
	 *
	 * @return redirect
	 */
	public function get_validate( $user_id, $key ) {
		$code = DB::table( 'email_validations' )->where( 'user_id', '=', $user_id )->only( 'code' );

		if( $code === html_entity_decode( $key ) )
		{
			// Flag as valid
			DB::table( 'users' )->where( 'id', '=', $user_id )->update( array( 'is_valid_email' => true ) );

			// Remove entries from the validation table
			DB::table( 'email_validations' )->where( 'user_id', '=', $user_id )->delete();
		}
		else
			return Redirect::to( 'home' );

		// Notify the user it worked
		Session::flash( 'notice', 'Your E-mail address has been confirmed.' );

		return Redirect::to( 'home' );
	}
}
