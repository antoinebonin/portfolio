<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

class MenuRepository
{
    public static function getNavbar(): Collection
    {
        return Menu::where('parent_id', '=', -1)->with(['children.page', 'page'])->get();
    }
}
