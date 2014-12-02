@extends('layouts.master')

@section('content')

@if (Session::has('status'))
	{{ Session::get('status') }}
@endif

<pre>
Username: {{ $account->username }}
Birthdate: {{ $account->birthdate }}
Gender: {{ $account->gender }}
Orientation: {{ $account->sexual_orientation }}

Occupation: {{ $profile->occupation }}
Height: {{ $profile->height }}
Want kids?: {{ $profile->want_kids }}
Kids at home?: {{ $profile->kids_home }}
Ethnicity: {{ $profile->ethnicity }}
Religion: {{ $profile->religion }}
Drinks?: {{ $profile->drinks }}
Smokes: {{ $profile->smokes }}
Body type: {{ $profile->body_type }}
Education: {{ $profile->education }}
Marital status: {{ $profile->marital_status }}
Pets: {{ $profile->pets }}
Longest relationship: {{ $profile->longest_relationship }}
Drugs: {{ $profile->drugs }}
Eye color: {{ $profile->eye_color }}

About: {{ $profile->about }}
</pre>
@stop