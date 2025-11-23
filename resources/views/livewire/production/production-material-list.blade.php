@section('title')
Production Material List
@endsection

<div class="m-5">
    <h3>Daftar Bahan Produksi</h3>
<div class="container md-5 mt-5">

</div>
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Bahan</th>
                <th>Satuan</th>
                <th>Jumlah Dipakai</th>
                <th>Keterangan</th>
                <th>Production ID</th>
                <th>Dibuat Pada</th>
            </tr>
        </thead>

        <tbody>
            @forelse($pm_list as $index => $pm)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pm->material->nama_bahan }}</td>
                    <td>{{ $pm->material->satuan }}</td>
                    <td>{{ $pm->jumlah }}</td>
                    <td>{{ $pm->keterangan }}</td>
                    <td>{{ $pm->productionList->id }}</td>
                    <td>{{ $pm->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data bahan produksi.</td>
                </tr>
            @endforelse
        </tbody>        
    </table>
    <a href="/produksi" wire:navigate class="btn btn-sm btn-warning">Kembali</a>
</div>
