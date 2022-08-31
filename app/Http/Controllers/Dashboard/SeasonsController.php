<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actor;
use App\Series;
use App\Admin;
use App\Category;
use App\Film;
use App\Message;
use App\Rating;
use App\Review;
use App\User;
use App\Seasons;


class SeasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $seasons = Seasons::where(function ($query) use ($request) {
            $query->when($request->search, function ($q) use ($request) {
                return $q->where('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(10);

        
        $admins = Admin::whereRoleIs('admin')->count();
        $clients = User::count();
        $films = Film::count();
        $ratings = Rating::count();
        $reviews = Review::count();
        $messages = Message::count();
        $series = Series::count();

        return view('dashboard.seasons.index', compact('admins', 'clients', 'films', 'ratings', 'reviews', 'messages','series','seasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request);
        $categories = Category::all();
        $actors = Actor::all();
        return view('dashboard.seasons.create', compact('categories', 'actors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $attributes = $request->validate([
            'name' => 'required|string|max:50|min:1|unique:films',
            'series_id' => 'required|integer',
            'no_episodes' => 'required|integer',
            'background_cover' => 'required|image',
            'categories' => 'required|array|max:3|exists:categories,id',
            'actors' => 'required|array|max:10|exists:actors,id'
        ]);
        dd($attributes);
        $test = Series::with('series')->find($request->series_id);

      
        $attributes['background_cover'] = $request->background_cover->store('series_background_covers');
        
        $season = Seasons::create([
            'name' => $attributes['name'],
            'series_id'=>$test,
            'no_episodes' => $attributes['no_episodes'],
            'background_cover' => $attributes['background_cover'],
        ]);
        
        $season->categories()->sync($attributes['categories']);
        $season->actors()->sync($attributes['actors']);

        session()->flash('success', 'Season Added Successfully');
        return redirect()->route('dashboard.seasons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $episodes = Seasons::with('episodes2')->find($id);
        // dd($episodes); 
        return view('dashboard.episodes.index', compact('episodes'));
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
