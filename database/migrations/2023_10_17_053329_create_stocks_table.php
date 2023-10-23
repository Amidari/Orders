<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('warehouse_id')->constrained('warehouses');
            $table->integer('stock');
        });
        DB::table('stocks')->insert(
            [
                ['product_id' => '1', 'warehouse_id' => '1', 'stock' => '100'],
                ['product_id' => '2', 'warehouse_id' => '1', 'stock' => '101'],
                ['product_id' => '3', 'warehouse_id' => '1', 'stock' => '102'],
                ['product_id' => '4', 'warehouse_id' => '1', 'stock' => '103'],
                ['product_id' => '5', 'warehouse_id' => '1', 'stock' => '104'],
                ['product_id' => '1', 'warehouse_id' => '2', 'stock' => '105'],
                ['product_id' => '2', 'warehouse_id' => '2', 'stock' => '106'],
                ['product_id' => '3', 'warehouse_id' => '2', 'stock' => '107'],
                ['product_id' => '4', 'warehouse_id' => '2', 'stock' => '108'],
                ['product_id' => '5', 'warehouse_id' => '2', 'stock' => '109'],
                ['product_id' => '1', 'warehouse_id' => '3', 'stock' => '110'],
                ['product_id' => '2', 'warehouse_id' => '3', 'stock' => '111'],
                ['product_id' => '3', 'warehouse_id' => '3', 'stock' => '112'],
                ['product_id' => '4', 'warehouse_id' => '3', 'stock' => '113'],
                ['product_id' => '5', 'warehouse_id' => '3', 'stock' => '114'],


            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
