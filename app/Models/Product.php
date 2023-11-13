<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    public $timestamps = false;
    protected $fillable = ['name', 'price'];

    public function warehouse(): belongsToMany
    {
        return $this->belongsToMany(Warehouse::class, 'stocks', 'product_id', 'warehouse_id');
    }

}
