<?php

namespace App\Services\Stock;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Collection;

class Services
{

    public function index():Collection
    {
        return Stock::all();
    }

    /**
     * Сервис добавления склада.
     * @param array $data валидированные данные, максимум 255 символов.
     * @return bool
     */

    public function store(array $data):bool {

        Stock::firstOrCreate($data);

        return true;


    }

    /**
     * Сервис изменения склада.
     * @param Stock $stock данные именяемого склада.
     * @param array $data валидированные данные, максимум 255 символов.
     * @return bool
     */
    public function update(array $data, Stock $stock):bool {

        $stock->update($data);
        return true;


    }

    /**
     * Сервис удаления склада.
     * @param Stock $stock данные удаляемого склада.
     * @return bool
     */
    public function destroy(Stock $stock):bool{

        $stock->delete();
        return true;
    }

}
