@extends('layouts.app')
@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<h1>HMAC Authentication</h1>
<div class="loggedIn">
  <span class="name"></span>
  <a href="#" class="sendRequest">Send a request to /test</a>
</div>
<div class="loggedOut">
  <a href="#" class="sendRequest">Try to send a request to /test (without being logged in)</a>
  <h3>Sign in Below</h3>
  <form id="loginForm"  method="post">
    <p><label>AccesskId</label><input type="text" id="key" required /></p>
    <p><label>Username</label><input type="text" id="username" required /></p>
    <p><label>Password</label><input type="password" id="password" required /></p>
    <button type="submit" id="submit">Login</button>
  </form>
  <div>
  </div>
</div>
@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>;
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/enc-base64.min.js"></script>;
<script src="js/hmac.js"></script>

@endsection
