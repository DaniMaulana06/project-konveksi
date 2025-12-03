@section('title')
    Tambah Kategori
@endsection

<div class="container mb-5 md-5 mt-5">
    <div class="row">
        <div class="col md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tambah Kategori</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" wire:model="nama_kategori">
                            @error('nama_kategori') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi" wire:model="deskripsi">
                            @error('deskripsi') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="d-flex justify-content-end">

                            <a href="/kategori" class="btn btn-m btn-danger px-3 me-2" wire:navigate>Batal</a>
                            <button type="submit" class="btn btn-primary float-end">Simpan</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>

