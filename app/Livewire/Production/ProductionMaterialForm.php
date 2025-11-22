<?php
namespace App\Livewire\Production;
use App\Models\Bahan;
use App\Models\Order;
use App\Models\ProductionList;
use App\Models\ProductionListModel;
use App\Models\ProductionMaterial;
use Livewire\Component;

class ProductionMaterialForm extends Component
{
   
    public $production_list_id;
    public $material_id;
    public $stok_awal ;
    public $satuan;
    public $jumlah;
    public $keterangan;
    public $materials = [];

    public function mount($orderId)
{
    $order = Order::find($orderId);
    if (!$order) {
        abort(404, 'Order tidak ditemukan');
    }
    
    // Cek apakah production_list sudah ada
    $productionList = ProductionListModel::where('order_id', $orderId)->first();
    
    if (!$productionList) {
        // Buat production_list baru
        $productionList = ProductionListModel::create([
            'order_id' => $orderId,
            'status' => 'pending',
        ]);
    }
    
    // Set production_list_id dengan ID dari tabel production_list
    $this->production_list_id = $productionList->id;
    $this->materials = Bahan::all();
}

    // Penting: Gunakan #[On] atau update method
    public function updatedMaterialId($value)
    {
        if ($value) {
            $material = Bahan::find($value);
            if ($material) {
                $this->stok_awal = $material->stok;
                $this->satuan = $material->satuan;
                $this->dispatch('material-updated');
            }
        } else {
            $this->stok_awal = '';
            $this->satuan = '';
        }
    }

    public function save()
    {
        $this->validate([
            'production_list_id' => 'required|integer',
            'material_id' => 'required|exists:material,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        ProductionMaterial::create([
            'production_list_id' => $this->production_list_id,
            'material_id' => $this->material_id,
            'jumlah' => $this->jumlah,
            'keterangan' => $this->keterangan,
        ]);

        $material = Bahan::find($this->material_id);
        $material->stok -= $this->jumlah;
        $material->save();

        session()->flash('success', 'Bahan produksi berhasil ditambahkan.');
        $this->reset(['material_id', 'stok_awal', 'satuan', 'jumlah', 'keterangan']);
    }

    public function render()
    {
        return view('livewire.production.production-material-form', [
            'materials' => $this->materials,
        ]);
    }
}