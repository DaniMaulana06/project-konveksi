@section('title')
    Create Order
@endsection

<div class="container mt-5 md-5 mb-5">
    <div class="row">
        <div class="col md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form wire:submit="store" enctype="multipart/form-data">
                        
                        <div class="form-group mb-4">
                            <label for="tgl_order">Tanggal Order</label>
                            <input type="date" class="form-control" id="tgl_order" wire:model="tgl_order">
                            @error('tgl_order') <span>{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="product_id">Produk</label>
                            <select class="form-control" id="product_id" wire:model="product_id">
                                <option value="">-- Pilih Produk --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->nama_produk }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="nama_customer">Nama Customer</label>
                            <input type="text" class="form-control" id="nama_customer" wire:model="nama_customer">
                            @error('nama_customer') <span>{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="no_telp">Nomor Telepon</label>
                            <input type="text" class="form-control" id="no_telp" wire:model="no_telp">
                            @error('no_telp') <span>{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="asal_instansi">Asal Instansi</label>
                            <input type="text" class="form-control" id="asal_instansi" wire:model="asal_instansi">
                            @error('asal_instansi') <span>{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="jumlah_order">Jumlah Order</label>
                            <input type="number" class="form-control" id="jumlah_order" wire:model="jumlah_order">
                            @error('jumlah_order') <span>{{ $message }}</span> @enderror
                        </div>

                        {{-- <div class="form-group mb-4">
                            <label for="harga_total">Harga Total</label>
                            <input type="number" class="form-control" id="harga_total" wire:model="harga_total">
                            @error('harga_total') <span>{{ $message }}</span> @enderror
                        </div> --}}

                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="harga_total" wire:model="harga_total">
                            @error('harga_total') <span>{{ $message }}</span> @enderror
                          </div>

                        <div class="form-group mb-4">
                            <label for="file_panduan">File Panduan</label>
                            <input type="file" class="form-control" id="file_panduan" wire:model="file_panduan">
                            @error('file_panduan') <span>{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="btn btn-md btn-primary">Simpan</button>

                        @if (session()->has('message'))
                            <div>
                                {{ session('message') }}
                            </div>
                        @endif
                        <a href="/order" wire:navigate class="btn btn-md btn-danger">Batal</a>
                    </form>
                    
                </div>
            </div>
        </div>

    </div>
</div>