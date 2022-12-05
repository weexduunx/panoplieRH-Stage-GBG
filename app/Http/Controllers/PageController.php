<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function welcome()
    {
        $page = Page::findOrFail(1); //Page d'accueil

        return view ('page', compact('page'));
    }

    public function consultation()
    {
        $page = Page::findOrFail(2); //Page consultation

        return view ('page', compact('page'));
    }
}
