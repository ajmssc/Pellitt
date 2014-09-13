<?php

class GameController extends BaseController {


	protected static $restful = true;

	public function getIndex()
	{
		$allgames = Game::all();
		foreach($allgames as $key => $game) {
			echo "<a href='/games/view/{$game->name}'>{$game->name}</a><BR>";
		}
	}

	public function postIndex()  {
		$type = Input::get('type');
		$game = Game::find(Input::get('game_id'));
		switch ($type) {
			case 'unfollow_game':
				Auth::user()->unfollow($game);
			break;
			case 'follow_game':
				Auth::user()->follow($game);
			break;
		}
		return Redirect::to("games/view/{$game->id}");
	}

	public function getView($id)
	{
		//echo 'game_id = ' . $id;
		if (intval($id) > 0) {
			$game = Game::find($id);
		} 
		if (!$game) {
			$game = Game::where('name', $id)->first();
		}
		if ($game) {
			echo $game;
			if(Auth::check())
			{
			   echo '<BR><BR><BR>';
				$is_following = Auth::user()->is_following($game);
				echo "<form method='POST' action='/games'><input type='hidden' name='game_id' value='{$game->id}'>";
				if($is_following) {
						echo "<input type='hidden' name='type' value='unfollow_game'>
							<input type='submit' value='Un-Follow Game'>";
				} else {
					echo "<input type='hidden' name='type' value='follow_game'>
							<input type='submit' value='Follow Game'>";
				}
				echo "</form>";
			}
		} else {
			echo 'game not found';
		}
		
	}



	public function postNew()  {
		$type = Input::get('type');
		switch($type) {
			case 'add_platform':
				$platform = new Platform;
				$platform->name = Input::get('name');
				$platform->save();
				return Redirect::to('/games/new');
			break;
			case 'delete_platform':
				Platform::destroy(Input::get('platform_id'));
				return Redirect::to('/games/new');
			break;

			case 'add_game':
				$platform = new Game;
				$platform->name = Input::get('name');
				$platform->save();
				return Redirect::to('/games/new');
			break;
			case 'delete_game':
				Game::destroy(Input::get('game_id'));
				return Redirect::to('/games/new');
			break;
		}
	}

	public function getNew()
	{
		$allplatforms = Platform::all();

		foreach($allplatforms as $key => $platform) {
			echo '<form method="POST" action="/games/new">
					<input type="hidden" name="type" value="delete_platform">
					<input type="hidden" name="platform_id" value="' . $platform->id . '">
					' . $platform->name . ' <input type="submit" value="Delete Platform"><BR></form>';
		}

		echo '
			<form method="POST" action="/games/new">
				<input type="hidden" name="type" value="add_platform">
				New Platform <input type="text" name="name">
				<input type="submit" value="Add Platform">
			</form>
		<BR><BR>';

		

		$allgames = Game::all();

		foreach($allgames as $key => $game) {
			echo '<form method="POST" action="/games/new">
					<input type="hidden" name="type" value="delete_game">
					<input type="hidden" name="game_id" value="' . $game->id . '">
					' . $game->name . ' <input type="submit" value="Delete Game"><BR></form>';
		}

		echo '
			<form method="POST" action="/games/new">
				<input type="hidden" name="type" value="add_game">
				New Game <input type="text" name="name">
				<input type="submit" value="Add Game">
			</form>
		<BR><BR>';

		
	}


	public function missingMethod($parameters = array())
	{
	    //
	}


}