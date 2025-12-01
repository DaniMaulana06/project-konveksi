<?php

namespace App\Actions\Production;

use App\Models\ProductionListModel;

class UpdateProductionStatusAction
{
    /**
     * Execute the action to update production status
     * 
     * @param int $productionListId
     * @param string $status
     * @return void
     */
    public function execute($productionListId, $status)
    {
        $production = ProductionListModel::findOrFail($productionListId);
        
        $order = $production->order;
        
        $order->update([
            'status_order' => $status
        ]);
    }
}
