<?php

namespace App\Http\Controllers;
use App\Series;
use App\Episode;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $series = Series::where(function ($query) use ($request) {
            $query->when($request->category, function ($q) use ($request) {
                return $q->whereHas('categories', function ($q2) use ($request){
                    return $q2->whereIn('name', (array)$request->category);
                });
            });
        })->latest()->paginate(10);
        // $servers = Server::all();
        return view('showes.index', compact('series'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Series $serie){
        // dd($serie->id);

        $episodes = Episode::where('series_id','=',$serie->id)->get();
        // dd($episodes[0]->name);
        // $servers = FilmServer::where('film_id', '=',$film->id )->get();
        // $availableServers = Server::all();
        // dd($servers[0]->id,$servers);
        // $reviews = $film->reviews()->latest()->paginate(10);
        return view('showes.show', compact('serie','episodes'));
    }

    public function episodeshow(Episode $episode)
    {
        // dd($episode);
        return view('showes.view', compact('episode'));
    }




}
