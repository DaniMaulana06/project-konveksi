@section('title')
    Production Material List
@endsection

<div class="m-5">
    <div class="container mt-4">
        <h2 class="mb-4">Daftar Material Produksi</h2>
        <div class="accordion" id="materialAccordion">
            @foreach ($pm_list as $prodId => $items)
                <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="heading{{ $prodId }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $prodId }}" aria-expanded="false"
                            aria-controls="collapse{{ $prodId }}">

                            {{ $items->first()->productionList->order->nama_order }}
                        </button>
                    </h2>
                    <div id="collapse{{ $prodId }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $prodId }}" data-bs-parent="#materialAccordion">
                        <div class="accordion-body">
                            <table class="table table-bordered table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Material</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($items as $row)
                                        <tr>
                                            <td>{{ $row->material->nama_bahan }}</td>
                                            <td>{{ $row->jumlah }}</td>
                                            <td>{{ $row->keterangan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a href="/produksi" wire:navigate class="btn btn-sm btn-warning">Kembali</a>
    </div>
</div>