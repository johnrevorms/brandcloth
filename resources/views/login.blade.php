@extends('layouts.app')
@section('title', 'Login')
@section('content')

<section class="bg-white py-5">
  <div class="max-w-7xl mx-auto px-6">
</section>

<div class="max-w-sm mx-auto mt-10 bg-black p-6 rounded text-white">
  <h2 class="text-2xl mb-4">Login</h2>

  <!-- Tidak pakai form agar tidak auto submit GET -->
  <input id="username" type="text" class="w-full mb-2 p-2" placeholder="Username">
  <input id="password" type="password" class="w-full mb-2 p-2" placeholder="Password">

  <button id="login-btn" type="button" class="bg-white text-black px-4 py-2 rounded">Login</button>

  <div id="login-msg" class="mt-2"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const backendUrl = 'http://127.0.0.1:9000';

document.getElementById('login-btn').addEventListener('click', () => {
  const usernameInput = document.getElementById('username');
  const passwordInput = document.getElementById('password');

  if (!usernameInput || !passwordInput) {
    document.getElementById('login-msg').innerText = 'Form error: input tidak ditemukan.';
    return;
  }

  const username = usernameInput.value.trim();
  const password = passwordInput.value.trim();

  if (!username || !password) {
    document.getElementById('login-msg').innerText = 'Harap isi username dan password!';
    return;
  }

  console.log("Mengirim login:", { username, password });

  axios.post(`${backendUrl}/api/login/`, {
    username: username,
    password: password
  })
  .then(res => {
    localStorage.setItem('token', res.data.access);
    document.getElementById('login-msg').innerText = 'Login berhasil! Redirecting ke profile...';
    setTimeout(() => window.location.href = '/profile', 1000);
  })
  .catch(err => {
    console.error("Login error:", err);
    if (err.response) {
      document.getElementById('login-msg').innerText = 'Login gagal: ' + (err.response.data.detail || 'Periksa username dan password');
    } else {
      document.getElementById('login-msg').innerText = 'Login gagal: koneksi ke server error.';
    }
  });
});
</script>

<section class="bg-white py-5">
  <div class="max-w-7xl mx-auto px-6">
</section>
@endsection
