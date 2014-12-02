<?php

class AccountsController extends BaseController {
	
	public function __contruct()
	{

	}

	public function create()
	{// only guests can create an account
		return View::make('account.create');
	}

	public function store()
	{// only guests can create an account
		$rules = [
			'username' 			=> 'required|max:25|regex:/^[a-zA-Z][a-zA-Z0-9]*$/|unique:accounts',
			'email'				=> 'required|max:80|email|unique:accounts',
			'password'			=> 'required|min:6',
			//check_age will run even if date_format rule renders false
			'birthdated'		=> 'required|date_format:Y-n-j|check_age',
			'gender' 			=> 'required|numeric|between:1,2',
			'sexualOrientation'	=> 'required|numeric|between:1,3'
		];

		// this will never be shown if the user uses the UI provided for registration
		$messages = [
			'check_age' => 'The birthdate entered is invalid.'
		];

		$validator = Validator::make(Input::all(), $rules, $messages);

		if ($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$account = Account::create([
			'username' 				=> Input::get('username'),
			'email'					=> Input::get('email'),
			'password'				=> Hash::make(Input::get('password')),
			// birthdated field should be removed and javascript should be used to render the birthdate format into YYYY-MM-DD			
			'birthdate' 			=> Input::get('birthdated'),
			'gender' 				=> Input::get('gender'),
			'sexual_orientation'	=> Input::get('sexualOrientation')
		]);

		Profile::create(['account_id' => $account->id]);

		Redirect::to('profile?')->with('status', 'Your account was created but your profile is empty. Click here to fill it.');
	}

	public function edit()
	{// only auth'ed users can access this method
		$account = Auth::user();

		return View::make('account.edit', compact('account'));
	}

	public function update()
	{// only auth'ed users can access this method
		$attributes = Input::all();

		$account = Auth::user();

		if ($attributes['username'] == $account->username)
		{
			$attributes = array_except($attributes, array('username'));
		}

		if ($attributes['email'] == $account->email)
		{
			$attributes = array_except($attributes, array('email'));
		}

		if (empty($attributes['newPassword']))
		{
			$attributes = array_except($attributes, array('newPassword'));
		}

		$rules = [
			'username' 		=> 'sometimes|required|max:25|regex:/^[a-zA-Z][a-zA-Z0-9]*$/|unique:accounts',
			'email'			=> 'sometimes|required|max:80|email|unique:accounts',
			'newPassword'	=> 'sometimes|required|min:6',

			// look above for the comment regarding this very same instruction
			//'birthdated'		=> 'required|date_format:Y-n-j|check_age',
			'gender' 			=> 'required|numeric|between:1,2',
			'sexualOrientation'	=> 'required|numeric|between:1,3',

			'password'		=> 'required'
		];

		// you can add custom error messages here

		$validator = Validator::make($attributes, $rules);

		if ($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}

		if ( ! Auth::validate(array('username' => $account->username, 'password' => $attributes['password'])))
		{
			return Redirect::back()->withInput()->with('wrongPassword', 'The password entered is incorrect.');
		}

		$account->username 				= Input::get('username');
		$account->email 				= Input::get('email');

		if (isset($attributes['newPassword']))
		{
			$account->password 			= Hash::make(Input::get('newPassword'));
		}

		//$account->birthdate 			= Input::get('birthdated');
		$account->gender 				= Input::get('gender');
		$account->sexual_orientation 	= Input::get('sexualOrientation');

		$account->save();

		return Redirect::to('account/edit')->with('accountUpdated', 'Your account has been updated!');
	}
}