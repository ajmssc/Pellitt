<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class User extends Ardent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;


	protected $table = 'users';
	public $autoPurgeRedundantAttributes = true; // purges password_confirmation

	public static $rules = array(
	  //'username' => 'required|unique:users|between:4,16',
	  'email' => 'required|unique:users|email',
	  'password' => 'required|min:8|confirmed',
	  'password_confirmation' => 'required|min:8',
	);

	public static $customMessages = array(
		'required' => 'The :attribute field is required.'
	);
	public static $passwordAttributes  = array('password');
	public $autoHashPasswordAttributes = true;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	protected $fillable = array('email');

	protected $guarded = array('id', 'password');

	public function posts()
	{
	  return $this->hasMany('Post');
	}
	public function profile()
	{
		return $this->belongsTo('Profile');
	}
	public function scopeByFacebook($query) { return $query->whereType('facebook'); }
	public function scopeByEmail($query) { return $query->whereType('email'); }



// 	use UserTrait, RemindableTrait;

// 	/**
// 	 * The database table used by the model.
// 	 *
// 	 * @var string
// 	 */
// 	protected $table = 'users';
	
	
// 	public $autoPurgeRedundantAttributes = true; // purges password_confirmation
	
// 	public static $rules = array(
// 	  'username' => 'required|unique:users|between:4,16',
// 	  'email' => 'required|unique:users|email',
// 	  'password' => 'required|min:8|confirmed',
// 	  'password_confirmation' => 'required|min:8',
// 	);

// 	public static $passwordAttributes  = array('password');
// 	public $autoHashPasswordAttributes = true;

// 	/**
// 	 * The attributes excluded from the model's JSON form.
// 	 *
// 	 * @var array
// 	 */
// 	protected $hidden = array('password', 'remember_token');

// 	protected $fillable = array('username', 'email');

// 	protected $guarded = array('id', 'password');

// 	public function posts()
// 	{
// 	  return $this->hasMany('Post');
// 	}




	
// 	/* FRIENDS RELATIONSHIPS */
// 	private function _friends_list($friend = NULL) {
// 		if ($friend) {
// 			return DB::select(DB::raw("
// 						select id, 
// 							case when user_id = ? then friend_id else user_id end as friend_id,
// 							case when user_id = ? then 'me' else 'friend' end as whorequested,
// 							status,	created_at,	updated_at
// 						from user_friends where (user_id = ? and friend_id = ?) or (friend_id = ? and user_id = ?)
// 						"), [$this->id, $this->id, $this->id, $friend->id, $this->id, $friend->id]);
// 		}
// 		return DB::select( DB::raw("
// 					select id, 
// 						case when user_id = ? then friend_id else user_id end as friend_id,
// 						case when user_id = ? then 'me' else 'friend' end as whorequested,
// 						status,	created_at,	updated_at
// 					from user_friends where user_id = ? or friend_id = ?
// 					"), [$this->id, $this->id, $this->id, $this->id]);
// 	}
// 	private function _friendship_id($friend) {
// 		$results = $this->_friends_list($friend);
// 		if (count($results) > 0) return $results[0]->id;
// 		return 0;
// 	}
// 	public function friendship_status($friend){
// 		$results = $this->_friends_list($friend);
// 		if (count($results) > 0) {
// 			if ($results[0]->status == 'requested' && $results[0]->whorequested == 'me') return 'user_requested';
// 			if ($results[0]->status == 'requested' && $results[0]->whorequested == 'friend') return 'friend_requested';
// 			return $results[0]->status;
// 		}
// 		return 'none';
// 	}
// 	public function is_friend($friend){
// 		return $this->friendship_status($friend) == 'active';
// 	}
	
// 	public function request_friend($friend){
// 		if ($this->friendship_status($friend) == 'none') { 
// 			DB::table('user_friends')
// 				->insert(array('user_id' => $this->id, 
// 								'friend_id' => $friend->id, 
// 								'status' => 'requested', 
// 								'created_at' => new DateTime,
// 								'updated_at' => new DateTime));
// 			return True;
// 		}
// 		return False;
// 	}
// 	public function accept_friend($friend){
// 		if ($this->friendship_status($friend) == 'friend_requested') { 
// 			DB::table('user_friends')->where('id', $this->_friendship_id($friend))->update(array('status' => 'active','updated_at' => new DateTime));
// 			return True;
// 		}
// 		return False;
// 	}
// 	public function remove_friend($friend){
// 		if ($this->friendship_status($friend) == 'active') { 
// 			DB::table('user_friends')->where('id', $this->_friendship_id($friend))->delete();
// 			return True;
// 		}
// 		return False;
// 	}










// /////FOLLOWING
// 	private function _following_list($item = NULL) {
// 		if ($item) {
// 			return DB::select( DB::raw("select * from user_following where user_id = ? and following_id = ? and type = ?"), 
// 				[$this->id, $item->id, get_class($item)]);
// 		}
// 		return DB::select( DB::raw("select * from user_following where user_id = ?"), [$this->id]);
// 	}
// 	private function _following_id($item) {
// 		$results = $this->_following_list($item);
// 		if (count($results) > 0) return $results[0]->id;
// 		return 0;
// 	}

// 	public function is_following($item){
// 		return count($this->_following_list($item)) > 0;
// 	}
// 	public function follow($item){
// 		if (! $this->is_following($item)) { 
// 			DB::table('user_following')
// 				->insert(array('user_id' => $this->id, 
// 								'following_id' => $item->id, 
// 								'type' => get_class($item), 
// 								'created_at' => new DateTime,
// 								'updated_at' => new DateTime));
// 			return True;
// 		}
// 		return False;
// 	}
// 	public function unfollow($item){
// 		if ($this->is_following($item)) {
// 			DB::table('user_following')->where('id', $this->_following_id($item))->delete();
// 			return True;
// 		}
// 		return False;
// 	}



// //////MESSAGES


// 	public function _messages($conversation_id) {
// 		if ($conversation_id) {
// 			return DB::select(DB::raw("select * from chat_conversations 
// 									left outer join chat_messages on chat_messages.conversation_id = chat_conversations.id 
// 									where chat_conversations.id = ? order by chat_conversations.created_at asc"), 
// 						 		[$conversation_id]);
// 		}
// 		return NULL;
// 	}
// 	public function _my_conversations() {
// 		return DB::select( DB::raw("select * from chat_conversation_user 
// 		 						where chat_conversation_user.conversation_id in (select conversation_id from chat_conversation_user where user_id = ?)
// 		 						order by conversation_id asc, user_id asc"), 
// 		 				 		[$this->id]);
// 	}
// 	public function _find_conversation($recipients) {
// 		$ids = array();
// 		foreach ($recipients as $u) {
// 			array_push($ids, $u->id);
// 		}
// 		sort($ids);
// 		$current_conversation = -1;
// 		$conversations = $this->_my_conversations();
// 		$temp_ids = array();
// 		for ($i=0; $i < count($conversations); $i++) {
// 			if ($current_conversation != $conversations[$i]->conversation_id) {
// 				sort($temp_ids);
// 				if ($current_conversation > -1 && $ids === $temp_ids) return $current_conversation;
// 				$current_conversation = $conversations[$i]->conversation_id;
// 				$temp_ids = array();
// 			}
// 			array_push($temp_ids, $conversations[$i]->user_id);
// 		}
// 		if ($current_conversation > -1 && $ids === sort($temp_ids)) return $current_conversation;
// 		return 0;		
// 	}


// 	public function send_message($receiver, $text){
// 		//test preconditions
// 		if(! (get_class($receiver) === 'User' || is_array($receiver) && count($receiver) > 0 && get_class($receiver[0]) === 'User') )
// 			return false;
// 		if (is_array($receiver)) {
// 			array_push($receiver, $this);
// 			$ids = array();
// 			foreach($receiver as $r) array_push($ids, $r->id);
// 			$conversation = $this->_find_conversation($receiver);
// 		} else { //only 1 person to msg
// 			$conversation = $this->_find_conversation([$this, $receiver]);
// 			$ids = array($this->id, $receiver->id);
// 		}


// 		if ($conversation == 0)  { // create new conversation
// 			$con = new Conversation;
// 			$con->save();
// 			$con->users()->sync($ids);
// 		} else {
// 			$con = Conversation::find($conversation);
// 		}

// 		$msg = new Message;
// 		$msg->content = $text;
// 		$msg->user_id = $this->id;
// 		$con->messages()->save($msg);
// 		return true;
//     }


// 	// public function friend_user_requested($friend){
// 	// 	$relationship = $this->belongsToMany('User', 'user_friends', 'user_id', 'friend_id')
// 	// 						->whereRaw("user_id = ? and friend_id = ? and status='requested'", 
// 	// 							[$this->id, $friend->id, $this->id, $friend->id])
// 	// 						->getResults();
// 	// 	return (count($relationship) > 0);
// 	// }

// 	// public function get_friends()
// 	// {
// 	// 	return DB::table('users')
// 	// 					->whereRaw('id in (select user_id from user_friends where friend_id = 1)')
// 	// 				->union(
// 	// 					DB::table('users')->whereRaw('id in (select friend_id from user_friends where user_id = 1)')
// 	// 					)->get();
		
// 	// 	// return DB::table('users')
//  //  //       ->join('user_friends', function($join)
//  //  //       {
//  //  //           $join->on('users.id', '=', 'user_friends.user_id')->andOn('user_friends.friend_id', '=', $this->id);
//  //  //       })
//  //  //       ->get();
// 	// 	//$first = $this->belongsToMany('User', 'user_friends', 'user_id', 'friend_id')->getResults();  
//  //     	//return $this->belongsToMany('User', 'user_friends', 'friend_id', 'user_id')->getResults()->union($first);
// 	// }
















// 	/**
// 	 * Get the unique identifier for the user.
// 	 *
// 	 * @return mixed
// 	 */
// 	public function getAuthIdentifier()
// 	{
// 	  return $this->getKey();
// 	}
	 
// 	/**
// 	 * Get the password for the user.
// 	 *
// 	 * @return string
// 	 */
// 	public function getAuthPassword()
// 	{
// 	  return $this->password;
// 	}
	 
// 	/**
// 	 * Get the e-mail address where password reminders are sent.
// 	 *
// 	 * @return string
// 	 */
// 	public function getReminderEmail()
// 	{
// 	  return $this->email;
// 	}


}
