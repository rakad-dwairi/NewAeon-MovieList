<?php

namespace App\Http\Controllers\Dashboard;

use App\Actor;
use App\Category;
use App\Type;
use App\Server;
use App\FilmServer;
use App\Film;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class FilmController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:create_films,guard:admin'])->only(['create', 'store']);
        $this->middleware(['permission:read_films,guard:admin'])->only('index');
        $this->middleware(['permission:update_films,guard:admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_films,guard:admin'])->only('destroy');
    }

    public function index(Request $request)
    {
        $films = Film::where(function ($query) use ($request) {
            $query->when($request->search, function ($q) use ($request) {
                return $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('year', 'like', '%' . $request->search . '%');
            });
            $query->when($request->category, function ($q) use ($request) {
                return $q->whereHas('categories', function ($q2) use ($request) {
                    return $q2->whereIn('category_id', (array) $request->category)
                        ->orWhereIn('name', (array) $request->category);
                });
            });

            $query->when($request->type, function ($q) use ($request) {
                return $q->whereHas('type', function ($q2) use ($request) {
                    return $q2->whereIn('type_id', (array) $request->type)
                        ->orWhereIn('name', (array) $request->type);
                });
            });

            $query->when($request->favorite, function ($q) use ($request) {
                return $q->whereHas('favorites', function ($q2) use ($request) {
                    return $q2->whereIn('user_id', (array) $request->favorite);
                });
            });
        })->with('categories')->with('type')->with('ratings')->with('servers')->latest()->paginate(10);
        $categories = Category::all();
        $types = Type::all();
        $servers = Server::all();


        return view('dashboard.films.index', compact('films', 'categories','types', 'servers'));
    }

    public function create()
    {
        $categories = Category::all();
        $types = Type::all();
        $servers = Server::all();
        return view('dashboard.films.create', compact('categories','types','servers'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|string|max:50|min:1|unique:films',
            'arname' => 'required|string|max:50|min:1|unique:films',
            'year' => 'required|string|max:4|min:4',
            'overview' => 'required|string',
            'background_cover' => 'required|image',
            'poster' => 'required|image',
            'url' => 'required|string',
            'api_url' => 'required|string',
            'categories' => 'required|array|max:3|exists:categories,id',
            'type' => 'required|array|max:3|exists:type,id',
        ]);

        $img = $request->background_cover->store('public/film_background_covers');
        $img1 = $request->poster->store('public/film_posters');
        $attributes['background_cover'] = str_replace('public/', '', $img);
        $attributes['poster'] = str_replace('public/', '', $img1);

        $film = Film::create([
            'name' => $attributes['name'],
            'arname' => $attributes['arname'],
            'year' => $attributes['year'],
            'overview' => $attributes['overview'],
            'background_cover' => $attributes['background_cover'],
            'poster' => $attributes['poster'],
            'url' => $attributes['url'],
            'api_url' => $attributes['api_url'],
        ]);

        foreach ($request->server_url as $server => $key) {
            FilmServer::updateOrCreate([
                'film_id' => $film->id,
                'server_id' => $server
            ], [
                'film_id' => $film->id,
                'embed_url' => $key,
                'server_id' => $server
            ]);
        }

        $film->categories()->sync($attributes['categories']);
        $film->type()->sync($attributes['type']);

        session()->flash('success', 'Film Added Successfully');
        return redirect()->route('dashboard.films.index');
    }

    public function show(Film $film)
    {
        //
    }

    public function edit(Film $film)
    {
        $categories = Category::all();
        $types = Type::all();
        $servers = Film::select('film_server.embed_url', 'servers.name', 'servers.id as id')
            ->leftJoin('film_server', 'film_server.film_id', 'films.id')
            ->leftJoin('servers', 'film_server.server_id', 'servers.id')
            ->where('film_server.film_id', $film->id)
            ->groupBy('film_server.server_id')->get();
        return view('dashboard.films.edit', compact('film', 'categories','types','servers'));
    }

    public function update(Request $request, Film $film)
    {

        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:50', 'min:1', Rule::unique('films')->ignore($film)],
            'arname' => ['required', 'string', 'max:50', 'min:1', Rule::unique('films')->ignore($film)],
            'year' => 'required|string|max:4|min:4',
            'overview' => 'required|string',
            'background_cover' => 'nullable|image',
            'poster' => 'nullable|image',
            'url' => 'required|string',
            'api_url' => 'required|string',
            'categories' => 'required|array|max:3|exists:categories,id',
            'type' => 'required|array|max:3|exists:type,id',
        ]);

        if ($request->background_cover) {
            Storage::delete($film->getAttributes()['background_cover']);
            $attributes['background_cover'] = $request->background_cover->store('film_background_covers');
        }
        if ($request->poster) {
            Storage::delete($film->getAttributes()['poster']);
            $attributes['poster'] = $request->poster->store('film_posters');
        }

        $film->update($attributes);
        foreach ($request->server_url as $server => $key) {
            FilmServer::updateOrCreate([
                'film_id' => $film->id,
                'server_id' => $server
            ], [
                'film_id' => $film->id,
                'embed_url' => $key,
                'server_id' => $server
            ]);
        }
        $film->categories()->sync($attributes['categories']);
        $film->type()->sync($attributes['type']);

        session()->flash('success', 'Film Updated Successfully');
        return redirect()->route('dashboard.films.index');
    }

    public function destroy(Film $film)
    {
        $film->delete();
        session()->flash('success', 'Film Deleted Successfully');
        return redirect()->route('dashboard.films.index');
    }
}
