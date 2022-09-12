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

        // $series_id = $request->get('series_id');
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
        $series_id = $request->series_id;
        // dd($series_id);
        $categories = Category::all();
        $actors = Actor::all();
        return view('dashboard.seasons.create', compact('categories', 'actors','series_id'));
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
            'name' => 'required|string|max:50|min:1|unique:films',
            'no_episodes' => 'required|integer',
            'background_cover' => 'required|image',
        ]);

      
        $attributes['background_cover'] = $request->background_cover->store('season_background_covers');
        
        $season = Seasons::create([
            'name' => $attributes['name'],
            'series_id'=>$request->series_id,
            'no_episodes' => $attributes['no_episodes'],
            'background_cover' => $attributes['background_cover'],
        ]);

        session()->flash('success', 'Season Added Successfully');
        return redirect()->back();
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
        $series_id = $episodes->series_id;
        return view('dashboard.episodes.index', compact('episodes','series_id'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Seasons $season)
    {
        $episodes = Seasons::find($season->id);
        return view('dashboard.series.edit', compact('season','episodes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seasons $season)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:50', 'min:1', Rule::unique('seasons')->ignore($season)],
            'background_cover' => 'nullable|image',
            'no_episodes' => 'required|integer',
        ]);

        $season->update($attributes);
        if ($request->background_cover) {
            Storage::delete($season->getAttributes()['background_cover']);
            $attributes['background_cover'] = $request->background_cover->store('season_background_covers');
        }

        session()->flash('success', 'Seasons Updated Successfully');
        return redirect()->route('dashboard.seasons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Seasons::destroy($id)) {
            session()->flash('success', 'Season Deleted Successfully');
             return redirect()->route('dashboard.seasons.index');
          } else {
            session()->flash('alert', 'Season Was not Successfully Delted');
             return redirect()->route('dashboard.seasons.index');
          }
    }
}
