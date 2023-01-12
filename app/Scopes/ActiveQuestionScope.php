<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ActiveQuestionScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('expiry_date', '>=', date("Y-m-d"));
    }
}
