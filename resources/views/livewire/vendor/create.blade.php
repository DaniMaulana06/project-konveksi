@section('title')
    Tambah Vendor
@endsection


<div class="container mb-5 md-5 mt-5">
    <div class="row">
        <div class="col md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tambah Vendor</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group mb-4">
                            <label for="nama_vendor" class="form-label">Nama Vendor</label>
                            <input type="text" class="form-control" id="nama_vendor" wire:model="nama_vendor">
                            @error('nama_vendor') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="barang_vendor">Barang Vendor</label>
                            <input type="text" class="form-control" id="barang_vendor" wire:model="barang_vendor">
                            @error('barang_vendor') <span>{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="alamat_vendor">Alamat Vendor</label>
                            <input type="text" class="form-control" id="alamat_vendor" wire:model="alamat_vendor">
                            @error('alamat_vendor') <span>{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="no_vendor">Telp Vendor</label>
                            <input type="text" class="form-control" id="no_vendor" wire:model="no_vendor">
                            @error('no_vendor') <span>{{ $message }}</span> @enderror
                        </div>
                
                        <button type="submit" class="btn btn-primary float-end">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</div>