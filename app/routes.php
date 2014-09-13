<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//http://laravel.com/api/class-Illuminate.Database.Eloquent.Relations.BelongsToMany.html


Route::controller('auth', 'AuthController');

Route::controller('users', 'UsersController');
Route::get('profile', 'UsersController@getProfile');

//Route::get('games/{any}', 'GameController@gameDetail');
Route::controller('games', 'GameController');



Route::get('test', function()
{
	//var_dump(User::byEmail()->where('email','jeanmarc.soumet@gmail.com')->where('confirmationlink','3XuoNMoOB3aEna9h')->first());
	// foreach (User::byEmail()->get() as $user) {
	// 	echo($user->email);
	// }
	// if (Auth::Check()) {
	// 	echo(Auth::user()->profile->avatar);
	// }	
});





Route::get('/', function()
{
	return View::make('index');
});






Route::get('message', function()
{
	$user1=User::find(1);
	echo $user1->username . '<BR><BR>';

	$recipient=User::find(4);
	echo $recipient->username . '<BR><BR>';

	$user1->send_message($recipient, "af ew aawefwwwy");
});

















Route::get('get_friends', function()
{
	//var_dump(User::find(1)->get_friends());
	foreach(User::find(1)->get_friends() as $friend) {
		var_dump($friend->email);
	}
});


Route::get('seed_friends', function()
{

	// echo "Welcome" .PHP_EOL;
	$user = User::find(1);
	$user2 = User::find(2);
	$user3 = User::find(3);
	$user4 = User::find(4);
	//$user->friends()->save($user2);
	$user->set_friend($user2);
	$user2->set_friend($user3);
	$user2->set_friend($user4);

	//return View::make('index');
});

Route::get('seed_user', function()
{
	for($i=0;$i<100;$i++) {
		$user = new User;
		$user->username = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 15);
		$user->email = $user->username . '@gmail.com';
		$user->password = 'abcdjm123456';
		$user->password_confirmation = 'abcdjm123456';
		echo $user->email . '<BR>';
		$user->save();
	}
	// echo "Welcome" .PHP_EOL;
	// $user = new User;
	// $user->username = 'ajmssc';
	// $user->email = 'jsz@noos.fr';
	// $user->password = 'jszmasta';
	// $user->password_confirmation = 'jszmasta';
	// var_dump($user->save()); // returns false
	// $user2 = new User;
	// $user2->username = 'jeresun';
	// $user2->email = 'jeresun@hotmail.com';
	// $user2->password = 'jeresunzz';
	// $user2->password_confirmation = 'jeresunzz';
	// var_dump($user2->save()); // returns false
	// $user = new User;
	// $user->username = 'ajmsscewafewafw';
	// $user->email = 'jsfeafeewz@noos.fr';
	// $user->password = 'jszemastaff';
	// $user->password_confirmation = 'jszemastaff';
	// $user->save();

	
	// $post = new Post(array('body' => 'Yada yada yada'));
	// $user = User::find(1);
	// $user->posts()->save($post);

	//return View::make('index');
});

Route::get('seed', function()
{
	$xbox = new Platform;
	$xbox->name = 'Xbox';
	$xbox->save();
	$ps3 = new Platform;
	$ps3->name = 'PS3';
	$ps3->save();

	// $xbox = Platform::where('name', '=', 'Xbox')->firstOrFail();
	// $ps3 = Platform::where('name', '=', 'PS3')->firstOrFail();
	$game = new Game;
	$game->name = 'Halo';
	var_dump($game->save());
	$game->platforms()->saveMany(array($xbox, $ps3));
	
	$game = new Game;
	$game->name = 'Test';
	var_dump($game->save());
	$game->platforms()->saveMany(array($xbox, $ps3));
	
	$game = new Game;
	$game->name = 'TitanFall';
	var_dump($game->save());
	$game->platforms()->saveMany(array($xbox, $ps3));
	//return View::make('index');
	//return View::make('index');
});

Route::get('platforms', function()
{
	$xbox = Platform::where('name', '=', 'Xbox')->firstOrFail();
	foreach($xbox->games()->get() as $game) {
		echo($game->name . '<BR>');
	}



	// echo "Welcome" .PHP_EOL;
	// $user = new User;
	// $user->username = 'ajmssc';
	// $user->email = 'jsz@noos.fr';
	// $user->password = 'jszmasta';
	// $user->password_confirmation = 'jszmasta';
	// var_dump($user->save()); // returns false
	
	// // Create a new Post
	// $post = new Post(array('body' => 'Yada yada yada'));
	// // Grab User 1
	// $user = User::find(1);
	// // Save the Post
	// $user->posts()->save($post);

	return View::make('index');
});
