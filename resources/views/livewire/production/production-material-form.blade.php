@section('title')
    Production Material Form
@endsection

<div class="m-5">
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="save">
                <input type="hidden" wire:model="production_list_id">


                <!-- Material Select -->
                <div class="form-group mb-3">
                    <label for="material_id" class="form-label">Pilih Bahan</label>
                    <select id="material_id" wire:model.live="material_id"
                        class="form-control @error('material_id') is-invalid @enderror">
                        <option value="">-- Pilih Bahan --</option>
                        @foreach($materials as $material)
                            <option value="{{ $material['id'] }}">{{ $material['nama_bahan'] }}</option>
                        @endforeach
                    </select>
                    @error('material_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Stok Awal -->
                <div class="form-group mb-3">
                    <label for="stok_awal" class="form-label">Stok Awal</label>
                    <input id="stok_awal" type="text" class="form-control" wire:model="stok_awal" readonly
                        placeholder="Pilih bahan terlebih dahulu">
                </div>

                <!-- Satuan -->
                <div class="form-group mb-3">
                    <label for="satuan" class="form-label">Satuan</label>
                    <input id="satuan" type="text" class="form-control" wire:model="satuan" readonly
                        placeholder="Pilih bahan terlebih dahulu">
                </div>

                <!-- Jumlah -->
                <div class="form-group mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input id="jumlah" type="number" class="form-control @error('jumlah') is-invalid @enderror"
                        wire:model="jumlah" min="1" required>
                    @error('jumlah') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Keterangan -->
                <div class="form-group mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea id="keterangan" class="form-control" wire:model="keterangan" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Bahan Produksi</button>
            </form>
        </div>
    </div>
</div>