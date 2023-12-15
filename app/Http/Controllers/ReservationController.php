<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function create(Restaurant $restaurant)
    {
        return view('reservations.create', compact('restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restaurantId = $request->input('restaurant_id');
        $restaurant = Restaurant::find($restaurantId);
    
        // レストランが見つからない場合のエラーハンドリング
        if (!$restaurant) {
            return back()->withErrors(['message' => '指定されたレストランが見つかりません。']);
        }

        $request->validate([
            'reserved_datetime' => 'required',
            'number_of_people' => 'required|integer'
        ],
        [
            'reserved_datetime.required' => '予約日時を入力してください。',
            'number_of_people.required' => '人数を入力してください。',
            'number_of_people.integer' => '人数は整数で入力してください。'
        ]);

        // 予約日時が過去でないかチェック
        if (new \DateTime() > new \DateTime($request->input('reserved_datetime'))) {
            return back()->withInput($request->input())->withErrors(['reserved_datetime' => '予約日時は現在より先の日時を指定してください。']);
        }

        // 予約日時が定休日でないかチェック
        foreach($restaurant->regular_holidays()->get() as $regular_holiday){
            $day_of_week = date('w', strtotime($request->input('reserved_datetime')));
            if($regular_holiday->day_index == $day_of_week){
                return back()->withInput($request->input())->withErrors(['reserved_datetime' => 'ご希望の予約日時は定休日です。別の日時を指定してください。']);
            }
        }

        // 予約日時が営業時間内はチェック
        // リクエストから予約日時を取得し、DateTimeオブジェクトに変換
        $reservedDateTime = new \DateTime($request->input('reserved_datetime'));

        // レストランの開店時間と閉店時間を取得し、DateTimeオブジェクトに変換
        $openTime = new \DateTime($reservedDateTime->format('Y-m-d') . ' ' . $restaurant->opening_time);
        $closeTime = new \DateTime($reservedDateTime->format('Y-m-d') . ' ' . $restaurant->closing_time);

        // 閉店時間が翌日の場合（例：開店 18:00、閉店 02:00）
        if ($closeTime < $openTime) {
            $closeTime->modify('+1 day');
        }

        if ($reservedDateTime >= $openTime && $reservedDateTime <= $closeTime) {
            // 予約時間が営業時間内の場合
                $reservation = new Reservation();
                $reservation->user_id = Auth::user()->id;
                $reservation->restaurant_id = $request->input('restaurant_id');
                $reservation->number_of_people = $request->input('number_of_people');
                $reservation->reserved_datetime = $request->input('reserved_datetime');
                $reservation->save();

                return redirect()->route('restaurants.show', $reservation->restaurant_id)->with('message', '予約が完了しました。');
        } else {
            // 営業時間外
            return back()->withInput($request->input())->withErrors(['reserved_datetime' => '予約時間は営業時間内にしてください。']);
        }
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('mypage.reservations')->with('message', '予約をキャンセルしました。');
    }
}
