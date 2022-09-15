<?php

namespace App\Http\Controllers;

use App\Series;
use App\Episode;
use App\Server;
use App\EpisodeServer;
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
                return $q->whereHas('categories', function ($q2) use ($request) {
                    return $q2->whereIn('name', (array) $request->category);
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
    public function show(Series $serie)
    {
        $servers = Episode::where('series_id', '=', $serie->id)->get();
        $availableServers = Server::all();
        return view('showes.show', compact('serie', 'servers', 'availableServers'));
    }

    public function episodeshow(Episode $episode)
    {
        // dd($episode);
        $servers = EpisodeServer::where('episode_id', '=', $episode->id)->get();
        $availableServers = Server::all();
        return view('showes.view', compact('episode', 'availableServers', 'servers'));
    }

    public function setEmpdUrl(Request $request)
    {
        $server = EpisodeServer::where('episode_id', $request->episode_id)->where('server_id', $request->server_id)->first();
        $url = '';
        if (!empty($server)) {
            $url = $server->embed_url;
        }
        return $url;
    }
}
