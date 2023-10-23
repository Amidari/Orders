<?php

namespace App\Services\Warehouses;

use App\Models\Warehous;
use Illuminate\Database\Eloquent\Collection;

class Services
{
    /**
     * Сервис получения всех складов
     * @return Collection
     */
    public function index(): Collection
    {
        return Warehous::all();
    }

    /**
     * Сервис добавления склада.
     * @param array $data валидированные данные, максимум 255 символов.
     * @return bool
     */

    public function store(array $data): bool
    {
        Warehous::firstOrCreate($data);
        return true;
    }


    /**
     * Сервис изменения склада.
     * @param Warehous $warehouse данные именяемого склада.
     * @param array $data валидированные данные, максимум 255 символов.
     * @return bool
     */
    public function update(array $data, Warehous $warehouse): bool
    {
        $warehouse->update($data);
        return true;
    }

    /**
     * Сервис удаления склада.
     * @param Warehous $warehouse данные удаляемого склада.
     * @return bool
     */
    public function destroy(Warehous $warehouse): bool
    {
        $warehouse->delete();
        return true;
    }


}
