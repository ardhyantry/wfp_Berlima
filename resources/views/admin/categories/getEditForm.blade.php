<h3>Edit Kategori</h3>
<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="name" class="form-label">Nama Kategori</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}"
            required>
    </div>

    <div>
        <label for="image_path" class="form-label">Path Gambar</label>
        <input type="text" class="form-control" id="image_path" name="image_path"
            value="{{ old('image_path', $category->image_path) }}">
        <br>
        @if($category->image_path && file_exists(public_path('storage/' . $category->image_path)))
            <img src="{{ asset('storage/' . $category->image_path) }}" alt="Current Image" width="150">
        @else
            <p>Tidak ada gambar.</p>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
</form>