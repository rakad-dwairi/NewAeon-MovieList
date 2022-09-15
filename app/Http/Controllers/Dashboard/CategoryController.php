<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:create_categories,guard:admin'])->only(['create', 'store']);
        $this->middleware(['permission:read_categories,guard:admin'])->only('index');
        $this->middleware(['permission:update_categories,guard:admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_categories,guard:admin'])->only('destroy');
    }

    public function index(Request $request)
    {
        //
        $categories = Category::where(function ($query) use ($request) {
            $query->when($request->search, function ($q) use ($request) {
                return $q->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(10);

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        //
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        //
        $attributes = $request->validate([
            'name' => 'required|string|unique:categories'
        ]);

        $category = Category::create([
            'name' => $attributes['name'],
        ]);

        session()->flash('success', 'Category Added Successfully');
        return redirect()->route('dashboard.categories.index');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', Rule::unique('categories')->ignore($category)]
        ]);

        $category->update($attributes);

        session()->flash('success', 'Category Updated Successfully');
        return redirect()->route('dashboard.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        session()->flash('success', 'Category Deleted Successfully');
        return redirect()->route('dashboard.categories.index');
    }
}
