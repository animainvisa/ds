<?php

function get_year_range()
{
	define('_MINIMUM_AGE', 18);
	define('_MAXIMUM_AGE', 99);

	$current_year = strftime('%Y');

	$min_year = $current_year-_MINIMUM_AGE;
	$max_year = $current_year-_MAXIMUM_AGE;

	return [
		'min' => $min_year, 
		'max' => $max_year
	];
}

function explode_birthdate($birthdate)
{
	$exploded = explode('-', $birthdate);

	return [
		'year'	=> $exploded[0],
		'month'	=> $exploded[1],
		'day'	=> $exploded[2]
	];
}
