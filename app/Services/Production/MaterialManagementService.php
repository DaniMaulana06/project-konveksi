<?php

namespace App\Services\Production;

use App\Models\Bahan;
use App\Models\ProductionMaterial;
use App\Services\Production\StockManagementService;

class MaterialManagementService
{
    protected $stockService;

    public function __construct(StockManagementService $stockService)
    {
        $this->stockService = $stockService;
    }

    /**
     * Initialize materials for a production list
     * 
     * @param int $productionListId
     * @return array
     */
    public function initializeMaterials($productionListId)
    {
        $existing = ProductionMaterial::where('production_list_id', $productionListId)->get();

        $inputs = [];
        $hasMaterials = false;

        if ($existing->isNotEmpty()) {
            $hasMaterials = true;
            foreach ($existing as $mat) {
                $bahan = Bahan::find($mat->material_id);
                $inputs[] = [
                    'material_id' => $mat->material_id,
                    'stok' => $bahan ? $bahan->stok : 0,
                    'jumlah' => $mat->jumlah,
                    'keterangan' => $mat->keterangan,
                ];
            }
        } else {
            $inputs[] = [
                'material_id' => '',
                'stok' => '',
                'jumlah' => '',
                'keterangan' => '',
            ];
        }

        return [
            'inputs' => $inputs,
            'hasMaterials' => $hasMaterials
        ];
    }

    /**
     * Validate if material stock is sufficient
     * 
     * @param int $materialId
     * @param int $quantity
     * @return array ['valid' => bool, 'message' => string]
     */
    public function validateMaterialStock($materialId, $quantity)
    {
        $material = Bahan::find($materialId);

        if (!$material) {
            return [
                'valid' => false,
                'message' => 'Bahan tidak ditemukan.'
            ];
        }

        if ($quantity > $material->stok) {
            return [
                'valid' => false,
                'message' => "Jumlah bahan '{$material->nama_bahan}' melebihi stok tersedia ({$material->stok})."
            ];
        }

        return ['valid' => true, 'message' => ''];
    }

    /**
     * Save materials for production
     * 
     * @param int $productionListId
     * @param array $inputs
     * @return array ['success' => bool, 'message' => string]
     */
    public function saveMaterials($productionListId, $inputs)
    {
        foreach ($inputs as $inp) {
            if (!$inp['material_id'] || !$inp['jumlah']) {
                continue;
            }

            // Validate stock
            $validation = $this->validateMaterialStock($inp['material_id'], $inp['jumlah']);
            if (!$validation['valid']) {
                return [
                    'success' => false,
                    'message' => $validation['message']
                ];
            }

            // Create production material record
            ProductionMaterial::create([
                'production_list_id' => $productionListId,
                'material_id' => $inp['material_id'],
                'jumlah' => $inp['jumlah'],
                'keterangan' => $inp['keterangan'],
            ]);

            // Reduce stock
            $this->stockService->reduceStock($inp['material_id'], $inp['jumlah']);
        }

        return [
            'success' => true,
            'message' => 'Semua bahan berhasil disimpan.'
        ];
    }

    /**
     * Remove a material and restore its stock
     * 
     * @param int $productionListId
     * @param int $materialId
     * @param int $quantity
     * @return void
     */
    public function removeMaterial($productionListId, $materialId, $quantity)
    {
        if ($materialId && $quantity) {
            // Restore stock
            $this->stockService->restoreStock($materialId, $quantity);

            // Delete production material record
            ProductionMaterial::where('production_list_id', $productionListId)
                ->where('material_id', $materialId)
                ->delete();
        }
    }
}
