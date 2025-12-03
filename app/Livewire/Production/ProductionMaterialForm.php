<?php

namespace App\Livewire\Production;

use App\Models\Bahan;
use App\Models\ProductionListModel;
use Livewire\Component;
use App\Services\Production\MaterialManagementService;
use App\Services\Production\StockManagementService;
use App\Actions\Production\UpdateProductionStatusAction;

class ProductionMaterialForm extends Component
{
    public $production_list_id;
    public $materials = [];
    public $inputs = [];
    public $existingMaterials = false;
    public $hasMaterials = false;
    public $productionList; // Tambahkan property ini

    // Helper method to get MaterialManagementService
    protected function getMaterialService()
    {
        return app(MaterialManagementService::class);
    }

    // Helper method to get StockManagementService
    protected function getStockService()
    {
        return app(StockManagementService::class);
    }

    // Helper method to get UpdateProductionStatusAction
    protected function getUpdateStatusAction()
    {
        return app(UpdateProductionStatusAction::class);
    }

    public function mount($orderId)
    {
        $this->productionList = ProductionListModel::with('order')->where('order_id', $orderId)->first();
        $this->production_list_id = $this->productionList->id;

        $this->materials = Bahan::all();

        // Use service to initialize materials
        $initialized = $this->getMaterialService()->initializeMaterials($this->production_list_id);
        $this->inputs = $initialized['inputs'];
        $this->hasMaterials = $initialized['hasMaterials'];
    }

    public function updatedInputs($value, $key)
    {
        $parts = explode('.', $key);

        if (count($parts) !== 2) {
            return;
        }

        $index = $parts[0];
        $field = $parts[1];

        if ($field === "material_id") {
            // Use service to get stock
            $this->inputs[$index]['stok'] = $this->getStockService()->getMaterialStock($value);
        }
    }

    public function addInput()
    {
        $this->inputs[] = [
            'material_id' => '',
            'stok' => '',
            'jumlah' => '',
            'keterangan' => '',
        ];
    }

    public function removeInput($i)
    {
        if (isset($this->inputs[$i])) {
            // Use service to remove material
            $this->getMaterialService()->removeMaterial(
                $this->production_list_id,
                $this->inputs[$i]['material_id'] ?? null,
                $this->inputs[$i]['jumlah'] ?? null
            );
        }

        unset($this->inputs[$i]);
        $this->inputs = array_values($this->inputs); // Reindex array
    }

    public function save()
    {
        // Use service to save materials
        $result = $this->getMaterialService()->saveMaterials($this->production_list_id, $this->inputs);

        if (!$result['success']) {
            session()->flash('error', $result['message']);
            return;
        }

        $this->hasMaterials = true;
        session()->flash('message', $result['message']);
    }

    public function updateStatus($status)
    {
        // Use action to update status
        $this->getUpdateStatusAction()->execute($this->production_list_id, $status);

        session()->flash('message', 'Status berhasil diperbarui!');
        return redirect()->route('production.index');
    }

    public function render()
    {
        return view('livewire.production.production-material-form', [
            'materials' => Bahan::all(),
        ]);
    }
}
