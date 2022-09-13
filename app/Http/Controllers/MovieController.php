<?php

namespace App\Http\Controllers;
use App\Server;
use App\FilmServer;
use App\Film;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    //
    public function index(Request $request){
        $films = Film::where(function ($query) use ($request) {
            $query->when($request->category, function ($q) use ($request) {
                return $q->whereHas('categories', function ($q2) use ($request){
                    return $q2->whereIn('name', (array)$request->category);
                });
            });
        })->with('servers')->latest()->paginate(10);
        // $servers = Server::all();
        return view('movies.index', compact('films'));
    }

    public function show(Film $film){       
        $servers = FilmServer::where('film_id', '=',$film->id )->get();
        $availableServers = Server::all();
        // dd($servers[0]->id,$servers);
        $reviews = $film->reviews()->latest()->paginate(10);
        return view('movies.show', compact('film', 'reviews','servers','availableServers'));
    }

    public function setEmpdUrl(Request $request) {
        $server = FilmServer::where('film_id',$request->film_id)->where('server_id',$request->server_id)->first();
        $url = '';
        if(!empty($server)) {
            $url = $server->embed_url;
        }
        return $url;
    }


}
