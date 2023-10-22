<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'customer',
        'created_at',
        'updated_at',
        'warehouse_id',
        'status'];

    public function warehouse():BelongsTo
    {
        return $this->belongsTo(Warehous::class);
    }

    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_items');
    }

}

