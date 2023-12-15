<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 新規掲載順に6店舗を取得
        $restaurants = Restaurant::orderBy('created_at', 'desc')->take(6)->get();

        // カテゴリーを全て取得
        $categories = Category::all();

        // 平均評価の高い順に6店舗を取得
        $restaurants_ranking = Restaurant::select('restaurants.*', DB::raw('AVG(reviews.score) as average_score'))
                    ->leftjoin('reviews', 'restaurants.id', '=', 'reviews.restaurant_id')
                    ->groupBy('restaurants.id', 'restaurants.name', 'restaurants.address', 'restaurants.postal_code', 'restaurants.image', 'restaurants.created_at', 'restaurants.updated_at', 'restaurants.opening_time', 'restaurants.closing_time', 'restaurants.description')
                    ->orderByDesc('average_score')
                    ->take(6)->get();

        return view('index', compact('restaurants', 'categories', 'restaurants_ranking'));
    }
}
