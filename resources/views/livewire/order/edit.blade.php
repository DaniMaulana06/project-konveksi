@section('title')
Edit Order
@endsection

<div class="container my-4">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Order</h4>
        </div>

        <div class="card-body">

            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
            @endif

            <form wire:submit.prevent="update">
                <input type="hidden" name="id" value="{{ $order->id }}">

                <div class="form-group mb-3">
                    <label for="nama_order">Nama Order</label>
                    <input type="text" class="form-control" id="nama_order" wire:model="nama_order">
                    @error('nama_order') <span>{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Produk</label>
                    <select wire:model="product_id" class="form-control">
                        <option value="">-- pilih produk --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->nama_produk }}
                            </option>
                        @endforeach
                    </select>
                    @error('product_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Customer</label>
                    <input type="name" class="form-control" wire:model="nama_customer">
                    @error('nama_customer') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="numeric" class="form-control" wire:model="no_telp">
                    @error('no_telp') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
               
                <div class="mb-3">
                    <label class="form-label">Asal Instansi</label>
                    <input type="text" class="form-control" wire:model="asal_instansi">
                    @error('asal_instansi') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Jumlah Order</label>
                    <input type="number" class="form-control" wire:model="jumlah_order">
                    @error('jumlah_order') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Total Harga</label>
                    <input type="number" class="form-control" wire:model="harga_total">
                    @error('harga_total') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-3">
                    <label>File Panduan</label><br>
                
                    @if($file_panduan_lama)
                        <p>
                            <strong>File saat ini:</strong>
                            <a href="{{ asset('storage/' . $file_panduan_lama) }}" target="_blank">
                                {{ basename($file_panduan_lama) }}
                            </a>
                        </p>
                    @endif
                    <input type="file" class="form-control" wire:model="file_panduan">
                </div>              

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea class="form-control" wire:model="keterangan"></textarea>
                </div>

                <button class="btn btn-success">Update Order</button>
                <a href="/order" wire:navigate class="btn btn-m btn-danger">Batal</a>
            </form>

        </div>

    </div>

</div>
