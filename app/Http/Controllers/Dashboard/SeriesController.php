<?php

namespace App\Http\Controllers\Dashboard;

use App\Actor;
use App\Category;
use App\Series;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SeriesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:create_series,guard:admin'])->only(['create', 'store']);
        $this->middleware(['permission:read_series,guard:admin'])->only('index');
        $this->middleware(['permission:update_series,guard:admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_series,guard:admin'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $series = Series::where(function ($query) use ($request) {
            $query->when($request->search, function ($q) use ($request) {
                return $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('year', 'like', '%' . $request->search . '%');
            });
            $query->when($request->category, function ($q) use ($request) {
                return $q->whereHas('categories', function ($q2) use ($request){
                    return $q2->whereIn('category_id', (array)$request->category)
                        ->orWhereIn('name', (array)$request->category);
                });
            });
            $query->when($request->actor, function ($q) use ($request) {
                return $q->whereHas('actors', function ($q2) use ($request){
                    return $q2->whereIn('actor_id', (array)$request->actor)
                        ->orWhereIn('name', (array)$request->actor);
                });
            });
            $query->when($request->favorite, function ($q) use ($request) {
                return $q->whereHas('favorites', function ($q2) use ($request){
                    return $q2->whereIn('user_id', (array)$request->favorite);
                });
            });
        })->with('categories')->with('ratings')->latest()->paginate(10);
        $categories = Category::all();
        $actors = Actor::all();

        return view('dashboard.series.index', compact('series', 'categories', 'actors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $actors = Actor::all();
        return view('dashboard.series.create', compact('categories', 'actors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $attributes = $request->validate([
            'name' => 'required|string|max:50|min:1|unique:films',
            'seasons'=>'required|numeric',
            'year' => 'required|string|max:4|min:4',
            'overview' => 'required|string',
            'background_cover' => 'required|image',
            'poster' => 'required|image',
            'categories' => 'required|array|max:3|exists:categories,id',
            'actors' => 'required|array|max:10|exists:actors,id'
        ]);

        $attributes['background_cover'] = $request->background_cover->store('film_background_covers');
        $attributes['poster'] = $request->poster->store('series_posters');

        $film = Series::create([
            'name' => $attributes['name'],
            'year' => $attributes['year'],
            'seasons'=>$attributes['seasons'],
            'overview' => $attributes['overview'],
            'background_cover' => $attributes['background_cover'],
            'poster' => $attributes['poster'],

        ]);
        $film->categories()->sync($attributes['categories']);
        $film->actors()->sync($attributes['actors']);

        session()->flash('success', 'Serie Added Successfully');
        return redirect()->route('dashboard.films.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seasons = Series::with('seasons2')->find($id);
        // dd($seasons); 
        return view('dashboard.seasons.index', compact('seasons'));
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
