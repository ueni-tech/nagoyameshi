<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Exception;

class SubscriptionController extends Controller
{
    function index()
    {
        $intent = auth()->user()->createSetupIntent();
        return view('subscriptions.index', compact('intent'));
    }

    function store(Request $request)
    {
        try {
            $request->user()->newSubscription(
                'default',
                'price_1OHLtmKhH49tdTK4W8R9S8cJ'
            )->create($request->paymentMethodId);

            return redirect()->route('mypage');
        } catch (IncompletePayment $exception) {
            // Stripeからの支払い関連の例外をキャッチ
            $error = $exception->getMessage();
            return redirect()->back()->with('error', 'サブスクリプション登録に失敗しました：' . $error);
        } catch (Exception $exception) {
            // その他の一般的な例外をキャッチ
            $error = $exception->getMessage();
            return redirect()->back()->with('error', 'エラーが発生しました：' . $error);
        }
    }

    function edit(Request $request)
    {
        $intent = auth()->user()->createSetupIntent();
        $user = $request->user();
        $paymentMethod = $user->defaultPaymentMethod();
        return view('subscriptions.edit', compact('intent', 'user', 'paymentMethod'));
    }

    function update(Request $request)
    {
        $user = $request->user();
        $paymentMethodId = $request->input('paymentMethodId');
        $user->updateDefaultPaymentMethod($paymentMethodId);
        $this->deleteOldPaymentMethods($user);
        return redirect()->route('subscription.edit')->with('message', 'クレジットカード情報を更新しました');
    }

    private function deleteOldPaymentMethods($user)
    {
        $paymentMethods = $user->paymentMethods();

        foreach ($paymentMethods as $paymentMethod) {
            if ($paymentMethod->id !== $user->defaultPaymentMethod()->id) {
                $user->deletePaymentMethod($paymentMethod->id);
            }
        }
    }

    function cancel(Request $request)
    {
        $onGracePeriod = false;

        $user = $request->user();
        $onGracePeriod = $user->subscription('default')->onGracePeriod();
        return view('subscriptions.cancel', compact('user', 'onGracePeriod'));
    }

    function destroy(Request $request)
    {
        $request->user()->subscription('default')->cancel();
        return back()->with('message', '解約申請を受け付けました。');
    }

    function resume(Request $request)
    {
        $request->user()->subscription('default')->resume();
        return back()->with('message', '有料会員契約を再開しました。');
    }
}
