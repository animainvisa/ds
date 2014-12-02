<?php

class MessagesController extends BaseController {

	protected $authUserId;

	public function __construct() 
	{
		$this->authUserId = Auth::user()->id;
	}

	public function store()
	{
		// TODO: the user needs to be auth'ed

		$receiverId = Input::get('_uid');

		$receiver = Account::find($receiverId);

		// checks whether the receiving user exists or not;
		// if it doesn't, a 404 not found page is thrown
		if (is_null($receiver))
		{
			App::abort(404);
		}

		// queries the DB to check for an existing conversation
		$conversation = 
			Conversation::whereRaw('(uid1 = ? and uid2 = ?)', [$this->authUserId, $receiverId])
			->orWhereRaw('(uid1 = ? and uid2 = ?)', [$receiverId, $this->authUserId])
			->first();

		// creates new conversation if it doesn't exist yet
		if (is_null($conversation))
		{
			$conversation = Conversation::create([
				'uid1' => $this->auth_uid,
				'uid2' => $receiver_id
			]);
		}

		// stores the message
		$message = Message::create([
			'conversation_id' 	=> $conversation->id,
			'sender_id' 		=> $this->authUserId,
			'text'				=> Input::get('text')
		]);

		// updates last_message_id field of conversation model to the lastest message just submitted
		// TODO?: updated_at field of message model might mismatch conversation model's one
		//$conversation->update(['last_message_id' => $message->id]);
		$conversation->last_message_id = $message->id;
		$conversation->save();

		// TODO: redirects to the conversation? what if the message is submitted on the user's profile? Another form field could be used for detection
	}
}