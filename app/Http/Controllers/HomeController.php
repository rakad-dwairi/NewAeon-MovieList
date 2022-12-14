<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Type;
use App\Category;
use App\Film;
use App\Series;
use App\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //        $this->middleware('auth');
    }

    /**
     * Show the application Dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliderFilms = Film::with('categories')->with('ratings')->limit(10)->latest()->get();
        $sliderSeries = Series::with('categories')->limit(10)->latest()->get();
        $categoryFilms = Category::with('films')->get();
        $categorySeries = Category::with('series')->get();
        $filmsType = Type::with('films')->get();


        return view('home', compact('sliderFilms', 'categoryFilms', 'sliderSeries', 'categorySeries','filmsType'));
    }

    public function search(Request $request)
    {
        switch ($request->search_category) {
            case 'movies':
                $films = Film::where('name', 'like', '%' . $request->search . '%')->paginate(10);
                return view('movies.index', compact('films'));
                break;
            case 'series':
                $films = Series::where('name', 'like', '%' . $request->search . '%')->paginate(10);
                return view('series.index', compact('series'));
                break;
            case 'actors':
                $actors = Actor::where('name', 'like', '%' . $request->search . '%')->paginate(10);
                return view('actors.index', compact('actors'));
                break;
                case 'type':
                    $type = Type::where('name', 'like', '%' . $request->search . '%')->paginate(10);
                    return view('actors.index', compact('type'));
                    break;
            default:
                return redirect()->back();
        }
    }

    public function message(Request $request)
    {
        $attributes = $request->validate([
            'email' =>  'required|email',
            'title' =>  'required|string',
            'message' =>  'required|string|max:250'
        ]);

        Message::create([
            'email' => $attributes['email'],
            'title' => $attributes['title'],
            'message' => $attributes['message'],
        ]);

        session()->flash('success', 'Thank you for contact us');
        return redirect()->back();
    }
}
