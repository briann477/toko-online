  <!DOCTYPE html>
  <html lang="id">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  </head>

  <body class="dark">
    <div class="container">

      {{-- HEADER: hanya untuk judul + toolbar --}}
      <div class="header">
        <h1 class="title-with-logo">
          <img src="{{ asset('images/logo.png') }}" class="logo-dashboard" alt="logo">
          Dashboard
        </h1>


        <div class="toolbar">
          <span class="muted">
            Halo, {{ $user->nama }}
            ({{ $user->role == 0 ? 'Admin' : ($user->role == 1 ? 'Super Admin' : 'Customer') }})
          </span>

          <a href="{{ route('products.index') }}" class="btn btn-success">Ke Produk</a>

          <form action="{{ route('logout') }}" method="POST" class="inline-form">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
          </form>
        </div>
      </div>

      {{-- /header --}}

      {{-- FLASH MESSAGE di luar header --}}
      @if(session('success'))
      <div class="alert">{{ session('success') }}</div>
      @endif

      {{-- Sambutan --}}
      <div class="alert">Selamat datang di dashboard!</div>


      {{-- PRODUK TERBARU --}}
      @isset($recentProducts)
      <div class="dashboard-section">
        <h3>Produk Terbaru</h3>

        <table>
          <thead>
            <tr>
              <th>Foto</th>
              <th>Nama</th>
              <th>Harga</th>
              <th>Tambah</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($recentProducts as $p)
            <tr>
              <td>
                @if($p->image)
                <img src="{{ asset('storage/'.$p->image) }}" alt="Foto" width="48" height="48" class="img-thumb">
                @else
                <span class="muted">-</span>
                @endif
              </td>
              <td>{{ $p->name }}</td>
              <td>Rp{{ number_format($p->price,0,',','.') }}</td>
              <td>{{ $p->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="4">Belum ada produk.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      @endisset

      <div style="margin-top:16px;">
        @if(in_array((int)$user->role, [0,1]))
        <a href="{{ route('products.index') }}" class="btn btn-success">Kelola Produk</a>
        @else
        <a href="{{ route('products.index') }}" class="btn btn-primary">Lihat Produk</a>
        @endif
      </div>

      <footer style="margin-top:40px;">© {{ date('Y') }} Opulence Gallery</footer>
    </div>
  </body>

  </html>