@section('title')
    Buat Bahan
@endsection

<div class="container mb-5 md-5 mt-5">
    <form wire:submit.prevent="store">
        <div class="mb-3">
            <label for="nama_bahan" class="form-label">Nama Bahan</label>
            <input type="text" class="form-control" id="nama_bahan" wire:model="nama_bahan">
            @error('nama_bahan') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <select class="form-select" id="satuan" wire:model="satuan">
                <option value="">Pilih Satuan</option>
                <option value="meter">Meter</option>
                <option value="kilogram">Kilogram</option>
                <option value="lembar">Lembar</option>
                <option value="buah">Buah</option>
                <option value="roll">Roll</option>
            </select>
            @error('satuan') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" wire:model="stok">
            @error('stok') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>