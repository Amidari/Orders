<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehous extends Model
{
    use HasFactory;

    protected $table = 'warehouses';
    public $timestamps = false;

    protected $fillable = ['name'];
}
