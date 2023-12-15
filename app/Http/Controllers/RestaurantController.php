<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $restaurants = Restaurant::all();
        $categories = Category::all();

        $sort_query = [];
        $sorted = '';


        if ($request->sort !== null) {
            $slices = explode(' ', $request->sort);
            $sort_query[$slices[0]] = $slices[1];
            $sorted = $request->sort;
        }

        if ($request->keyword !== null) {
            $keyword = rtrim($request->keyword);

            if ($sorted == 'rating desc') {
                $restaurants = Restaurant::select('restaurants.*', DB::raw('AVG(reviews.score) as average_score'))
                ->leftjoin('reviews', 'restaurants.id', '=', 'reviews.restaurant_id')
                ->where(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%")
                        ->orWhere('address', 'LIKE', "%{$keyword}%");
                })->orWhereHas('categories', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                });
                $total_count = $restaurants->count();
                $restaurants = $restaurants->groupBy('restaurants.id', 'restaurants.name', 'restaurants.address', 'restaurants.postal_code', 'restaurants.image', 'restaurants.created_at', 'restaurants.updated_at', 'restaurants.opening_time', 'restaurants.closing_time', 'restaurants.description')
                ->orderByDesc('average_score')
                ->paginate(10);
            } else {
                $restaurants = Restaurant::where(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%")
                        ->orWhere('address', 'LIKE', "%{$keyword}%");
                })->orWhereHas('categories', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                });
                $total_count = $restaurants->count();
                $restaurants = $restaurants->sortable($sort_query)->paginate(10);
            }
        } else {
            $keyword = '';

            if ($sorted == 'rating desc') {
                $restaurants = Restaurant::select('restaurants.*', DB::raw('AVG(reviews.score) as average_score'))
                    ->leftjoin('reviews', 'restaurants.id', '=', 'reviews.restaurant_id')
                    ->groupBy('restaurants.id', 'restaurants.name', 'restaurants.address', 'restaurants.postal_code', 'restaurants.image', 'restaurants.created_at', 'restaurants.updated_at', 'restaurants.opening_time', 'restaurants.closing_time', 'restaurants.description')
                    ->orderByDesc('average_score')
                    ->paginate(10);
            } else {
                $restaurants = Restaurant::sortable($sort_query)->paginate(10);
            }

            $total_count = $restaurants->count();
        }

        if ($request->category_id !== null) {

            if ($sorted == 'rating desc') {
                $restaurants = Restaurant::select('restaurants.*', DB::raw('AVG(reviews.score) as average_score'))
                ->leftjoin('reviews', 'restaurants.id', '=', 'reviews.restaurant_id')
                ->whereHas('categories', function ($query) use ($request) {
                    $query->where('category_id', $request->category_id);
                });
                $total_count = $restaurants->count();
                $restaurants = $restaurants->groupBy('restaurants.id', 'restaurants.name', 'restaurants.address', 'restaurants.postal_code', 'restaurants.image', 'restaurants.created_at', 'restaurants.updated_at', 'restaurants.opening_time', 'restaurants.closing_time', 'restaurants.description')
                ->orderByDesc('average_score')
                ->paginate(10);
            } else {
                $restaurants = Restaurant::whereHas('categories', function ($query) use ($request) {
                    $query->where('category_id', $request->category_id);
                });
                $total_count = $restaurants->count();
                $restaurants = $restaurants->sortable($sort_query)->paginate(10);
            }

        }

        $sort = [
            '掲載が新しい順' => 'created_at desc',
            '評価の高い順' => 'rating desc',
        ];

        return view('restaurants.index', compact('restaurants', 'total_count', 'keyword', 'sort', 'sorted', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        return view('restaurants.show', compact('restaurant'));
    }

    public function favorite(Restaurant $restaurant)
    {
        Auth::user()->togglefavorite($restaurant);

        // メッセージを分けてセッションに保存　isFavoriteメソッドはRestautant.phpに記述
        if ($restaurant->isFavoritedBy(Auth::user())) {
            session()->flash('message', 'お気に入りに追加しました。');
        } else {
            session()->flash('message', 'お気に入りを解除しました。');
        }
        
        return back();
    }
}
