<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';

    public $incrementing = false;

    public $timestamps = false;
    protected $fillable = ['product_id', 'warehouse_id','stock'];

}
