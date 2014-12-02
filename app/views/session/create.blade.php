@extends('layouts.master')

@section('content')

<section id="login">
	<h2>Log in</h2>

	{{ Form::open(['url' => 'login']) }}

		@if (Session::has('error'))
			<div id="errorLogin">
				<p>{{ Session::get('error') }}</p>
			</div>
		@endif

		{{ Form::label('uid', 'Username or Email') }}
		{{ Form::text('uid') }}

		{{ Form::label('password', 'Password') }}
		{{ Form::password('password') }}

		{{ Form::submit('Login') }}

	{{ Form::close() }}

</section>

@stop