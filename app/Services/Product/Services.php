<?php

namespace App\Services\Product;

use App\Models\Product;

class Services
{

    public function index() {

        return Product::all();
    }

    /**
     * Сервис добавления склада.
     * @param array $data валидированные данные, максимум 255 символов.
     * @return bool
     * @throws Exception
     */

    public function store(array $data):bool {

        $table = new Product;
        $table->name = $data['name'];
        $table->price = $data['price'];
        $table->save();

        return true;


    }

    /**
     * Сервис изменения склада.
     * @param Product $product данные именяемого склада.
     * @param array $data валидированные данные, максимум 255 символов.
     * @return bool
     */
    public function update(array $data, Product $product):bool {

        $product->update($data);
        return true;


    }

    /**
     * Сервис удаления склада.
     * @param Product $product данные удаляемого склада.
     * @return bool
     */
    public function destroy(Product $product):bool{

        $product->delete();
        return true;
    }

}
