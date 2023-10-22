<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class Services
{

    public function index():Collection
    {
        return Product::all();
    }

    /**
     * Сервис добавления склада.
     * @param array $data валидированные данные, максимум 255 символов.
     * @return bool
     */

    public function store(array $data):bool {

        Product::firstOrCreate([
            'name' => $data['name']
        ], $data);

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
    public function destroy(Product $product):void
    {
        $product->delete();

    }

}
