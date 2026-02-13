<?php

namespace App\Services\Admin\InventoryLedger;

use Illuminate\Support\Facades\DB;
use App\Repositories\InventoryLedger\InventoryLedgerInterface;

class InventoryLedgerService
{
    protected $repo;
    protected $itemRepo;

    public function __construct(InventoryLedgerInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAll(array $data)
    {
        return $this->repo->all($data);
    }

    public function getDetail(int $id)
    {
        return $this->repo->findById($id);
    }

    public function save(array $data)
    {
        return DB::transaction(function () use ($data) {
            $ledger = $this->repo->updateOrCreate(
                ['id' => $data['id'] ?? null],
                [
                    'inventory_id' => $data['inventory_id'],
                    'transaction_type' => $data['transaction_type'],
                    'transaction_id' => $data['transaction_id'] ?? null,
                    'reference_no' => $data['reference_no'] ?? null,
                    'date_time' => $data['date_time'],
                    'remarks' => $data['remarks'] ?? null,
                ]
            );

            if (!empty($data['inventory_ledger_items'])) {
                $ledger->inventory_ledger_items()->delete();
                foreach ($data['inventory_ledger_items'] as $itemData) {
                    $this->itemRepo->updateOrCreate(
                        ['id' => $itemData['id'] ?? null],
                        [
                            'inventory_ledger_id' => $ledger->id,
                            'item_id' => $itemData['item_id'],
                            'quantity' => $itemData['quantity'],
                        ]
                    );
                }
            }

            return $this->repo->findById($ledger->id);
        });
    }
}
