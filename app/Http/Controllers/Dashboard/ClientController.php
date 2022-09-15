<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:create_clients,guard:admin'])->only(['create', 'store']);
        $this->middleware(['permission:read_clients,guard:admin'])->only('index');
        $this->middleware(['permission:update_clients,guard:admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_clients,guard:admin'])->only('destroy');
    }

    public function index(Request $request)
    {
        $clients = User::where(function ($query) use ($request) {
            $query->when($request->search, function ($q) use ($request) {
                return $q->where('username', 'like', '%' . $request->search . '%')
                    ->orWhere('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(10);

        return view('dashboard.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('dashboard.clients.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'username' => 'required|string|max:20|min:3',
            'email' => 'required|string|email|unique:users',
            'first_name' => 'required|string|max:15|min:3',
            'last_name' => 'required|string|max:15|min:3',
            'avatar' => 'image',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($request->avatar) {
            $attributes['avatar'] = $request->avatar->store('client_avatars');
        }

        $result = User::create([
            'username' => $attributes['username'],
            'email' => $attributes['email'],
            'first_name' => $attributes['first_name'],
            'last_name' => $attributes['last_name'],
            'avatar' => $attributes['avatar'] ?? NULL,
            'password' => bcrypt($attributes['password']),
        ]);

        session()->flash('success', 'Client Added Successfully');
        return redirect()->route('dashboard.clients.index');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $client)
    {
        //
        return view('dashboard.clients.edit', compact('client'));
    }

    public function update(Request $request, User $client)
    {
        //
        $attributes = $request->validate([
            'username' => 'required|string|max:20|min:3',
            'email' => ['required', 'string', 'email', Rule::unique('users')->ignore($client)],
            'first_name' => 'required|string|max:15|min:3',
            'last_name' => 'required|string|max:15|min:3',
            'avatar' => 'image',
            'password' => 'nullable|string|confirmed|min:6',
        ]);

        if ($request->avatar) {
            $clientAvatar = $client->getAttributes()['avatar'];
            if (isset($clientAvatar) && $clientAvatar) {
                Storage::delete($clientAvatar);
            }

            $attributes['avatar'] = $request->avatar->store('client_avatars');
        }
        if ($request->password) {
            $attributes['password'] = bcrypt($attributes['password']);
        } else {
            unset($attributes['password']);
        }

        $client->update($attributes);

        session()->flash('success', 'Client Updated Successfully');
        return redirect()->route('dashboard.clients.index');
    }

    public function destroy(User $client)
    {
        $client->delete();

        session()->flash('success', 'Client Deleted Successfully');
        return redirect()->route('dashboard.clients.index');
    }
}
