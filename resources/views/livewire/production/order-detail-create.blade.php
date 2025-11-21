@section('title' )
Create Order Detail
@endsection
<div class="m-5">
    <h3>Tambah Detail Produksi</h3>

    <form wire:submit.prevent="saveDetail">
        <input type="text" wire:model="size" placeholder="Ukuran" class="form-control mb-2">
        <input type="number" wire:model="qty" placeholder="Qty" class="form-control mb-2">
        <button class="btn btn-primary">Tambah Ukuran</button>
    </form>

    <hr>

    <form wire:submit.prevent="saveMaterial">
        <input type="text" wire:model="material_id" placeholder="ID Bahan" class="form-control mb-2">
        <input type="number" wire:model="material_qty" placeholder="Qty" class="form-control mb-2">
        <button class="btn btn-warning">Tambah Bahan</button>
    </form>
</div>
