@extends('layouts.master')

@section('content')

<section id="editAccount">
	<h2>Edit account</h2>

	{{ Form::model($account, array('url' => 'account/edit', 'method' => 'put')) }}

		@if ( ! empty($errors->all()))
			<div id="errorsEA">
				<ul>
					@foreach ($errors->all() as $i => $errorMessage)
						<li><strong>{{ $i+1 }}.</strong> {{ $errorMessage }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		@if (Session::has('wrongPassword'))
			<div id="errorEA">
				<p>{{ Session::get('wrongPassword') }}</p>
			</div>
		@endif

		@if (Session::has('accountUpdated'))
			<div id="successEA">
				<p>{{ Session::get('accountUpdated') }}</p>
			</div>
		@endif

		<div>
			{{ Form::label('username', 'Username', ['class' => 'column-ident']) }}
			{{ Form::text('username') }}
		</div>

		<div>
			{{ Form::label('email', 'Email', ['class' => 'column-ident']) }}
			{{ Form::email('email') }}
		</div>

		<div>
			{{ Form::label('newPassword', 'New password', ['class' => 'column-ident']) }}
			{{ Form::password('newPassword') }}

			<small>(Leave this field blank if you want to keep your password unchanged.)</small>
		</div>

		<div>
			{{ Form::label('birthdate', 'Birthdate', ['class' => 'column-ident']) }}

			<?php

				$birthdate = explode_birthdate($account->birthdate);

				$account->birthYear 	= $birthdate['year'];
				$account->birthMonth 	= $birthdate['month'];
				$account->birthDay 		= $birthdate['day'];

			?>

			<?php

				$yearRange = get_year_range();

				$yearFieldData = array('' => 'Year');

				foreach (range($yearRange['min'], $yearRange['max']) as $year)
				{
					$yearFieldData = array_add($yearFieldData, (string) $year, (string) $year);
				}

			?>
			{{ Form::select('birthYear', $yearFieldData) }}

			<?php

				$months = [
					'January',
					'February',
					'March',
					'April',
					'May',
					'June',
					'July',
					'August',
					'September',
					'October',
					'November',
					'December'
				];

				$monthFieldData = array('' => 'Month');

				foreach ($months as $i => $month)
				{
					$monthFieldData = array_add($monthFieldData, (string) ($i+1), $month);
				}

			?>
			{{ Form::select('birthMonth', $monthFieldData) }}

			<?php

				$dayFieldData = array('' => 'Day');

				for ($day = 1; $day <= 31; $day++)
				{
					$dayFieldData = array_add($dayFieldData, (string) $day, (string) $day);
				}

			?>
			{{ Form::select('birthDay', $dayFieldData) }}
		</div>

		<div class="text-center">
			<?php
				// this code could be replaced with the array_search function used below if using the select tag
				switch ($account->gender)
				{
					case 'Female': 	$account->gender = '1'; 
						break;
					case 'Male': 	$account->gender = '2'; 
						break;
				}

			?>

			{{ Form::radio('gender', '1', null, array('id' => 'genderFemale')) }}
			{{ Form::label('genderFemale', 'Female', ['class' => 'valign-middle']) }}
			{{ Form::radio('gender', '2', null, array('id' => 'genderMale')) }}
			{{ Form::label('genderMale', 'Male', ['class' => 'valign-middle']) }}
		</div>

		<div>
			{{ Form::label('sexualOrientation', 'Orientation', ['class' => 'column-ident']) }}
			<?php

				$sexualOrientations = [
					'1' => 'Straight',
					'2' => 'Gay',
					'3' => 'Bisexual'
				];

				$account->sexualOrientation = array_search($account->sexual_orientation, $sexualOrientations);

			?>
			{{ Form::select('sexualOrientation', $sexualOrientations) }}
		</div>

		<section id="updateAccount">
			<h3>You have to enter your password in order to update your account</h3>

			{{ Form::label('password', 'Current password', ['class' => 'column-ident']) }}
			{{ Form::password('password') }}

			{{ Form::submit('Update account') }}
		</section>

	{{ Form::close() }}

</section>

@stop