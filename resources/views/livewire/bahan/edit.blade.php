@section('title')
Edit Bahan
@endsection

<div class="cotainer m-5">
    <div>
        <h2 class="text-xl font-bold mb-4">Edit Bahan</h2>
    
        @if (session()->has('message'))
            <div class="p-2 bg-green-200 mb-3">{{ session('message') }}</div>
        @endif
    
        <form wire:submit.prevent="update">
    
            <div class="mb-3">
                <label class="block">Nama Bahan</label>
                <input type="text" wire:model="nama_bahan" class="border p-2 w-full">
                @error('nama_bahan') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
    
            <div class="mb-3">
                <label class="block">Satuan</label>
                <select wire:model="satuan" class="border p-2 w-full">
                    <option value="">-- Pilih Satuan --</option>
                    <option value="meter">Meter</option>
                    <option value="kilogram">Kilogram</option>
                    <option value="lembar">Lembar</option>
                    <option value="buah">Buah</option>
                    <option value="roll">Roll</option>
                </select>
                @error('satuan') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
    
            <div class="mb-3">
                <label class="block">Stok</label>
                <input type="number" wire:model="stok" class="border p-2 w-full">
                @error('stok') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
    
            <button class="bg-blue-600 text-white px-4 py-2">Update</button>
        </form>
    </div>
</div>

