<?php

namespace App\Http\Controllers\Dashboard;

use App\Actor;
use App\Episode;
use App\Category;
use App\Film;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EpisodesController extends Controller
{


    public function __construct()
    {
        $this->middleware(['permission:create_episodes,guard:admin'])->only(['create', 'store']);
        $this->middleware(['permission:read_episodes,guard:admin'])->only('index');
        $this->middleware(['permission:update_episodes,guard:admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_episodes,guard:admin'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         //
         $episodes = Episode::where(function ($query) use ($request) {
            $query->when($request->search, function ($q) use ($request) {
                return $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('year', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(10);
         $categories = Category::all();
         $actors = Actor::all();

        return view('dashboard.episodes.index', compact('episodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $series_id = $request->series_id;
        $seasons_id = $request->seasons_id;
        $categories = Category::all();
        $actors = Actor::all();
        $episodes = Episode::all();
        return view('dashboard.episodes.create', compact('categories', 'actors','episodes','series_id','seasons_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $attributes = $request->validate([
            'name' => 'required|string|max:50|min:1|unique:episodes',
            'year' => 'required|string|max:4|min:4',
            'overview' => 'required|string',
            'background_cover' => 'required|image',
            'poster' => 'required|image',
            'url' => 'required|string',
            'api_url' => 'required|string',
            'categories' => 'required|array|max:3|exists:categories,id',
            'actors' => 'required|array|max:10|exists:actors,id'
        ]);

        $img = $request->background_cover->store('public/episode_background_covers');
        $img1 = $request->poster->store('public/episode_posters');
        $attributes['background_cover'] = str_replace('public/','',$img);
        $attributes['poster'] = str_replace('public/','',$img1);

        $episode = Episode::create([
            'name' => $attributes['name'],
            'year' => $attributes['year'],
            'overview' => $attributes['overview'],
            'series_id'=>$request->series_id,
            'seasons_id'=>$request->seasons_id,
            'background_cover' => $attributes['background_cover'],
            'poster' => $attributes['poster'],
            'url' => $attributes['url'],
            'api_url' => $attributes['api_url'],
        ]);
        
        // foreach($request->server_url as $server => $key) {
        //     // dd($request->server_url);
        //     FilmServer::updateOrCreate([
        //         'film_id' => $film->id,
        //         'server_id' => $server                
        //     ],[
        //         'film_id' => $film->id,
        //         'embed_url' => $key,
        //         'server_id' => $server
        //     ]);
        // }

        $episode->categories()->sync($attributes['categories']);


        // $film->servers()->sync($attributes['embed_url']);
        $episode->actors()->sync($attributes['actors']);

        session()->flash('success', 'Episode Added Successfully');
        return redirect()->route('dashboard.episodes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
