<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Server;
use Illuminate\Http\Request;

class ServersController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:create_servers,guard:admin'])->only(['create', 'store']);
        $this->middleware(['permission:read_servers,guard:admin'])->only('index');
        $this->middleware(['permission:update_servers,guard:admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_servers,guard:admin'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $servers = Server::where(function ($query) use ($request) {
            $query->when($request->search, function ($q) use ($request) {
                return $q->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(10);

        return view('dashboard.servers.index', compact('servers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.servers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $attributes = $request->validate([
            'name' => 'required|string|unique:servers'
        ]);

        $server = Server::create([
            'name' => $attributes['name'],
        ]);

        session()->flash('success', 'Server Added Successfully');
        return redirect()->route('dashboard.servers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Server $server)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Server $server)
    {
        //
        return view('dashboard.servers.edit', compact('server'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Server $server)
    {
        //
        $attributes = $request->validate([
            'name' => ['required', 'string', Rule::unique('servers')->ignore($server)]
        ]);

        $server->update($attributes);

        session()->flash('success', 'Server Updated Successfully');
        return redirect()->route('dashboard.servers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Server $server)
    {
        //
        $server->delete();

        session()->flash('success', 'Server Deleted Successfully');
        return redirect()->route('dashboard.servers.index');
    }
}
