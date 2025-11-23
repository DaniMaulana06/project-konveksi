@section('title')
Bahan
@endsection

<div class="container">
    <h1 class="my-4">Daftar Bahan</h1>
    <a href="{{ route('bahan.create') }}" class="btn btn-primary mb-3">Tambah Bahan</a>
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Bahan</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bahan as $b)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $b->nama_bahan }}</td>
                <td>{{ $b->satuan }}</td>
                <td>{{ $b->stok }}</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-danger" wire:click="destroy({{ $b->id }})">
                        Hapus
                    </button>
                </td>
            @endforeach
            @if($bahan->isEmpty())
            <tr>
                <td colspan="4" class="text-center">Data bahan kosong</td>
            </tr>
            @endif
            </tr>
        </tbody>
    </table>
</div>