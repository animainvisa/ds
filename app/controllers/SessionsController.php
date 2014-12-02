<?php

class SessionsController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('auth', array('only' => 'destroy'));

		$this->beforeFilter('guest', array('only' => 
												array('create', 'store')));

		$this->beforeFilter('csrf', array('only' => 'store'));
	}

	public function create()
	{
		return View::make('session.create');
	}

	public function store()
	{
		extract(Input::only('uid', 'password'));

		$labelId = str_contains($uid, '@') ? 'email' : 'username';

		$credentials = [
			$labelId 	=> $uid,
			'password' 	=> $password
		];

		//$remember = Input::get('remember') !== null ? true : false;

		if (Auth::attempt($credentials))
		{
			return 'successfully logged in. redirect to the main page.';
		}

		return Redirect::back()->withInput()->with('error', 'The credentials entered are not valid.');
	}

	public function destroy()
	{
		Auth::logout();

		return 'redirect to the main or login page';
	}
}