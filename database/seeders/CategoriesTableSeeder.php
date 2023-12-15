<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\MOdels\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            '和食', '寿司', '焼肉', '鍋', '居酒屋', 'ラーメン', 'カフェ', 'イタリアン', 'フレンチ', '中華', '韓国料理', 'アジアン', '洋食', 'ステーキ', 'バー', 'ダイニングバー', 'ビアガーデン', 'バイキング', 'カレー', 'ハンバーガー', 'オムライス', '天ぷら', 'うどん', 'そば', 'パスタ', 'ピザ', 'スイーツ', 'パン', 'ケーキ', '和菓子',
        ];

        foreach ($names as $name) {
            Category::create([
                'name' => $name,
            ]);
        }
    }
}
