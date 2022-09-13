<?php

namespace App\Http\Controllers\Dashboard;

use App\Actor;
use App\Episode;
use App\Server;
use App\EpisodeServer;
use App\Category;
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
        })->with('servers')->latest()->paginate(10);
        $servers = Server::all();


        return view('dashboard.episodes.index', compact('episodes','servers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request);
        $series_id = $request->series_id;
        $seasons_id = $request->seasons_id;
        $servers = Server::all();
        // $categories = Category::all();
        // $actors = Actor::all();
        $episodes = Episode::all();
        return view('dashboard.episodes.create', compact('episodes','series_id','seasons_id','servers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $test = $request->series_id;
        $attributes = $request->validate([
            'name' => 'required|string|max:50|min:1|unique:episodes',
            'year' => 'required|string|max:4|min:4',
            'overview' => 'required|string',
            'url' => 'required|string',
            'api_url' => 'required|string',
        ]);

        $img = $request->background_cover->store('public/episode_background_covers');
        $img1 = $request->poster->store('public/episode_posters');
        $attributes['background_cover'] = str_replace('public/','',$img);
        $attributes['poster'] = str_replace('public/','',$img1);

        $episode = Episode::create([
            'name' => $attributes['name'],
            'year' => $attributes['year'],
            'overview' => $attributes['overview'],
            'series_id'=>$test,
            'seasons_id'=>$request->seasons_id,
            'background_cover' => $attributes['background_cover'],
            'poster' => $attributes['poster'],
            'url' => $attributes['url'],
            'api_url' => $attributes['api_url'],
        ]);

        foreach($request->server_url as $server => $key) {
            EpisodeServer::updateOrCreate([
                'episode_id' => $episode->id,
                'server_id' => $server                
            ],[
                'episode_id' => $episode->id,
                'embed_url' => $key,
                'server_id' => $server
            ]);
        }
        

        session()->flash('success', 'Episode Added Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Episode $episode)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Episode $episode)
    {
        $categories = Category::all();
        $servers = Episode::select('episode_server.embed_url','servers.name','servers.id as id')
                        ->leftJoin('episode_server','episode_server.episode_id','episodes.id')
                        ->leftJoin('servers','episode_server.server_id','servers.id')
                        ->where('episode_server.episode_id',$episode->id)
                        ->groupBy('episode_server.server_id')->get();
        return view('dashboard.episodes.edit', compact('episode', 'categories','servers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Episode $episode)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:50', 'min:1', Rule::unique('episodes')->ignore($episode)],
            'year' => 'required|string|max:4|min:4',
            'overview' => 'required|string',
            'background_cover' => 'nullable|image',
            'poster' => 'nullable|image',
            'url' => 'required|string',
            'api_url' => 'required|string',
            'categories' => 'required|array|max:3|exists:categories,id',
        ]);

        if ($request->background_cover) {
            Storage::delete($episode->getAttributes()['background_cover']);
            $attributes['background_cover'] = $request->background_cover->store('episode_background_covers');
        }
        if ($request->poster) {
            Storage::delete($episode->getAttributes()['poster']);
            $attributes['poster'] = $request->poster->store('episode_posters');
        }

        $episode->update($attributes);
        foreach($request->server_url as $server => $key) {
            Episodeserver::updateOrCreate([
                'episode_id' => $episode->id,
                'server_id' => $server                
            ],[
                'episode_id' => $episode->id,
                'embed_url' => $key,
                'server_id' => $server
            ]);
        }
        $episode->categories()->sync($attributes['categories']);

        session()->flash('success', 'Episode Updated Successfully');
        return redirect()->route('dashboard.episodes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Episode::destroy($id)) {
            session()->flash('success', 'Episode Deleted Successfully');
            return redirect()->back();
          } else {
            session()->flash('alert', 'Episode Was not Successfully Delted');
            return redirect()->back();
          }
    }
}
