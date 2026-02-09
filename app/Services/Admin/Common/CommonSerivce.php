<?php

namespace App\Services\Admin\Common;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\Relation;

class CommonSerivce
{
    public static function toggleisActive($data)
    {
        DB::beginTransaction();
        try {
            $type = strtolower($data->type); // e.g. "agent"


            $modelClass = Relation::getMorphedModel($type);

            if (!$modelClass) {
                ResponseMessage('Invalid type provided', 400);
            }

            //  Permission name based on model
            $permission = "{$type}.toggle";

            if (!auth()->user()->can($permission)) {
                return ResponseMessage('Unauthorized', 403);
            }

            $record = $modelClass::find($data->id);
            if (!$record) {
                ResponseMessage('Data not found', 404);
            }
            $record->is_active = $record->is_active ? 0 : 1;
            $record->save();
            DB::commit();
           return ResponseMessage('Toggle Update successfully', 200);
        } catch (\Exception $e) {
            DB::rollback();
            ResponseMessage($e->getMessage(), 402);
            throw $e;
        }
    }
}
