<?php

class Conversation extends Eloquent {
	
	protected $fillable = array('uid1', 'uid2');

	public function messages()
	{
		return $this->hasMany('Message');
	}
}