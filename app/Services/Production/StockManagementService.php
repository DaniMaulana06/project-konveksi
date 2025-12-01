<?php

namespace App\Services\Production;

use App\Models\Bahan;

class StockManagementService
{
    /**
     * Reduce stock for a material
     * 
     * @param int $materialId
     * @param int $quantity
     * @return void
     */
    public function reduceStock($materialId, $quantity)
    {
        $material = Bahan::find($materialId);
        
        if ($material) {
            $material->stok -= $quantity;
            $material->save();
        }
    }

    /**
     * Restore stock for a material
     * 
     * @param int $materialId
     * @param int $quantity
     * @return void
     */
    public function restoreStock($materialId, $quantity)
    {
        $material = Bahan::find($materialId);
        
        if ($material) {
            $material->stok += $quantity;
            $material->save();
        }
    }

    /**
     * Get current stock for a material
     * 
     * @param int $materialId
     * @return int
     */
    public function getMaterialStock($materialId)
    {
        $material = Bahan::find($materialId);
        
        return $material ? $material->stok : 0;
    }
}
