<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class ModelAbstract extends Model
{
    use AccessorsTrait, MutatorsTrait;

    protected $guarded = ['id'];

    public $timestamps = true;
}
