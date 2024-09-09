<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //自己紹介ページ表示(ホーム)
        return view('MyProfile.index');
    }

    public function create(){
        
        return view('MyProfile.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function self_introduction()
    {
        //自身の自己紹介ページ
        return view('MyProfile.self_introduction');
    }

    public function career()
    {
        //自身の経歴ページ
        return view('MyProfile.career');
    }

    public function want_to_do()
    {
        //自身のやりたいことページ
        return view('MyProfile.want_to_do');
    }

    public function skill()
    {
        //自身の特技ページ
        return view('MyProfile.skill');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
