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
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name','255');
            $table->float('price');
        });
        DB::table('products')->insert(
            [
                ['name' => 'Товар 1', 'price' =>'1000'],
                ['name' => 'Товар 2', 'price' =>'2000'],
                ['name' => 'Товар 3', 'price' =>'3000'],
                ['name' => 'Товар 4', 'price' =>'4000'],
                ['name' => 'Товар 5', 'price' =>'5000'],
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
