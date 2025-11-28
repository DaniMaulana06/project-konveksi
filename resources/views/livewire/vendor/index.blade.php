@section('title', 'Vendor')

<div class="container mb-5 md-5 mt-5">
    <div class="row">
        <div class="col md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Data Vendor</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('vendor.create') }}" class="btn btn-success mb-3">Tambah Vendor</a>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Vendor</th>
                                <th scope="col">Barang Vendor</th>
                                <th scope="col">Alamat Vendor</th>
                                <th scope="col">Telp Vendor</th>
                                <th scope="col" style="width: 20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vendors as $index => $vendor)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $vendor->nama_vendor }}</td>
                                    <td>{{ $vendor->barang_vendor }}</td>
                                    <td>{{ $vendor->alamat_vendor }}</td>
                                    <td>{{ $vendor->no_vendor }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('vendor.edit', $vendor->id) }}" class="btn btn-sm btn-primary me-2">Edit</a>
                                        <a href="{{ route('vendor.delete', $vendor->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data Vendor Belum Tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>