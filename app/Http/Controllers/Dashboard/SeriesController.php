<?php

namespace App\Http\Controllers\Dashboard;

use App\Actor;
use App\Category;
use App\Series;
use App\Server;
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
            'name' => 'required|string|max:50|min:1|unique:series',
            'seasons'=>'required|numeric',
            'year' => 'required|string|max:4|min:4',
            'overview' => 'required|string',
            'background_cover' => 'required|image',
            'poster' => 'required|image',
            'categories' => 'required|array|max:3|exists:categories,id',
            'actors' => 'required|array|max:10|exists:actors,id'
        ]);

       

        $img = $request->background_cover->store('public/series_background_covers');
        $img1 = $request->poster->store('public/series_posters');
        $attributes['background_cover'] = str_replace('public/','',$img);
        $attributes['poster'] = str_replace('public/','',$img1);

        $film = Series::create([
            'name' => $attributes['name'],
            'year' => $attributes['year'],
            'seasons'=>$attributes['seasons'],
            'overview' => $attributes['overview'],
            'series_id'=>$request->series_id,
            'background_cover' => $attributes['background_cover'],
            'poster' => $attributes['poster'],

        ]);
        $film->categories()->sync($attributes['categories']);
        $film->actors()->sync($attributes['actors']);

        session()->flash('success', 'Serie Added Successfully');
        return redirect()->route('dashboard.series.index');
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
        return view('dashboard.seasons.index', compact('seasons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Series $serie)
    {
        $serie = Series::find($id);
        $categories = Category::all();
        $actors = Actor::all();
        return view('dashboard.series.edit', compact('categories', 'actors','serie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Series $serie)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:50', 'min:1', Rule::unique('series')->ignore($serie)],
            'year' => 'required|string|max:4|min:4',
            'overview' => 'required|string',
            'background_cover' => 'nullable|image',
            'poster' => 'nullable|image',
            'categories' => 'required|array|max:3|exists:categories,id',
            'servers' => 'required|array|max:3|exists:servers,id',
            'actors' => 'required|array|max:10|exists:actors,id'
        ]);

        if ($request->background_cover) {
            Storage::delete($serie->getAttributes()['background_cover']);
            $attributes['background_cover'] = $request->background_cover->store('serie_background_covers');
        }
        if ($request->poster) {
            Storage::delete($serie->getAttributes()['poster']);
            $attributes['poster'] = $request->poster->store('serie_posters');
        }

        $serie->update($attributes);
        $serie->categories()->sync($attributes['categories']);
        $serie->servers()->sync($attributes['servers']);
        $serie->actors()->sync($attributes['actors']);

        session()->flash('success', 'Serie Updated Successfully');
        return redirect()->route('dashboard.series.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($serie)
    {
        if(Series::destroy($serie)) {
            session()->flash('success', 'Serie Deleted Successfully');
             return redirect()->route('dashboard.series.index');
          } else {
            session()->flash('alert', 'Serie Was not Successfully Delted');
             return redirect()->route('dashboard.series.index');
          }
    }
}
