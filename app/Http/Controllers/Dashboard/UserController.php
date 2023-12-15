<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::sortable()->paginate(15);
        $total_count = User::count();

        $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email',
        ],
        [
            'email.email' => 'メールアドレスを正しい形式で入力してください'
        ]);

        $name = null;
        $email = null;

        if($request->name !== null){
            $name = $request->name;
            $users = User::where('name', 'LIKE', "%{$request->name}%")->orWhere('furigana', 'LIKE', "%{$request->name}%")->sortable()->paginate(15);
        }

        if($request->email !== null){
            $email = $request->email;
            $users = User::where('email', 'LIKE', "%{$request->email}%")->sortable()->paginate(15);
        }

        return view('dashboard.users.index', compact('users', 'total_count', 'name', 'email'));
    }

    public function show(User $user)
    {
        $total_count = User::count();
        $name = null;
        $email = null;

        $reviews = $user->reviews()->sortable()->paginate(5);

        return view('dashboard.users.show', compact('user', 'total_count', 'name', 'email', 'reviews'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard.users.index')->with('flash_message', '会員を削除しました');
    }
}
