@section('title')
    Production Material Form
@endsection

<div class="m-5">
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h4>Form Input Bahan Produksi untuk Order: {{ $productionList->nama_order ?? '' }}</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save">

                <input type="hidden" wire:model="production_list_id">
                @foreach($inputs as $index => $input)

                    <div class="row border rounded p-3 mb-3 bg-light">

                        <!-- Nama Bahan -->
                        <div class="col-md-4">
                            <label>Nama Bahan</label>
                            <select class="form-control" wire:model="inputs.{{ $index }}.material_id">
                                <option value="">-- Pilih Bahan --</option>
                                @foreach($materials as $mat)
                                    <option value="{{ $mat->id }}">{{ $mat->nama_bahan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Stok -->
                        <div class="col-md-2">
                            <label>Stok</label>
                            <input type="text" class="form-control" wire:model="inputs.{{ $index }}.stok" readonly>
                        </div>

                        <!-- Jumlah pakai -->
                        <div class="col-md-2">
                            <label>Jumlah Dipakai</label>
                            <input type="number" class="form-control" wire:model="inputs.{{ $index }}.jumlah">
                        </div>

                        <!-- Keterangan -->
                        <div class="col-md-3">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" wire:model="inputs.{{ $index }}.keterangan">
                        </div>

                        <!-- Hapus -->
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger" wire:click="removeInput({{ $index }})">
                                X
                            </button>
                        </div>
                    </div>
                @endforeach
                <button type="button" class="btn btn-primary mb-3" wire:click="addInput">
                    + Tambah Bahan
                </button>
                <button class="btn btn-success w-100 mb-5" type="submit">Simpan Semua Bahan</button>
            </form>
            
            @if($hasMaterials)
                <button wire:click="updateStatus('proses')" class="btn btn-success float-end ms-2">
                    Mulai Produksi
                </button>
            @endif
            <a href="{{ route('production.material.list') }}" class="btn btn-m btn-danger float-end" wire:navigate>Batal</a>
        </div>
    </div>
</div>