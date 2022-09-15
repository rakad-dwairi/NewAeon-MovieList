<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index(Request $request)
    {
        //
        $messages = Message::where(function ($query) use ($request) {
                $query->when($request->search, function ($q) use ($request) {
                    return $q->where('email', 'like', '%' . $request->search . '%')
                        ->orWhere('title', 'like', '%' . $request->search . '%');
                });
            })
            ->latest()->paginate(10);

        return view('dashboard.messages.index', compact('messages'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Message $message)
    {
        //
    }

    public function edit(Message $message)
    {
        //
    }

    public function update(Request $request, Message $message)
    {
        //
    }

    public function destroy(Message $message)
    {
        $message->delete();

        session()->flash('success', 'Message Deleted Successfully');
        return redirect()->route('dashboard.messages.index');
    }
}
