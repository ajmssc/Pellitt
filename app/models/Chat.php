<?php


class Conversation extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'chat_conversations';


	public function messages(){
		return $this->hasMany('Message');
	}

	public function users(){
		return $this->belongsToMany('User', 'chat_conversation_user');
	}

	// /**
	//  * addUser
	//  *
	//  * adds users to this conversation
	//  *
	//  * @param array $participantEmails list of all participants
	//  * @return void
	//  */
	// public function addUser(array $participantEmails){
 //    	$friend_ids = array();

 //    	foreach($participantEmails as $f){
 //    		$user = User::where('email','=',$f)->first();
    		
 //    		if (!is_null($user)) $friend_ids[] = $user->id;
 //    	}
 
 //    	if(count($friend_ids)) $this->users()->attach($friend_ids);
	// }


}


class Message extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'chat_messages';

	protected $fillable = array('user_id', 'content','conversation_id');

	public function conversation(){
		return $this->belongsTo('Conversation');
	}

	public function user(){
		return $this->belongsTo('User');
	}

}