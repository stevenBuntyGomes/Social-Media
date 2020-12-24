<?php

namespace App\Scopes;


// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class ReverseScope implements Scope
{
    /**
     * Apply the scope to a Eloquant query builder
     *
     * @parm Illuminate\Database\Eloquent\Builder $builder
     * @parm Illuminate\Database\Eloquent\model $model
     *
     * @return void
     */

    public function apply(Builder $builder, Model $model){
        $builder->orderBy('id', 'desc');
    }
}
