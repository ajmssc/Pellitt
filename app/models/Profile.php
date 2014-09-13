<?php

class Profile extends Eloquent {

	protected $table = 'profiles';
	public function users()
	{
		return $this->hasMany('User');
	}

}