<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Produk</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dark">
  <div class="container">
    <div class="header">
      <h1 class="title-with-logo">
        <img src="{{ asset('images/logo.png') }}" class="logo-dashboard" alt="Logo">
        Edit Produk
      </h1>

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

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" novalidate>
      @csrf
      @method('PUT')

      <label>Nama Produk</label>
      <input type="text" name="name" value="{{ old('name', $product->name) }}" required>

      <label>Harga (Rp)</label>
      <input type="number" name="price" value="{{ old('price', $product->price) }}" min="0" required>

      <label>Stok</label>
      <input type="number" name="stock"
        value="{{ old('stock', $product->stock) }}"
        min="0" required>


      <label>Deskripsi</label>
      <textarea name="description" rows="3">{{ old('description', $product->description) }}</textarea>

      <label>Foto Produk</label>
      @if($product->image)
      <div style="margin:8px 0;">
        <img src="{{ asset('storage/'.$product->image) }}" alt="Foto" width="120" style="object-fit:cover;border-radius:8px;border:1px solid #ccc;">
      </div>
      @endif
      <input type="file" name="image" accept="image/*">

      <input type="submit" value="Update" class="btn btn-primary">
      <a href="{{ route('products.index') }}" class="btn btn-danger">Batal</a>
    </form>

    <footer>© {{ date('Y') }} Opulence Gallery</footer>
  </div>

</body>

</html>