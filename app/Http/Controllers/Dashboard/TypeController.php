<?php

namespace App\Http\Controllers\Dashboard;

use App\Type;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class TypeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['permission:create_type,guard:admin'])->only(['create', 'store']);
        $this->middleware(['permission:read_type,guard:admin'])->only('index');
        $this->middleware(['permission:update_type,guard:admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_type,guard:admin'])->only('destroy');
    }

    public function index(Request $request)
    {
        //
        $types = Type::where(function ($query) use ($request) {
            $query->when($request->search, function ($q) use ($request) {
                return $q->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(10);

        return view('dashboard.types.index', compact('types'));
    }

    public function create()
    {
        //
        return view('dashboard.types.create');
    }

    public function store(Request $request)
    {
        //
        $attributes = $request->validate([
            'name' => 'required|string|unique:type',
            'arname' => 'required|string|unique:type'
        ]);

        $types = Type::create([
            'name' => $attributes['name'],
            'arname' => $attributes['arname'],
        ]);

        session()->flash('success', 'Type Added Successfully');
        return redirect()->route('dashboard.types.index');
    }

    public function show(Type $category)
    {
        //
    }

    public function edit(Type $type)
    {
        return view('dashboard.types.edit', compact('type'));
    }

    public function update(Request $request, Type $type)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', Rule::unique('type')->ignore($type)],
            'arname' => ['required', 'string', Rule::unique('type')->ignore($type)]
        ]);

        $type->update($attributes);

        session()->flash('success', 'Type Updated Successfully');
        return redirect()->route('dashboard.categories.index');
    }

    public function destroy(Type $type)
    {
        $type->delete();

        session()->flash('success', 'Type Deleted Successfully');
        return redirect()->route('dashboard.types.index');
    }
}
