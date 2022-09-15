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
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class SeasonsController extends Controller
{
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

        return view('dashboard.seasons.index', compact('admins', 'clients', 'films', 'ratings', 'reviews', 'messages', 'series', 'seasons'));
    }

    public function create(Request $request)
    {
        $series_id = $request->series_id;
        $categories = Category::all();
        $actors = Actor::all();
        return view('dashboard.seasons.create', compact('categories', 'actors', 'series_id'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|string|max:50|min:1|unique:films',
            'no_episodes' => 'required|integer',
            'background_cover' => 'required|image',
        ]);

        $img = $request->background_cover->store('public/season_background_covers');
        $attributes['background_cover'] = str_replace('public/', '', $img);

        $season = Seasons::create([
            'name' => $attributes['name'],
            'series_id' => $request->series_id,
            'no_episodes' => $attributes['no_episodes'],
            'background_cover' => $attributes['background_cover'],
        ]);

        session()->flash('success', 'Season Added Successfully');
        return redirect()->back();
    }

    public function show($id)
    {
        $episodes = Seasons::with('episodes2')->find($id);
        $series_id = $episodes->series_id;
        return view('dashboard.episodes.index', compact('episodes', 'series_id'));
    }

    public function edit(Seasons $season)
    {
        $episodes = Seasons::find($season->id);
        $series_id = $episodes->series_id;
        return view('dashboard.seasons.edit', compact('season', 'episodes', 'series_id'));
    }

    public function update(Request $request, Seasons $season)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:50', 'min:1', Rule::unique('seasons')->ignore($season)],
            'no_episodes' => 'required|integer',
            'background_cover' => 'nullable|image',
        ]);

        Seasons::where('id', $request->season->id)->update([
            'name' => $request->input('name'),
            'no_episodes' => $request->input('no_episodes'),
            'background_cover' => $request->background_cover,
        ]);

        if ($request->background_cover) {
            Storage::delete($season->getAttributes()['background_cover']);
            $attributes['background_cover'] = $request->background_cover->store('season_background_covers');
        }

        session()->flash('success', 'Seasons Updated Successfully');
        return redirect()->route('dashboard.series.index');
    }


    public function destroy($id)
    {
        if (Seasons::destroy($id)) {
            session()->flash('success', 'Season Deleted Successfully');
            return redirect()->back();
        } else {
            session()->flash('alert', 'Season Was not Successfully Delted');
            return redirect()->back();
        }
    }
}
