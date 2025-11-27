@section('title', 'Edit Bahan')

<div class="container mt-5">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Bahan</h5>
        </div>

        <div class="card-body">

            {{-- Pesan sukses --}}
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
            @endif

            <form wire:submit.prevent="update">

                {{-- Nama Bahan --}}
                <div class="mb-3">
                    <label class="form-label">Nama Bahan</label>
                    <input type="text" wire:model="nama_bahan" class="form-control">
                    @error('nama_bahan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Satuan --}}
                <div class="mb-3">
                    <label class="form-label">Satuan</label>
                    <select wire:model="satuan" class="form-select">
                        <option value="">-- Pilih Satuan --</option>
                        @foreach ($bahan as $b)
                            <option value="{{ $b->satuan }}">{{ $b->satuan }}</option>
                        @endforeach
                    </select>
                    @error('satuan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Stok --}}
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" wire:model="stok" class="form-control">
                    @error('stok')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    
                <a href="/bahan" class="btn btn-m btn-danger px-3 me-3" wire:navigate>Batal</a>
                    <button class="btn btn-primary px-4">
                        <i class="bi bi-save"></i> Update
                    </button>
                    
                </div>
            </form>
        </div>
    </div>

</div>
