@section('title')
    Create Product
@endsection

<div class="container mb-5 md-5 mt-5">
    <form wire:submit.prevent="store">
        <div class="form-group mb-4">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" wire:model="nama_produk">
            @error('nama_produk') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-4">
            <label for="kategori_produk" class="form-label">Kategori Produk</label>
            <select class="form-select" id="kategori_produk" wire:model="kategori_produk">
                <option value="">Pilih Kategori Produk</option>
                <option value="jersey">Jersey</option>
                <option value="kemeja">Kemeja</option>
                <option value="idcard">idcard</option>
                <option value="topi">topi</option>
            </select>
            @error('kategori_produk') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <label for="deskripsi_produk" class="mb-2">Deskripsi Produk</label>
        <div class="form-floating">
            <textarea class="form-control" type="text" id="deskripsi_produk" style="height: 100px" wire:model="deskripsi_produk"></textarea>
            <label for="deskripsi_produk">Deskripsi Produk</label>
          </div>

        <div class="form-group mb-4">
            <label for="gambar">Gambar</label>
            <input type="file" class="form-control" id="gambar" wire:model="gambar">
            @error('gambar') <span>{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>