<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => 'NAGOYAMESHI株式会社',
            'postal_code' => '460-0008',
            'address' => '愛知県名古屋市中区栄3-6-1',
            'representative' => '代表取締役　山田太郎',
            'capital' => '1,000万円',
            'business' => '飲食店の経営',
            'number_of_employees' => '100名',
        ]);
    }
}
