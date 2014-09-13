<?php

class UsersController extends BaseController {

	protected static $restful = true;


	public function getIndex()
	{
		$all = User::all();
		foreach($all as $key => $user) {
			echo "<a href='/users/view/{$user->id}'>{$user->username}</a><BR>";
		}
	
		if(Auth::check())
		{
		   echo 'user logged in';
		   //var_dump(Auth::user());
		} else {
			echo 'user not logged in';
		}
	}

	public function postIndex()  {
		echo 'postindex';

		$type = Input::get('type');
		$friend = User::find(Input::get('friend_id'));
		switch ($type) {
			case 'unfriend_user':
				Auth::user()->remove_friend($friend);
			break;
			case 'friend_user':
				Auth::user()->request_friend($friend);
			break;
			case 'accept_friend':
				Auth::user()->accept_friend($friend);
			break;
		}
		return Redirect::to("users/view/{$friend->id}");

	}



	public function getProfile() {
		if(Auth::check())
		{
			echo(Auth::user());
		} else {
			echo 'user not logged in';
		}
	}



	public function getView($id)
	{
		echo $id;
		if (intval($id) > 0) {
			$target_user = User::find($id);
		} else {
			$target_user = User::where('username', $id)->first();
		}

		if ($target_user) {
			echo $target_user;
			if(Auth::check() && Auth::user()->id != $target_user->id)
			{
				echo '<BR><BR><BR>';
				$friendship_status = Auth::user()->friendship_status($target_user);
				echo "<form method='POST' action='/users'><input type='hidden' name='friend_id' value='{$target_user->id}'>";
				switch($friendship_status) {
					case 'active':
						echo "<input type='hidden' name='type' value='unfriend_user'>
							<input type='submit' value='Un-Friend'>";
					break;
					case 'none': 
						echo "<input type='hidden' name='type' value='friend_user'>
							<input type='submit' value='Request Friend'>";
					break;

					case 'user_requested':
						echo "<input type='submit' value='Friend requested' disabled>";
					break;
					
					case 'friend_requested':
						echo "<input type='hidden' name='type' value='accept_friend'>
							<input type='submit' value='Accept Friend Request'>";
					break;

				}
				echo "</form>";
			} else {
				return Redirect::to('/profile');
			}
		}
		
	}


}