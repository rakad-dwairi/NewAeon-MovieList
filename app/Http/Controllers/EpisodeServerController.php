<?php

namespace App\Http\Controllers;

use App\Episode;
use App\EpisodeServer;
use App\Server;
use Illuminate\Http\Request;

class EpisodeServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $episodes = Episode::where(function ($query) use ($request) {
            $query->when($request->category, function ($q) use ($request) {
                return $q->whereHas('categories', function ($q2) use ($request) {
                    return $q2->whereIn('name', (array) $request->category);
                });
            });
        })->with('servers')->latest()->paginate(10);
        return view('showes.index', compact('episodes'));
    }

    public function show(EpisodeServer $episode)
    {
        return view('showes.show', compact('episode'));
    }
}
