<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
//php artisan generate:migration create_posts_table --fields="body:text, user_id:integer"
class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		// Schema::create('users', function(Blueprint $table)
		// {
		// 	$table->bigIncrements('id')->unsigned();
		// 	// $table->string('password', 64);
		// 	$table->string('email', 64)->unique();
		// 	$table->string('username');

		// 	$table->rememberToken();

		// 	$table->string('fbphoto');
		// 	$table->string('fbname');
		// 	$table->biginteger('fbuid')->unsigned();
		// 	$table->string('fbaccess_token');
		// 	$table->string('fbaccess_token_secret');
		// 	$table->timestamps();
		// });
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigIncrements('id')->unsigned();
			$table->bigInteger('profile_id')->unsigned();

			$table->rememberToken();

			$table->string('confirmationlink', 30);
			$table->boolean('confirmed');


			$table->string('type');
			$table->string('email');
			$table->bigInteger('fbid')->unsigned();
			$table->string('password');
			$table->timestamps();
		});


		Schema::create('profiles', function(Blueprint $table)
		{
			$table->bigIncrements('id')->unsigned();
			$table->string('username');


			$table->string('avatar');

			$table->string('facebook_username');
			// $table->string('fbname');
			// $table->biginteger('fbuid')->unsigned();
			// $table->string('fbaccess_token');
			// $table->string('fbaccess_token_secret');
			// $table->string('confirmationlink', 30);
			// $table->boolean('confirmed');
			$table->timestamps();
		});





		Schema::create('user_friends', function(Blueprint $table)
		{
			$table->bigIncrements('id')->unsigned();
			$table->bigInteger('user_id')->unsigned();
			$table->bigInteger('friend_id')->unsigned();
			$table->string('status');
			$table->timestamps();
		});

		Schema::create('user_following', function(Blueprint $table)
		{
			$table->bigIncrements('id')->unsigned();
			$table->bigInteger('user_id')->unsigned();
			$table->bigInteger('following_id')->unsigned();
			$table->string('type');
			$table->timestamps();
		});









		Schema::create('company', function(Blueprint $table)
		{
			$table->bigIncrements('id')->unsigned();
			$table->string('name');
			$table->string('location');
			$table->string('type');
			$table->timestamps();
		});

		Schema::create('platform', function(Blueprint $table)
		{
			$table->bigIncrements('id')->unsigned();
			$table->string('name');
			$table->bigInteger('manufacturer_id')->unsigned();
			$table->string('type');
			$table->timestamps();
		});







		// GAME
		Schema::create('game', function(Blueprint $table)
		{
			$table->bigIncrements('id')->unsigned();
			$table->string('name');
			$table->timestamps();
		});
		Schema::create('game_platforms', function(Blueprint $table)
		{
			$table->bigIncrements('id')->unsigned();
			$table->bigInteger('game_id')->unsigned();
			$table->bigInteger('platform_id')->unsigned();
			$table->timestamps();
		});

		


		/* content */
		Schema::create('posts', function(Blueprint $table)
		{
			$table->bigIncrements('id')->unsigned();
			$table->text('body');
			$table->bigInteger('user_id')->unsigned();
			$table->timestamps();
		});


		//Chat
		Schema::create('chat_conversations', function($table){
			$table->bigIncrements('id')->unsigned();
			$table->timestamps();
		});
		Schema::create('chat_messages', function($table){
			$table->bigIncrements('id')->unsigned();
			$table->text("content");
			$table->bigInteger('user_id')->unsigned();
			$table->bigInteger('conversation_id')->unsigned();
			$table->timestamps();
		});
		Schema::create('chat_conversation_user', function($table){
				$table->bigIncrements('id')->unsigned();
				$table->bigInteger('user_id')->unsigned();
				$table->bigInteger('conversation_id')->unsigned();
		});




	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
		//Schema::drop('user_auth');
		
		Schema::drop('profiles');
		
		Schema::drop('user_friends');
		Schema::drop('user_following');
		
		Schema::drop('company');
		Schema::drop('platform');

		Schema::drop('game');
		Schema::drop('game_platforms');

		Schema::drop('posts');


		Schema::drop('chat_conversations');
		Schema::drop('chat_messages');
		Schema::drop('chat_conversation_user');

	}

}
