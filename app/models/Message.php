<?php

class Message extends Eloquent {

	protected $fillable = array('conversation_id', 'sender_id', 'text');

	public function conversation()
	{
		return $this->belongsTo('Conversation');
	}
}