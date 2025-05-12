@extends('layouts.main')

@section('title', 'Daftar Produk Katalog')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Daftar Produk Katalog</h4>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#createProductModal">
                            Tambah Produk
                        </button>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-xl">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        {{-- <th>Stok</th> --}}
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category->name ?? '-' }}</td>
                                            <td>{{ number_format($product->price, 2) }}</td>
                                            {{-- <td>{{ $product->stock }}</td> --}}
                                            <td>
                                                @if ($product->image)
                                                    <img src="{{ asset('storage/' . $product->image) }}" width="50"
                                                        height="50" class="img-thumbnail">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-nowrap">
                                                <div class="dropdown dropup">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton-{{ $product->id }}"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="dropdownMenuButton-{{ $product->id }}">
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                onclick="openEditModal({{ $product->id }}, '{{ $product->name }}', '{{ $product->description }}', {{ $product->price }}, {{ $product->stock }}, {{ $product->category_id }}, '{{ $product->image }}')">Ubah</a>
                                                        </li>
                                                        <li>
                                                            <form
                                                                action="{{ route('catalog_products.destroy', $product->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item">Hapus</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProductModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createProductForm" method="POST" action="{{ route('catalog_products.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="createName" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="createName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="createDescription" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="createDescription" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="createPrice" class="form-label">Harga</label>
                            <input type="number" step="0.01" class="form-control" id="createPrice" name="price"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="createStock" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="createStock" name="stock" required>
                        </div>
                        <div class="mb-3">
                            <label for="createCategory" class="form-label">Kategori</label>
                            <select class="form-select" id="createCategory" name="category_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="createImage" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="createImage" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editProductId" name="id">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="editDescription" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editPrice" class="form-label">Harga</label>
                            <input type="number" step="0.01" class="form-control" id="editPrice" name="price"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="editStock" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="editStock" name="stock" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCategory" class="form-label">Kategori</label>
                            <select class="form-select" id="editCategory" name="category_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editImage" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="editImage" name="image">
                            <div id="currentImageContainer" class="mt-2">
                                <small>Gambar saat ini:</small>
                                <img id="currentImage" src="" width="50" height="50"
                                    class="img-thumbnail d-none">
                                <span id="noImageText">-</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(id, name, description, price, stock, categoryId, image) {
            document.getElementById('editName').value = name;
            document.getElementById('editDescription').value = description;
            document.getElementById('editPrice').value = price;
            document.getElementById('editStock').value = stock;
            document.getElementById('editCategory').value = categoryId;
            document.getElementById('editProductId').value = id;
            document.getElementById('editProductForm').action = 'catalog_products/' + id;

            // Handle image display
            const currentImage = document.getElementById('currentImage');
            const noImageText = document.getElementById('noImageText');

            if (image) {
                currentImage.src = '/storage/' + image;
                currentImage.classList.remove('d-none');
                noImageText.classList.add('d-none');
            } else {
                currentImage.classList.add('d-none');
                noImageText.classList.remove('d-none');
            }

            var myModal = new bootstrap.Modal(document.getElementById('editProductModal'));
            myModal.show();
        }
    </script>
@endsection
