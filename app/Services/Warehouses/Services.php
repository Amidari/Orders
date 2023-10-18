<?php

namespace App\Services\Warehouses;

use App\Models\Warehous;
use Exception;

class Services
{

    public function index() {

        return Warehous::all();
    }

    /**
     * Сервис добавления склада.
     * @param array $data валидированные данные, максимум 255 символов.
     * @return bool
     * @throws Exception
     */

    public function store(array $data):bool {

        $table = new Warehous;
        $table->name = $data['name'];
        $table->save();

        return true;


    }


    /**
     * Сервис изменения склада.
     * @param Warehous $warehouse данные именяемого склада.
     * @param array $data валидированные данные, максимум 255 символов.
     * @return bool
     */
    public function update(array $data, Warehous $warehouse):bool {

        $warehouse->update($data);
        return true;

    }
    /**
     * Сервис удаления склада.
     * @param Warehous $warehouse данные удаляемого склада.
     * @return bool
     */
    public function destroy(Warehous $warehouse):bool{
        $warehouse->delete();
        return true;
    }


}
