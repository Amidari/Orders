<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Warehous extends Model
{
    use HasFactory;

    protected $table = 'warehouses';
    public $timestamps = false;

    protected $fillable = ['name'];

    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'warehouse_id', 'id');
    }

    public function product(): belongsToMany
    {
        return $this->belongsToMany(Stock::class, 'stocks');
    }

}
