<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">

	<title></title>

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
	<style>


.authUser
{
	
}

.otherUser
{
	
}

.justRead
{
	background-color: blue;
}

.unreadConversation
{
	background-color: blue;
}

@font-face
{
	font-family: Calligraphy;
	src: url(//{{ _HOST }}/calligraphy_flf.ttf);
}

.contentWidth
{
	margin: 0 auto;
	width: 900px;
}

header
{
	background-image: linear-gradient(#00688B, #236B8E);
}

#logo
{
	font-family: Calligraphy;
	color: #fff;
}

#logo h1
{
	margin: 0;
	padding: 2px 0;
}

ul
{
	padding: 0;
}

li
{
	list-style-type: none;
}

#login,
#signUp,
#editAccount
{
	width: 500px;
	margin: 25px auto;

	border: 1px solid #A3A3A3;
	border-radius: 3px;

	padding: 5px;
}

#login h2,
#signUp h2,
#editAccount h2
{
	margin: 0 0 10px 0;
	text-align: center;
	font-size: 18px;
	font-weight: bold;
	color: #00688B;
	padding: 10px;
}

#login form *
{
	display: block;
	font-size: 13px;
}

#login form label
{
	text-align: center;
	margin: 5px 0;
}

#login form input
{
	margin: 0 auto;
}

#login form input[type="submit"]
{
	margin: 5px auto;
}

footer
{
	
}

footer p
{
	text-align: center;
}

#login #errorLogin,
#editAccount #errorEA,
#editAccount #successEA
{
	width: 300px;
	margin: 0 auto 10px auto;
	border: 1px solid #d43f3a;
	background-color: #d9534f;
	color: #fff;
	padding: 2px 10px;
	border-radius: 3px;
}

#editAccount #successEA
{
	border: 1px solid #4cae4c !important;
	background-color: #5cb85c !important;
}

#login #errorLogin p,
#editAccount #errorEA p,
#editAccount #successEA p
{
	text-align: center;
	margin: 0;
}

#signUp #errorsSU, 
#editAccount #errorsEA
{
	margin-bottom: 10px;
}

#signUp #errorsSU ul, 
#editAccount #errorsEA ul
{
	width: 300px;
	margin: 0 auto;
	border: 1px solid #d43f3a;
	background-color: #d9534f;
	color: #fff;
	padding: 2px 10px;
	border-radius: 3px;
}

#signUp #errorsSU li, 
#editAccount #errorsEA li
{
	padding: 1px 0;
}

#signUp .column-ident,
#editAccount .column-ident
{
	text-align: right;
	width: 180px;
	padding: 0 2px;
}

#signUp form *,
#editAccount form *
{
	font-size: 13px;
}

#signUp form div,
#editAccount form div
{
	padding: 2px 0;
}

#signUp form input[type="submit"],
#editAccount form input[type="submit"]
{
	display: block;
	margin: 5px auto;
}

#signUp form input[type="radio"],
#editAccount form input[type="radio"]
{
	margin-left: 10px;
}

.text-center
{
	text-align: center;
}

.valign-middle
{
	vertical-align: middle;
}

#editAccount div small
{
	display: block;
	padding-left: 180px;
	font-size: 11px;
}

#updateAccount
{
	border-top: 1px solid #ccc;
	margin-top: 10px;
}

#updateAccount h3
{
	margin: 0;
	padding: 15px 0;
	text-align: center;
	font-size: 12px;
	font-weight: normal;
	color: #00688B;
}

label
{
	font-weight: normal;
}

article
{
	padding: 2px 5px;
}

.float-left
{
	float: left;
}

.float-right
{
	float: right;
}

.clear-left
{
	clear: left;
}

.clear-right
{
	clear: right;
}

.clear-both
{
	clear: both;
}

body
{
	background-color: #d8d8d8;
}

#conversation
{
	font-size: 12px;
	width: 600px;
	margin: 0 auto;
	border: 1px solid #bfbfbf;
	border-radius: 3px;
	background-color: #eaeaea;
	padding: 10px;
	margin-top: 25px;
}

#messages
{
	overflow: auto;
	height: 300px;
	background-color: #fdfdfd;
	border: 1px solid #cccccc;
	border-radius: 3px;
}

#messages .message
{
	border-top: 1px solid #cccccc;
}

#olderMessagesLink
{
	text-align: center;
	margin: 0;
	padding: 10px;
}




	</style>
</head>
<body>

	<header>
		<div class="contentWidth">
			<div id="logo">
				<h1>Unnamed</h1>
			</div>

		</div>
	</header>
<!--
	<nav>
		<div class="contentWidth">
			<ul>
				<li><a href="">Home</a></li>
				<li><a href="">Link</a></li>
				<li><a href="">Link</a></li>
				<li><a href="">Link</a></li>
			</ul>
		</div>
	</nav>
-->
	<main>
		<div class="contentWidth">
			@yield('content')
		</div>
	</main>

	<footer>
		<div class="contentWidth">
			<p>Copyright 2014</p>
		</div>
	</footer>

	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

	@yield('javascript')
</body>
</html>