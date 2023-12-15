<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(15);

        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            ],
            [
                'name.required' => 'カテゴリ名を入力してください。',
                'name.string' => 'カテゴリ名は文字列で入力してください。',
                'name.max' => 'カテゴリ名は255文字以内で入力してください。',
                'name.unique' => 'そのカテゴリ名は既に登録されています。',
            ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->save();

        return to_route('dashboard.categories.index')->with('message', 'カテゴリを作成しました。');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            ],
            [
                'name.required' => 'カテゴリ名を入力してください。',
                'name.string' => 'カテゴリ名は文字列で入力してください。',
                'name.max' => 'カテゴリ名は255文字以内で入力してください。',
                'name.unique' => 'そのカテゴリ名は既に登録されています。',
            ]);
            
        $category->name = $request->input('name');
        $category->save();

        return to_route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('dashboard.categories.index')->with('message', 'カテゴリを削除しました。');
    }
}
