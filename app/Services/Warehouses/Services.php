<?php

namespace App\Services\Warehouses;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Collection;

class Services
{
    /**
     * Сервис получения всех складов
     * @return Collection
     */
    public function index(): Collection
    {
        return Warehouse::all();
    }

    /**
     * Сервис добавления склада.
     * @param array $data валидированные данные, максимум 255 символов.
     * @return bool
     */

    public function store(array $data): bool
    {
        Warehouse::firstOrCreate($data);
        return true;
    }


    /**
     * Сервис изменения склада.
     * @param Warehouse $warehouse данные именяемого склада.
     * @param array $data валидированные данные, максимум 255 символов.
     * @return bool
     */
    public function update(array $data, Warehouse $warehouse): bool
    {
        $warehouse->update($data);
        return true;
    }

    /**
     * Сервис удаления склада.
     * @param Warehouse $warehouse данные удаляемого склада.
     * @return bool
     */
    public function destroy(Warehouse $warehouse): bool
    {
        $warehouse->delete();
        return true;
    }


}
