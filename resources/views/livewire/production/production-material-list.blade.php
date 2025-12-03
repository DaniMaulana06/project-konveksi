@section('title', 'Production Material List')

<div class="container mt-5">

    {{-- HEADER --}}
    <div class="card card-body mb-4 shadow-sm border-0 rounded-4">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="fw-bold text-primary">📦 Daftar Material Produksi</h3>
            <a href="/produksi" wire:navigate class="btn btn-warning rounded-pill px-4">
                Kembali
            </a>
        </div>
    </div>


    {{-- SEARCH --}}
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body">
            <input type="text" class="form-control border-primary rounded-pill px-4"
                placeholder="Cari nama order atau material..." wire:model.live.debounce.300ms="search">
        </div>
    </div>

    {{-- ACCORDION MATERIAL LIST --}}
    <div class="accordion" id="materialAccordion">
        @forelse ($pm_list as $prodId => $items)
            {{-- Filter search --}}
            @php
                $orderName = strtolower($items->first()->productionList->order->nama_order);
                $filteredItems = $items->filter(function ($item) {
                    return stripos($item->material->nama_bahan, $this->search) !== false;
                });
            @endphp

            @if (stripos($orderName, $this->search) !== false || $filteredItems->isNotEmpty())
                <div class="accordion-item mb-3 shadow-sm rounded-4 border">
                    <h2 class="accordion-header" id="heading{{ $prodId }}">
                        <button class="accordion-button collapsed bg-primary text-white rounded-4" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $prodId }}"
                            aria-expanded="false" aria-controls="collapse{{ $prodId }}">
                            {{ $items->first()->productionList->order->nama_order }}
                        </button>
                    </h2>
                    <div id="collapse{{ $prodId }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $prodId }}" data-bs-parent="#materialAccordion">
                        <div class="accordion-body px-3">
                            <table class="table align-middle m-2">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Material</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($filteredItems as $row)
                                        <tr>
                                            <td>{{ $row->material->nama_bahan }}</td>
                                            <td>{{ $row->jumlah }}</td>
                                            <td>{{ $row->keterangan }}</td>
                                        </tr>
                                    @endforeach
                                    @if ($filteredItems->isEmpty())
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">
                                                Tidak ada material sesuai pencarian.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="text-center text-muted py-4">
                📭 Tidak ada data material produksi.
            </div>
            {{ $pm_list->links('vendor.pagination.bootstrap-5') }}
        @endforelse
    </div>

</div>
