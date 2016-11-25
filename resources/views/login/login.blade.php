<?php
$title = "登入";
?>
@extends('layouts.__sunwai_head')
@section('content')
<div class="container login_page">
	<form class="form_signin" role="form">
		<h1 class="form_signin_heading">請登入</h1>
		<label for="inputEmail" class="sr-only">Email address</label>
		<input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
		<div class="checkbox">
			<label> <input type="checkbox" value="remember-me"> 記得我 </label>
		</div>
		<button class="btn btn-primary btn-block" type="submit">登入</button>
	</form>
</div>
@endsection