<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Checklist;
use App\Models\ChecklistGroup;
use App\Services\MenuService;
use Carbon\Carbon;

class MenuComposer
{
    /**
     * Bind data to the view
     * 
     * @param  \Illuminate\View\View $view
     * @return void
     * 
     */
    public function compose(View $view)
    {

        $menu = (new MenuService())->get_menu();
        $view->with('admin_menu', $menu['admin_menu']);
        $view->with('user_menu', $menu['user_menu']);
        $view->with('user_taches_menu', $menu['user_taches_menu']);
        
    }
}