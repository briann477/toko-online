<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dark auth-page">

  <div class="login-card">

    {{-- HEADER: logo + teks login --}}
    <div class="login-header">
      <img src="{{ asset('images/logo.png') }}" class="login-logo" alt="Logo">
      <div>
        <h2 class="login-title">Login</h2>
        <p class="login-subtext">Silakan masuk untuk melanjutkan</p>
      </div>
    </div>

    @if($errors->any())
    <div class="alert alert-error">
      {{ $errors->first() }}
    </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST" novalidate>
      @csrf

      <label class="login-label">Email</label>
      <input type="email" name="email" value="{{ old('email') }}" class="login-input" required>

      <label class="login-label">Password</label>
      <input type="password" name="password" class="login-input" required>

      <label class="remember-row">
        <input type="checkbox" name="remember">
        Remember me
      </label>

      <button type="submit" class="login-btn-primary">Masuk</button>

    </form>

  </div>

</body>

</html>