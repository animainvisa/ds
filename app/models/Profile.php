<?php

class Profile extends Eloquent {
	
	protected $guarded = array('id');

	public function account()
	{
		return $this->belongsTo('Account');
	}
}