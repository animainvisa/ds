<?php namespace Foobar\Services;

use Conversation;

class ConversationService {

	public function exists($uid1, $uid2)
	{
		$conversation = 
			Conversation::whereRaw('(uid1 = ? and uid2 = ?)', [$uid1, $uid2])
			->orWhereRaw('(uid1 = ? and uid2 = ?)', [$uid2, $uid1])
			->first();

		if ( ! is_null($conversation))
		{
			return $conversation;
		}

		return false;
	}
}