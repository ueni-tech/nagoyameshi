<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mypage()
    {
        $user = Auth::user();
        return view('users.mypage', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if ($user->email !== $request->input('email')) {
            $request->validate(
                [
                    'name' => 'required',
                    'furigana' => 'required|regex:/^[ァ-ヶー　]+$/u',
                    'email' => ['required', 'string', 'custom_email', 'max:255', 'unique:users']
                ],
                [
                    'name.required' => '名前を入力してください。',
                    'furigana.required' => 'フリガナを入力してください。',
                    'furigana.regex' => 'フリガナは全角カタカナで入力してください。',
                    'email.required' => 'メールアドレスを入力してください。',
                ]
            );
        } else {
            $request->validate(
                [
                    'name' => 'required',
                    'furigana' => 'required|regex:/^[ァ-ヶー　]+$/u',
                ],
                [
                    'name.required' => '名前を入力してください。',
                    'furigana.required' => 'フリガナを入力してください。',
                    'furigana.regex' => 'フリガナは全角カタカナで入力してください。',
                ]
            );
        }

        $user->name = $request->input('name');
        $user->furigana = $request->input('furigana');
        $user->email = $request->input('email');
        $user->update();

        // stripeの顧客情報を更新
        $user->updateStripeCustomer([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);


        return redirect()->route('mypage.edit')->with('message', '会員情報を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = Auth::user();

        // stripeのサブスクリプションを停止
        $subscription = $user->subscription('default');
        if ($subscription && $subscription->active()) {
            $subscription->cancel();
        }

        // ユーザーを削除
        $user->delete();

        return redirect('/');
    }

    public function reviews(Request $request)
    {
        $user = Auth::user();

        if ($request->sort !== null) {
            $sorted = $request->sort;
            $reviews = $user->reviews()->orderBy('updated_at', $sorted)->paginate(5);
            return view('users.reviews', compact('reviews', 'sorted'));
        } else {
            $sorted = 'desc';
            $reviews = $user->reviews()->orderBy('updated_at', 'desc')->paginate(5);
            return view('users.reviews', compact('reviews', 'sorted'));
        }
    }

    public function favorite(Request $request)
    {
        $user = Auth::user();

        if ($request->sort !== null) {
            $sorted = $request->sort;
            $favorites = $user->favorites()->orderBy('updated_at', $sorted)->paginate(5);
            return view('users.favorites', compact('favorites', 'sorted'));
        } else {
            $sorted = 'desc';
            $favorites = $user->favorites()->orderBy('updated_at', 'desc')->paginate(5);
            return view('users.favorites', compact('favorites', 'sorted'));
        }
    }

    public function reservations()
    {
        $user = Auth::user();
        // 予約日時が未来のもののみ取得
        $reservations = $user->reservations()->where('reserved_datetime', '>', date('Y-m-d H:i:s'))->paginate(5);

        return view('users.reservations', compact('reservations'));
    }
}
