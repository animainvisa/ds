<?php

class ConversationsController extends BaseController {

	protected $authUserId;

	public function __construct() 
	{
		$this->authUserId = Auth::user()->id;
	}

	public function index()
	{
		// the user needs to be auth'ed

		// queries the DB for any existing conversations retrieving data from the last message sent/received
		$_conversations = DB::table('conversations')
			->select('*', 'conversations.id as id')
			->join('messages', 'conversations.last_message_id', '=', 'messages.id')
			->whereRaw('conversations.uid1 = ? or conversations.uid2 = ?', [$this->authUserId, $this->authUserId])
			->orderBy('conversations.updated_at', 'desc')
			->get();

		$conversations = array();

		// prepares a conversations array for output from the query data retrieved
		foreach ($_conversations as $i => $conversation)
		{
			if ($this->authUserId != $conversation->uid1)
			{
				$otherUserId 		= $conversation->uid1;
				$authUserLastRead 	= $conversation->u2_last_message_read_id;
			}
			else
			{
				$otherUserId 		= $conversation->uid2;
				$authUserLastRead 	= $conversation->u1_last_message_read_id;
			}

			$otherUser = Account::find($otherUserId);

			$conversations[$i]['username'] 	= $otherUser->username;
			// // whether you are the last sender or not
			$conversations[$i]['isSender'] 	= $this->authUserId == $conversation->sender_id ? true : false;
			$conversations[$i]['text'] 		= $conversation->text;
			$conversations[$i]['sentAt'] 	= $conversation->created_at;

			$unreadMessages = DB::table('messages')
				->where('conversation_id', $conversation->id)
				->where('sender_id', $otherUserId)
				->where('id', '>', $authUserLastRead)
				->get();

			$conversations[$i]['unreadMessagesExist'] = !empty($unreadMessages) ? true : false;
		}

		return View::make('conversation.index', compact('conversations'));
	}

	public function show($id, $option = null, $offset = null)
	{
		// the user needs to be auth'd

		// limits access to ajax requests when $option is different than null
		if ( ! is_null($option) && ! Request::ajax())
		{
			App::abort(404);
		}

		// prepares a query to retrieve messages from conversation with an id = $id
		$query = DB::table('conversations')
			->select('*', 'messages.id as id')
			->join('messages', 'conversations.id', '=', 'messages.conversation_id')
			->where('conversations.id', $id)
			// the following line prevents any auth'd user from accessing other conversations
			->whereRaw('(conversations.uid1 = ? or conversations.uid2 = ?)', [$this->authUserId, $this->authUserId]);

		// the following control statement will only run to load older or newer messages
		if ($option == OLDER_MESSAGES)
		{// TODO: check laravel's response to /conversation/id/option url
			$query->where('messages.id', '<', $offset);
		}
		elseif ($option == NEWER_MESSAGES)
		{
			$query->where('messages.id', '>', $offset);
		}

		// makes sure the data to be retrieved is ordered by descending order
		$query->orderBy('messages.id', 'desc');

		// if no data is returned an exception is thrown;
		// it might happen when a user tries to access a non-existing conversation or an existing one 
		// which doesn't belong to him/her
		if (empty($_messages = $query->get()))
		{
			if ($option == NEWER_MESSAGES)
				return '';

			throw new ModelNotFoundException;
		}

		// gets the other user's id
		$otherUserId = $this->authUserId != $_messages[0]->uid1 
					? $_messages[0]->uid1 
					: $_messages[0]->uid2;

		$olderMessagesExist = false;

		$numMessages = count($_messages);

		// the job of the following statement is to chop the array of
		// messages to a defined limit so as to display the most recent ones;
		// this doesn't apply to NEWER MESSAGES where they are all shown
		if ($option != NEWER_MESSAGES && $numMessages > NUM_MESSAGES)
		{
			// number of elements the messages array will be reduced to
			$numElements = NUM_MESSAGES;	

			// if there are unread messages beyond the limit defined, then
			// a new one will be set which will include all the messages not read;
			// this will only execute when the user opens the conversation
			if (is_null($option))
			{
				for ($i = NUM_MESSAGES; $i < $numMessages; $i++)
				{
					if ($_messages[$i]->sender_id != $this->authUserId)
					{
						if ($_messages[$i]->read)
							break;

						// this is updated whenever an unread message is found
						$numElements = $i+1;
					}
				}
			}

			if ($numMessages > $numElements)
			{
				$olderMessagesExist = true;
			}

			$_messages = array_slice($_messages, 0, $numElements);
		}

		// reverses the messages array so they are ordered by submission "date"
		$_messages = array_reverse($_messages);

		$messages = array();

		// prepares a messages array for output from the query data retrieved
		foreach ($_messages as $i => $message)
		{
			$sender = Account::find($message->sender_id);

			$messages[$i]['id']				= $message->id;
			//$messages[$i]['thumbnail_src'] 	= $sender->photos()->where('default', 1)->pluck('source');
			$messages[$i]['username'] 		= $sender->username;
			// whether you are the sender or not
			$messages[$i]['isSender'] 		= $this->authUserId == $message->sender_id ? true : false;
			$messages[$i]['text'] 			= $message->text;
			$messages[$i]['sentAt'] 		= $message->created_at;
			$messages[$i]['isRead']			= $message->read ? true : false;

			// makes the current message read if you haven't read it yet
			if ( ! $messages[$i]['isSender'] && ! $messages[$i]['isRead'])
			{
				$currentMessage = Message::find($messages[$i]['id']);
				//$currentMessage->update(['read' => 1]);
				$currentMessage->read = true;
				$currentMessage->save();
				
				$fieldName = ($this->authUserId == $message->uid1) 
					? 'u1_last_message_read_id' 
					: 'u2_last_message_read_id';

				DB::table('conversations')
					->where('id', $message->conversation_id)
					->update([$fieldName => $message->id]);

				$messages[$i]['justRead'] = true;
			}
		}

		$view = is_null($option) ? 'conversation.show' : 'partials._show_messages';

		return View::make($view, compact('messages', 'otherUserId', 'olderMessagesExist'));
	}
}