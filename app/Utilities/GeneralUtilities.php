<?php

use Illuminate\Database\Eloquent\Relations\Relation;

if (!function_exists('RelationMorphName')) {
    function RelationMorphName($model)
    {
        return array_search(get_class($model), Relation::morphMap());
    }
}