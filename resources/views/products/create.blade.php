<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Produk</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dark page-create">
  <div class="container">
    <div class="header">
      <h1>Tambah Produk</h1>
    </div>

    @if ($errors->any())
    <div class="alert" style="background:#fee2e2; color:#991b1b; border:1px solid #fecaca;">
      <strong>Ups!</strong> Ada error pada input:
      <ul style="margin:8px 0 0 18px;">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif


    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" novalidate>
      @csrf

      <label>Nama Produk</label>
      <input type="text" name="name" value="{{ old('name') }}" required>

      <label>Harga (Rp)</label>
      <input type="number" name="price" value="{{ old('price') }}" min="0" required>

      <label>Stok</label>
      <input type="number" name="stock" value="{{ old('stock') }}" min="0" required>


      <label>Deskripsi</label>
      <textarea name="description" rows="3">{{ old('description') }}</textarea>

      <label>Foto Produk (opsional)</label>
      <input type="file" name="image" accept="image/*">

      <div class="form-actions">
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('products.index') }}" class="btn btn-danger">Batal</a>
      </div>
    </form>



    <footer>© {{ date('Y') }} Opulence Gallery</footer>
  </div>

</body>

</html>