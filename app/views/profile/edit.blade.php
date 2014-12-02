@extends('layouts.master')

@section('content')

{{ Form::model($profile, array('url' => 'profile/edit', 'method' => 'put')) }}

<pre>

<?php var_dump($errors); ?>

<?php

	$age = date_diff(date_create($account->birthdate), date_create('now'))->y;

?>

{{ $age }}
{{ $account->gender }}
{{ $account->sexual_orientation }}


Occupation: {{ Form::text('occupation') }}
Height: {{ Form::text('height') }}

<?php

	$yesOrNo = [
		'' 	=> '',
		'1' => 'Yes',
		'2' => 'No'
	];

	$profile->want_kids = array_search($profile->want_kids, $yesOrNo);

	$profile->kids_home = array_search($profile->kids_home, $yesOrNo);

?>

Want kids?: {{ Form::select('want_kids', $yesOrNo) }}

Kids at home?: {{ Form::select('kids_home', $yesOrNo) }}

<?php

	$ethnicities = [
		'' 	=> '',
		'1' => 'Caucasian',
		'2' => 'African American'
	];

	$profile->ethnicity = array_search($profile->ethnicity, $ethnicities);

?>
Ethnicity: {{ Form::select('ethnicity', $ethnicities) }}

<?php

	$religions = [
		'' 	=> '',
		'1' => 'Christian',
		'2' => 'Atheist'
	];

	$profile->religion = array_search($profile->religion, $religions);

?>
Religion: {{ Form::select('religion', $religions) }}

<?php

	$profile->drinks = array_search($profile->drinks, $yesOrNo);

	$profile->smokes = array_search($profile->smokes, $yesOrNo);

?>

Drinks?: {{ Form::select('drinks', $yesOrNo) }}

Smokes?: {{ Form::select('smokes', $yesOrNo) }}

<?php

	$bodyTypes = [
		'' 	=> '',
		'1' => 'Slim',
		'2' => 'Voluptuous'
	];

	$profile->body_type = array_search($profile->body_type, $bodyTypes);

?>
Body type: {{ Form::select('body_type', $bodyTypes) }}

<?php

	$educations = [
		'' 	=> '',
		'1' => 'High School',
		'2' => 'College'
	];

	$profile->education = array_search($profile->education, $educations);

?>
Education: {{ Form::select('education', $educations) }}

<?php

	$maritalStatuses = [
		'' 	=> '',
		'1' => 'Single',
		'2' => 'Engaged'
	];

	$profile->marital_status = array_search($profile->marital_status, $maritalStatuses);

?>
Marital status: {{ Form::select('marital_status', $maritalStatuses) }}

<?php

	$profile->pets = array_search($profile->pets, $yesOrNo);

?>
Pets: {{ Form::select('pets', $yesOrNo) }}

<?php

	$timePeriods = [
		'' 	=> '',
		'1' => 'Less than a year',
		'2' => '1 year'
	];

	$profile->longest_relationship = array_search($profile->longest_relationship, $timePeriods);

?>
Longest relationship: {{ Form::select('longest_relationship', $timePeriods) }}

<?php

	$yesAndSocially = [
		'' 	=> '',
		'1' => 'Yes',
		'2' => 'Socially',
		'3' => 'No'
	];

	$profile->drugs = array_search($profile->drugs, $yesAndSocially);

?>
Drugs: {{ Form::select('drugs', $yesAndSocially) }}

<?php

	$eyeColors = [
		'' 	=> '',
		'1' => 'Brown',
		'2' => 'Blue',
		'3' => 'Green'
	];

	$profile->eye_color = array_search($profile->eye_color, $eyeColors);

?>
Eye color: {{ Form::select('eye_color', $eyeColors) }}

About: {{ Form::textarea('about') }}

</pre>

	{{ Form::submit('Update profile') }}

{{ Form::close() }}

@stop