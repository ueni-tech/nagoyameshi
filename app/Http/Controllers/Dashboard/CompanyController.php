<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('dashboard.company.index', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
            // バリデーション
            $request->validate([
                'name' => 'required|string|max:255',
                'postal_code' => 'required|string|max:255|regex:/^[0-9]{3}-[0-9]{4}$/',
                'postal_code' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'representative' => 'required|string|max:255',
                'capital' => 'required|string|max:255',
                'business' => 'required|string|max:255',
                'number_of_employees' => 'required|string|integer',
            ],
            [
                'name.required' => '会社名を入力してください。',
                'name.string' => '会社名は文字列で入力してください。',
                'name.max' => '会社名は255文字以内で入力してください。',
                'postal_code.regex' => '郵便番号を正しい形式で入力してください。',
                'postal_code.required' => '郵便番号を入力してください。',
                'address.required' => '住所を入力してください。',
                'address.string' => '住所は文字列で入力してください。',
                'address.max' => '住所は255文字以内で入力してください。',
                'representative.required' => '代表者名を入力してください。',
                'representative.string' => '代表者名は文字列で入力してください。',
                'representative.max' => '代表者名は255文字以内で入力してください。',
                'capital.required' => '資本金を入力してください。',
                'capital.string' => '資本金は文字列で入力してください。',
                'capital.max' => '資本金は255文字以内で入力してください。',
                'business.required' => '事業内容を入力してください。',
                'business.string' => '事業内容は文字列で入力してください。',
                'business.max' => '事業内容は255文字以内で入力してください。',
                'number_of_employees.required' => '従業員数を入力してください。',
                'number_of_employees.string' => '従業員数は文字列で入力してください。',
                'number_of_employees.integer' => '従業員数は整数で入力してください。',
            ]);

            $company->name = $request->input('name');
            $company->postal_code = $request->input('postal_code');
            $company->address = $request->input('address');
            $company->representative = $request->input('representative');
            $company->capital = $request->input('capital');
            $company->business = $request->input('business');
            $company->number_of_employees = $request->input('number_of_employees');
            $company->save();
    
            return redirect()->route('dashboard.company.index')->with('message', '会社情報を更新しました。');
    }
}
