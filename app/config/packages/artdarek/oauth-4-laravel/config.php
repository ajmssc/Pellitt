<?php 

return array( 
	//https://github.com/artdarek/oauth-4-laravel
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
        'Facebook' => array(
            'client_id'     => '147855328695305',
            'client_secret' => '3b3fb695fa67158f8e38f488de703399',
            'scope'         => array('email','read_friendlists','user_online_presence'),
        ),		

	)

);