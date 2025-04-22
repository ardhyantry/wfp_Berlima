<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    //

    public function index()
    {
        $menus = Menu::with('category')->latest()->paginate(10);

        $report = [
            'total' => Menu::count(),
            'categories' => Category::count(),
            'most_expensive' => Menu::orderByDesc('price')->first(),
            'cheapest' => Menu::orderBy('price')->first(),
            'average_price' => Menu::avg('price'),
        ];


        return view('admin.index', compact('menus', 'report'));
    } 
}
