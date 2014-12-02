@extends('layouts.master')

@section('content')

<section id="conversation">
	<section id="messages">
		@include('partials._show_messages')
	</section>

	{{ Form::open(['url' => 'conversation']) }}

		{{ Form::hidden('_uid', $otherUserId) }}

		{{ Form::textarea('text') }}

		{{ Form::submit('Send') }}

	{{ Form::close() }}
</section>

@stop

@section('javascript')

<script>
	
@if ($olderMessagesExist)
	function loadOlderMessages()
	{
		var messageId = $('.message').first().data('id');
		var url = '{{ Request::url() }}/{{ OLDER_MESSAGES }}/'+messageId;

		$.ajax({
			url: url
		})
			.done(function(html){
				$('#olderMessagesLink').replaceWith(html);
			})
			.fail(function(){});

		return false;
	}
@endif

$(document).ready(function(){

	$('form:first').submit(function(){

		var $this = this;
		var messageId = $('.message').last().data('id');
		var url = '{{ Request::url() }}/{{ NEWER_MESSAGES }}/'+messageId;

		$.ajax({
			url: url
		})
			.done(function(html){

				if (html)
				{
					$('#messages').append(html);

					if ( ! window.confirm('There are newer messages. Do you still want to send it?'))
						return false;
				}

				$this.submit();
			})
			.fail(function(){});

		return false;
	});

});

</script>

@stop