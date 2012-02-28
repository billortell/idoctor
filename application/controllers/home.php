<?php
class Home_Controller extends Base_Controller {
	public $restful = true;

	public function __construct() {
		$this->filter( 'before', 'guest' );
	}

	public function get_index() {
		return View::make( 'home' )
			->nest( 'header', 'public.header', array( 'title' => 'Home' ) )
			->nest( 'navi', 'public.navi' )
			->nest( 'register', 'partials.register' )
			->nest( 'fbauth', 'partials.fb' )
			->nest( 'footer', 'public.footer' );
	}
}
