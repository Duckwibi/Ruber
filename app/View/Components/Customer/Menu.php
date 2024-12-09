<?php

namespace App\View\Components\Customer;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component{

    public $menusLv1;
    public $menusLv2;
    public $menusLv3;
    public function __construct(){
    }

    public function render(): mixed{

        $menus = \App\Models\Menu::orderBy("order")->get();

        $this->menusLv1 = $menus->reject(fn(\App\Models\Menu $menu): bool => $menu->level != 1);
        $this->menusLv2 = $menus->reject(fn(\App\Models\Menu $menu): bool => $menu->level != 2);
        $this->menusLv3 = $menus->reject(fn(\App\Models\Menu $menu): bool => $menu->level != 3);

        return view("components.customer.menu");
    }
}
