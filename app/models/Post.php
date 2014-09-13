<?php

class Post extends Eloquent {

	protected $table = 'posts';
  	protected $fillable = array('body');
	public function user()
	{
		return $this->belongsTo('User');
	}




}