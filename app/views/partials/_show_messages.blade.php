@if ($olderMessagesExist)
	<p id="olderMessagesLink"><a href="" onclick="return loadOlderMessages()">Load older messages</a></p>
@endif

@foreach ($messages as $message)

	<?php

		$messageClasses = $message['isSender'] ? 'authUser' : 'otherUser';

		if (isset($message['justRead']))
		{
			$messageClasses .= ' justRead';
		}

	?>

	{{ '<article class="message '.$messageClasses.'" data-id="'.$message['id'].'">' }}
		{{ '<p class="float-left"><strong>'.$message['username'].'</strong></p>' }}
		{{ '<p class="float-right">'.$message['sentAt'].'</p>' }}
		{{ '<p class="clear-left">'.$message['text'].'</p>' }}

	{{--
		// lets you know whether the messages you sent were read or not
		@if ($message['isSender'] && $message['isRead'])
			<img alt="tick" src="">
		@endif
	--}}

	{{ '</article>' }}

@endforeach
