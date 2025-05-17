<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    protected $table = 'people';
    protected $fillable = ['name', 'age', 'job'];
    use SoftDeletes;
}
