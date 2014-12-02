@extends('layouts.master')

@section('content')

@if ( ! empty($conversations))

	{{ '<div id="conversations">' }}

	@foreach ($conversations as $conversation)

		<?php 

			$highlightClass = $conversation['unreadMessagesExist'] ? 'unreadConversation' : '';

		?>

		{{ '<div class="message '.$highlightClass.'">' }}

			{{ '<p>'.$conversation['username'].'</p>' }}

			@if ($conversation['isSender'])
				<p>&lt;-</p>
			@else
				<p>-&gt;</p>
			@endif

			{{ '<p>'.$conversation['text'].'</p>' }}
			{{ '<p>'.$conversation['sentAt'].'</p>' }}

		{{ '</div>' }}

	@endforeach

	{{ '</div>' }}

@else
	{{ '<p>No conversations yet. Start now!</p>' }}
@endif

@stop