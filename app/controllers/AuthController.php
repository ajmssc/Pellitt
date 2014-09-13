<?php

class AuthController extends BaseController {



	public function getIndex()
	{
		$fb = OAuth::consumer('Facebook');
		$fburl = $fb->getAuthorizationUri();
		echo '<a href="/auth/facebook">Facebook</a>';
		echo '<form method="POST" action="/auth/login">
				email <input type="text" name="username">
				password <input type="password" name="password">
				<input type="submit" value="Log in">
			</form>


			<a href="/auth/register">Register</a>
		<BR><BR>
			<a href="/auth/logout">Logout</a>
		<BR><BR>';

		if(Auth::check())
		{
		   var_dump(Auth::user());
		} else {
			echo 'user not logged in';
		}
	}

	public function postIndex()  {
		echo 'postindex';
	}




	public function getLogin() {
		return View::make('login.index');
	}
	public function postLogin() {
        Session::reflash(); //refresh flash var
        $user = array(
             'email' => Input::get('email'),
             'password' => Input::get('password'),
             'type' => 'email'
        );
        if (Auth::attempt($user)) {
        	echo 'logged in';
        	return Redirect::to('/')->with('flash_notice', 'You are successfully logged in.');
                // return Redirect::route(Session::get('next_page', 'home'))
                //     ;
        }
        // authentication failure! lets go back to the login page
        return Redirect::to('/auth/login')
            ->with('flash_error', 'User not found or invalid credentials.')
            ->withInput();
    }






    public function confirmEmail($confirmationlink){
        //$confirmationlink
        User::where('confirmationlink', '=', $confirmationlink)->update(array('confirmed' => 1));
        return View::make('register.emailconfirmed')->with('verifylink', $confirmationlink);
    }

    public function getRegister(){
        Session::reflash(); //refresh flash var
        return View::make('register.index');//->with('username', Session::get('username'))->with('email', Session::get('email'));
    }
    public function postRegister()
    {
		Session::reflash(); //refresh flash var
		$user = new User;
		$user->type = 'email';
		$user->email = strtolower(Input::get('email'));
		$user->password = Input::get('password');
		$user->password_confirmation = Input::get('password_confirmation');
		$user->confirmationlink = str_random();
		$user->confirmed = 0;

		if($user->save())
		{
			$profile = new Profile();
			$profile->save(); //create new profile
			$user->profile()->associate($profile);
			$user->forceSave();
			// $newuser = User::where('email', '=', $user->email)->first();
			// Mail::send('emails.auth.welcome', array('confirmationlink' => $user->confirmationlink), 
			// 	function($message)
			// 	{
			// 		$message->to(strtolower(Input::get('email')), Input::get('username'))->subject('Welcome!');
			// 	});
			Auth::login($user);
				return Redirect::to('/')//return Redirect::route(Session::get('next_page', 'profile')) //either redirect to the next_page or to profile
					->with('flash_notice', 'The new user has been created');
		}
		return Redirect::to('/auth/register')
			->withInput()
			->withErrors($user->errors());
	}
    // public function postRegister() {
    //     Session::reflash(); //refresh flash var
    //     $user = new User;
        
    //     $user->username = Input::get('username');
    //     $user->email = strtolower(Input::get('email'));
    //     $user->password = Input::get('password');
    //     $user->password_confirmation = Input::get('password_confirmation');
    //     $user->confirmationlink = str_random();
    //     $user->confirmed = 0;
    //     // $user->password = Hash::make(Input::get('password'));
    //     // $user->password_confirmation = Hash::make(Input::get('password_confirmation'));
    //     //error_log(print_r($user,true));
    //     if($user->save())
    //     {
    //         $newuser = User::where('email', '=', $user->email)->first();
            
    //         Mail::send('emails.auth.welcome', array('confirmationlink' => $user->confirmationlink), 
    //             function($message)
    //         {
    //             $message->to(strtolower(Input::get('email')), Input::get('username'))->subject('Welcome!');
    //         });
    //         Auth::login($newuser);
    //         return Redirect::to('/')//return Redirect::route(Session::get('next_page', 'profile')) //either redirect to the next_page or to profile
    //         ->with('flash_notice', 'The new user has been created');
    //     }
    //     return Redirect::to('/auth/register')
    //         ->withInput()
    //         ->withErrors($user->errors());
        
    // }












///////////////
    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/')->with('flash_notice', 'You are successfully logged out.');
    }




//////////////
	public function getFacebook(){
		// get data from input
		echo '<a href="/auth">Authentication menu</a><BR><BR><a href="/auth/facebook">Facebook</a>';

		if (Auth::Check()) { //user already logged in .. redirect to home with error
			return Redirect::to('/')->with('flash_notice', 'You are already logged in.');
		}	

		$code = Input::get( 'code' );
		// get fb service
		$fb = OAuth::consumer( 'Facebook' );
		// check if code is valid
		// if code is provided get user data and sign in
		if (empty($code)) {
			$url = $fb->getAuthorizationUri();
			 return Redirect::to( (string)$url );
		}
		// If not, this was a callback request from facebook, get the token
		try {
			$token = $fb->requestAccessToken( $code );
			$result = json_decode( $fb->request( '/me' ), true );
			//$message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
			//echo $message. "<br/>";
			if (!$result['verified']) return Redirect::to('/')->with('flash_notice', 'Please verify your Facebook account first.');
			if (empty($result['email'])) return Redirect::to('/')->with('flash_notice', 'Please register your email with Facebook first.');
			$find_fbuser = User::where('fbid',$result['id'])->first();
			if ($find_fbuser && Auth::loginUsingId($find_fbuser->id)) return Redirect::to('/')->with('flash_notice', 'User authenticated via Facebook');
			
			//register new user
			//test if already exists
			$find_user_by_email = User::byEmail()->where('email',$result['email'])->first();
			if ($find_user_by_email) return Redirect::to('/')->with('flash_error', 'Email already registered. Log in and go to your profile page to link your Facebook account.');

			//register new user
			$user = new User;
			$user->email = $result['email'];
			$user->type = 'facebook';
			$user->fbid = $result['id'];
			$randomPassword = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+{}[];':"), 0, 60);
			$user->password = $randomPassword;
			$user->confirmed = true;
			$profile = new Profile();
			$profile->username = $result['username'];
			$profile->save();
			$user->profile()->associate($profile);
			$user->forceSave();
			Auth::loginUsingId($user->id);
			return Redirect::to('/')->with('flash_notice', 'Facebook User created');
			// $user->username = $result['username'];
			// $user->fbname = substr($result['first_name'] . ' ' . $result['last_name'], 0, 255);
			// $user->fbuid = $result['id'];			
		}
		catch (Exception $e) {
			//echo 'Caught exception: ',  $e->getMessage(), "\n";
			return Redirect::to('/')->with('flash_error', $e->getMessage());
		}
	}


	public function postProfile()
	{
		
	}

	// public function anyLogin()
	// {
		
	// }

}