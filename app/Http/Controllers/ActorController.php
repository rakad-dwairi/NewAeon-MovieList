<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Film;
use App\Type;
use App\FilmType;
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
        // dd($actor->id);
        $films = Film::with('type')->where('id','=',$actor->id)->get();
        // $filmtype = FilmType::with('films')->find('id','=',$actor->id)->get();
        $fi = Film::select([
                'films.*',
                'film_type.*',
                'type.id as type_id',
                'type.name as type_name',
                'type.arname as type_arname',
            ])
            ->leftJoin('film_type','film_type.film_id','films.id')
            ->leftJoin('type','type.id','film_type.type_id')
            ->where('type.id',$actor->id)
            ->get();
       
        // $seasons = FilmType::with('films')->find($actor->id);
        // dd($fi);
        
        // $films = Film::where('id');

        return view('actors.show', compact('films','actor'));
    }
}
