@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="max-w-sm mx-auto mt-10 bg-black p-6 rounded text-white">
  <h2 class="text-2xl mb-4">Register</h2>
  <input id="username" type="text" class="w-full mb-2 p-2" placeholder="Username">
  <input id="email" type="email" class="w-full mb-2 p-2" placeholder="Email">
  <input id="password" type="password" class="w-full mb-2 p-2" placeholder="Password">
  <button id="register-btn" class="bg-white text-black px-4 py-2 rounded">Register</button>
  <div id="register-msg" class="mt-2"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const backendUrl = 'http://127.0.0.1:9000';
document.getElementById('register-btn').addEventListener('click', () => {
  axios.post(`${backendUrl}/api/register/`, {
    username: document.getElementById('username').value,
    email: document.getElementById('email').value,
    password: document.getElementById('password').value
  }).then(() => {
    document.getElementById('register-msg').innerText = 'Register berhasil. Redirecting ke login...';
    setTimeout(() => window.location.href = '/login', 1000);
  }).catch(() => {
    document.getElementById('register-msg').innerText = 'Gagal register';
  });
});
</script>
@endsection
