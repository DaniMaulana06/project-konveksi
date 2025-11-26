@section('title')
    Create Product
@endsection

<div class="container mb-5 md-5 mt-5">
    <div class="row">
        <div class="col md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tambah Produk</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group mb-4">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" wire:model="nama_produk">
                            @error('nama_produk') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                
                        <div class="form-group mb-4">
                            <label for="kategori_produk" class="form-label">Kategori Produk</label>
                            <select wire:model="category_id" class="form-control">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                                @endforeach
                            </select>
                            
                            @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
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
                
            </div>
        </div>
    </div>  
</div>