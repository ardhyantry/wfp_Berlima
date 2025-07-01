<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Ingredient;                  

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listMenu = Menu::with('category')->get();
        $ingredients = Ingredient::all(); 
        if (auth()->check() && auth()->user()->isAdmin()) {
            return view('admin.menus.index', compact('listMenu'));                      
        } else {
            return view('public.menus.index', compact('listMenu', 'ingredients'));
        }
    }
    public function indexPublic()
    {
        $categories = Category::all();
        $listMenu = [];

        foreach ($categories as $category) {
            $listMenu[$category->name] = Menu::where('categories_id', $category->id)
            ->with('category')
            ->limit(5)
            ->orderBy('name', 'asc')
            ->get();
        }

        return view('public.home', compact('listMenu', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.menus.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:50',
            'description'     => 'required|string|max:255',
            'nutrition_fact'  => 'nullable|string|max:255',
            'price'           => 'required|numeric',
            'stock'           => 'required|integer',
            'image_path'      => 'nullable|string|max:255',
            'categories_id'   => 'required|exists:categories,id',
        ]);

        Menu::create($validated);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $categories = Category::all();
        return view('admin.menus.edit', compact('menu', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:50',
            'description'     => 'required|string|max:255',
            'nutrition_fact'  => 'nullable|string|max:255',
            'price'           => 'required|numeric',
            'stock'           => 'required|integer',
            'image_path'      => 'nullable|string|max:255',
            'categories_id'   => 'required|exists:categories,id',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update($validated);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diupdate!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus!');
    }

    public function getImage($id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json(['error' => 'Menu not found'], 404);
        }
        return response()->json([
            'image_path' => $menu->image_path
        ]);
    }
    public function getEditForm(Request $request)
    {
        $menu = Menu::findOrFail($request->id);
        $categories = Category::all();
        if (!$menu) {
            return response()->json(['error' => 'Menu not found'], 404);
        }
        return response()->json([
            'msg' => view('admin.menus.getEditForm', compact('menu', 'categories'))->render()
        ]);
    }
    public function search(Request $request)
    {
        $query = $request->input('q');

        $listMenu = Menu::where('name', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();

        return view('public.menus.index', compact('listMenu'));
    }
    public function filter(Request $request)
{
    $ingredientIds = $request->input('ingredients', []);

    $listMenu = Menu::whereHas('ingredients', function ($query) use ($ingredientIds) {
        $query->whereIn('ingredients.id', $ingredientIds);
    })->with('category')->get();

    $ingredients = Ingredient::all();

    return view('public.menus.index', compact('listMenu', 'ingredients'));
}
}
