<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Category;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //eloquent
        $listMenu = Menu::all();

        return view('admin.menus.index', compact('listMenu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($menu)
    {
        //eloquent
        $menu = Menu::find($menu);
        return view('admin.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = Menu::findOrFail($id);
        $categories = Category::all(); // untuk select kategori
        return view('admin.menus.edit', compact('menu', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'categories_id' => 'required',
        ]);

        $data = $request->only('name', 'description', 'nutrition_fact', 'price', 'stock', 'categories_id');

        // Update gambar jika ada
        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('menus', 'public');
        }

        $menu->update($data);

        return redirect()->route('menus.index')->with('successUp', 'Menu berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);

        // Jika relasi pivot -> detach ingredient-nya dulu
        $menu->ingredients()->detach();

        // Lalu hapus menu-nya
        $menu->delete();

        return redirect()->route('menus.index')->with('successDel', 'Menu berhasil dihapus.');
    }
}
