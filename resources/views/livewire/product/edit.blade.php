@section('title', 'Edit Produk')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary  text-white">
            <h5 class="mb-0">Edit Produk</h5>
        </div>

        <div class="card-body">

            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <form wire:submit.prevent="update">

                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" wire:model="nama_produk" class="form-control">
                    @error('nama_produk') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori Produk</label>
                    <select wire:model="kategori_produk" class="form-select">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="jersey">Jersey</option>
                        <option value="kemeja">Kemeja</option>
                        <option value="idcard">ID Card</option>
                        <option value="topi">Topi</option>
                    </select>
                    @error('kategori_produk') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Produk</label>
                    <input type="text" wire:model="deskripsi_produk" class="form-control">
                    @error('deskripsi_produk') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Gambar Lama --}}
                <div class="mb-3">
                    <label class="form-label">Gambar Lama</label><br>
                    <img src="{{ asset('storage/' . $gambar_lama) }}" width="120" class="rounded border">
                </div>

                {{-- Gambar Baru --}}
                <div class="mb-3">
                    <label class="form-label">Upload Gambar Baru (Opsional)</label>
                    <input type="file" wire:model="gambar_baru" class="form-control">

                    @if ($gambar_baru)
                        <div class="mt-2">
                            Preview:  
                            <img src="{{ $gambar_baru->temporaryUrl() }}" width="120" class="rounded border">
                        </div>
                    @endif

                    @error('gambar_baru') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <button class="btn btn-primary text-white px-4">Update</button>

            </form>

        </div>
    </div>

</div>
