<?php

namespace App\Http\Controllers\Stock;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Collection;

class IndexController extends BaseController
{
    public function __invoke():Collection
    {
        return Stock::all();
    }
}
