<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Type;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    //
    public function index(){
        //
        $actors = Type::latest()->paginate(10);

        return view('actors.index', compact('actors'));
    }

    public function show(Type $actor){
        //
        return view('actors.show', compact('actor'));
    }
}
