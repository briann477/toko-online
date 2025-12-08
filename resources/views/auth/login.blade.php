<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dark">
  <div class="container">
    <div class="header">
      <h1>Login</h1>
    </div>

    @if(session('success'))
    <div class="alert">{{ session('success') }}</div>
    @endif
    @if($errors->any())
    <div class="alert" style="background:#fee2e2;color:#991b1b;border:1px solid #fecaca;">
      {{ $errors->first() }}
    </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST" novalidate>
      @csrf
      <label>Email</label>
      <input type="email" name="email" value="{{ old('email') }}" required>

      <label>Password</label>
      <input type="password" name="password" required>

      <label style="display:flex;align-items:center;gap:6px;margin-top:10px;">
        <input type="checkbox" name="remember"> Remember me
      </label>

      <input type="submit" value="Masuk" class="btn btn-primary">
      <a href="/products" class="btn btn-danger">Kembali</a>
    </form>
  </div>

</body>

</html>