@extends('layouts.master')

@section('content')

<section id="signUp">
	<h2>Sign Up</h2>

	{{ Form::open(['url' => 'account']) }}

		@if ( ! empty($errors->all()))
			<div id="errorsSU">
				<ul>
					@foreach ($errors->all() as $i => $errorMessage)
						<li><strong>{{ $i+1 }}.</strong> {{ $errorMessage }}</li>
					@endforeach
				</ul>
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
			{{ Form::label('password', 'Password', ['class' => 'column-ident']) }}
			{{ Form::password('password') }}
		</div>

		<div>
			{{ Form::label('birthdate', 'Birthdate', ['class' => 'column-ident']) }}

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

			?>
			{{ Form::select('sexualOrientation', $sexualOrientations) }}
		</div>

		{{ Form::submit('Create account') }}

	{{ Form::close() }}

</section>

@stop