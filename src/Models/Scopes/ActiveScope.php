<?php

namespace Sorethea\DocumentState\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ActiveScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->whereHas("states",function ($query){
            return $query->where("active",true)->where("state","!=",2);
        });
    }
}
