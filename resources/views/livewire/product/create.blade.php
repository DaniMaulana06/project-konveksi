@section('title')
    Create Product
@endsection

<div class="container mb-5 md-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-semibold">Tambah Produk</h5>
                </div>

                <div class="card-body">

                    <form wire:submit.prevent="store">

                        {{-- Nama Produk --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Nama Produk</label>
                            <input type="text"
                                class="form-control rounded-3 @error('nama_produk') is-invalid @enderror"
                                wire:model.defer="nama_produk">
                            @error('nama_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kategori --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Kategori Produk</label>
                            <select
                                wire:model.defer="category_id"
                                class="form-select rounded-3 @error('category_id') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Deskripsi Produk</label>
                            <textarea
                                class="form-control rounded-3"
                                rows="4"
                                wire:model.defer="deskripsi_produk"></textarea>
                        </div>

                        {{-- Upload Gambar --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Gambar</label>
                            <input type="file"
                                class="form-control @error('gambar') is-invalid @enderror"
                                wire:model="gambar">

                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            {{-- LOADING SAAT UPLOAD --}}
                            <div class="mt-2 text-primary small"
                                 wire:loading
                                 wire:target="gambar">
                                <span class="spinner-border spinner-border-sm"></span>
                                Mengupload gambar...
                            </div>

                            {{-- PREVIEW GAMBAR (RINGAN & OPSIONAL) --}}
                            @if ($gambar)
                                <div class="mt-3">
                                    <img src="{{ $gambar->temporaryUrl() }}"
                                         class="img-thumbnail rounded"
                                         width="150">
                                </div>
                            @endif
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('product.index') }}" class="btn btn-danger px-4 me-2">Batal</a>

                            <button type="submit" class="btn btn-primary px-4"
                                    wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="store">
                                    Simpan
                                </span>
                                <span wire:loading wire:target="store">
                                    <span class="spinner-border spinner-border-sm"></span>
                                    Menyimpan...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</div>
