@section('title' )
Production Material Form
@endsection

<div class="m-5">
    <form wire:submit.prevent="save">
        @csrf

        {{-- Pilih Bahan --}}
        <div class="mb-3">
            <label class="form-label">Nama Bahan</label>
            <select wire:model="material_id" class="form-control">
                <option value="">-- Pilih Bahan --</option>
                @foreach($materials as $bahan)
                    <option value="{{ $bahan->id }}">{{ $bahan->nama_bahan }}</option>
                @endforeach
            </select>
        </div>

        {{-- Stok Awal --}}
        <div class="mb-3">
            <label class="form-label">Stok Awal</label>
            <input type="text" class="form-control" wire:model="stok_awal" readonly>
        </div>

        {{-- Satuan --}}
        <div class="mb-3">
            <label class="form-label">Satuan</label>
            <input type="text" class="form-control" wire:model="satuan" readonly>
        </div>

        {{-- Jumlah Digunakan --}}
        <div class="mb-3">
            <label class="form-label">Jumlah Dipakai</label>
            <input type="number" class="form-control" wire:model="jumlah">
        </div>

        {{-- Keterangan --}}
        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea class="form-control" wire:model="keterangan"></textarea>
        </div>

        <button class="btn btn-primary">Simpan</button>

        @if (session()->has('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif
    </form>
</div>
