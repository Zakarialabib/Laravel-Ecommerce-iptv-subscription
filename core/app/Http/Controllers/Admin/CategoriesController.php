<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
        ]);

        $category = new Category([
            'name'     => $request->input('name'),
        ]);
    
        $category->save();

        return redirect()->back()->with("status", "Category Created!");
    }
}
