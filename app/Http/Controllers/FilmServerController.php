<?php

namespace App\Http\Controllers;

use App\Server;
use App\FilmServer;
use App\Film;
use Illuminate\Http\Request;

class FilmServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $films = Film::where(function ($query) use ($request) {
            $query->when($request->category, function ($q) use ($request) {
                return $q->whereHas('categories', function ($q2) use ($request) {
                    return $q2->whereIn('name', (array) $request->category);
                });
            });
        })->with('servers')->latest()->paginate(10);
        return view('movies.index', compact('films'));
    }

    public function show(FilmServer $film)
    {
        $reviews = $film->latest()->paginate(10);
        return view('movies.show', compact('film', 'reviews'));
    }
}
