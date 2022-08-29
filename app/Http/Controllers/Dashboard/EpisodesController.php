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
            // $query->when($request->category, function ($q) use ($request) {
            //     return $q->whereHas('categories', function ($q2) use ($request){
            //         return $q2->whereIn('category_id', (array)$request->category)
            //             ->orWhereIn('name', (array)$request->category);
            //     });
            // });
            // $query->when($request->actor, function ($q) use ($request) {
            //     return $q->whereHas('actors', function ($q2) use ($request){
            //         return $q2->whereIn('actor_id', (array)$request->actor)
            //             ->orWhereIn('name', (array)$request->actor);
            //     });
            // });
            // $query->when($request->favorite, function ($q) use ($request) {
            //     return $q->whereHas('favorites', function ($q2) use ($request){
            //         return $q2->whereIn('user_id', (array)$request->favorite);
            //     });
            // });
        })->latest()->paginate(10);
        //  $categories = Category::all();
        //  $actors = Actor::all();

        return view('dashboard.episodes.index', compact('episodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
