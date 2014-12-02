<?php

class ProfilesController extends BaseController {

	public function __construct() {}

	public function show($id)
	{
		// handle non-existing accounts
		$account = Account::findOrFail($id);
		$profile = $account->profile;

		return View::make('profile.show', compact('account', 'profile'));
	}

	public function edit()
	{
		// the user needs to be auth'ed

		$account = Auth::user();
		$profile = $account->profile;

		return View::make('profile.edit', compact('account', 'profile'));
	}

	public function update()
	{
		// needs to be auth'ed

		$rules = [
			'occupation' 			=> '',
			'height' 				=> '',
			'want_kids' 			=> '',
			'kids_home' 			=> '',
			'ethnicity' 			=> '',
			'religion' 				=> '',
			'drinks' 				=> '',
			'smokes' 				=> '',
			'body_type' 			=> '',
			'education' 			=> '',
			'marital_status' 		=> '',
			'pets' 					=> '',
			'longest_relationship' 	=> '',
			'drugs' 				=> '',
			'eye_color' 			=> '',
			'about' 				=> ''
		];

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$account = Auth::user();
		$profile = $account->profile;

		$profile->update(Input::all());

		$userURL = 'user/'.$account->id;

		return Redirect::to($userURL)->with('status', 'Your profile has been updated!');
	}
}