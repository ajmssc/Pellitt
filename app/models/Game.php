<?php

class Platform extends Eloquent {
	protected $table = 'platform';
	public $timestamps = true;
	

	public function games(){
		return $this->belongsToMany('Game', 'game_platforms', 'platform_id', 'game_id');
	}

}

class Game extends Eloquent {

	protected $table = 'game';
	public $timestamps = true;
	//protected $softDelete = false;

	// public function studio(){
	// 	return $this->hasOne('GameStudio', 'id', 'studio_id');
	// }
	// public function publisher(){
	// 	return $this->hasOne('GamePublisher', 'id', 'publisher_id');
	// }
	// public function platform(){
	// 	return $this->belongsToMany('Game', 'games_platforms_relationship', 'game_id', 'platform_id');
	// }
	public function platforms(){
		return $this->belongsToMany('Platform', 'game_platforms', 'game_id', 'platform_id');
	}
}