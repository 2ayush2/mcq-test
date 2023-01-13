<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ActiveTestScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->join("question_lists", "student_answers.fk_question_id", "question_lists.id")
            ->where('expiry_date', '>=', date("Y-m-d"));
    }
}
