<?php

namespace App\Livewire\Production;

use App\Models\ProductionMaterial;
use Livewire\Component;

class ProductionMaterialList extends Component
{
    public function render()
    {
        $pm_list = ProductionMaterial::with(['material', 'productionList'])->get();
        return view('livewire.production.production-material-list', [
            'pm_list' => $pm_list
        ]);
    }
}
