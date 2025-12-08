<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Produk</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dark">
  <div class="container">
    {{-- HEADER --}}
    <div class="header">
      <h1>Daftar Produk</h1>

      <div class="toolbar">
        {{-- Info user & login/logout --}}
        @auth
        <span class="muted">Halo, {{ auth()->user()->nama }}</span>
        <form action="{{ route('logout') }}" method="POST" class="inline-form">
          @csrf
          <button class="btn btn-danger" type="submit">Logout</button>
        </form>
        @else
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        @endauth

        {{-- Tombol tambah hanya untuk admin/superadmin --}}
        @auth
        @if(in_array((int)auth()->user()->role, [0,1]))
        <a href="{{ route('products.create') }}" class="btn btn-success">+ Tambah Produk</a>
        @endif
        @endauth

      </div>
    </div>

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
    <div class="alert">{{ session('success') }}</div>
    @endif

    {{-- ERROR MESSAGE --}}
    @if ($errors->any())
    <div class="alert alert-error">
      {{ $errors->first() }}
    </div>
    @endif

    {{-- FORM PENCARIAN --}}
    <form action="{{ route('products.index') }}" method="GET" class="searchbar">
      <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Cari produk..." class="input">
      <button class="btn btn-primary" type="submit">Cari</button>
      @if(!empty($q))
      <a href="{{ route('products.index') }}" class="btn btn-danger">Reset</a>
      @endif
    </form>

    {{-- TABEL PRODUK --}}
    <table>
      <thead>
        <tr>
          <th>Foto</th>
          <th>Nama</th>
          <th>Harga</th>
          <th>Deskripsi</th>
          <th style="width:180px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($products as $p)
        <tr>
          <td>
            @if($p->image)
            <img src="{{ asset('storage/'.$p->image) }}" alt="Foto" width="64" height="64"
              class="img-thumb">
            @else
            <span class="muted">-</span>
            @endif
          </td>
          <td>{{ $p->name }}</td>
          <td>Rp{{ number_format($p->price, 0, ',', '.') }}</td>
          <td>{{ $p->description ?? '-' }}</td>
          <td>
            @auth
            @if(in_array((int)auth()->user()->role, [0,1]))
            <a href="{{ route('products.edit', $p->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('products.destroy', $p->id) }}" method="POST" class="inline-form">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger"
                onclick="return confirm('Yakin hapus produk ini?')">Hapus</button>
            </form>
            @else
            <span class="muted">-</span>
            @endif
            @else
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            @endauth
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5">Belum ada produk.</td>
        </tr>
        @endforelse
      </tbody>
    </table>

    {{-- PAGINATION --}}
    <div class="pagination-wrapper">
      {{ $products->links() }}
    </div>

    <footer>© {{ date('Y') }} Opulence Gallery</footer>
  </div>

</body>

</html>