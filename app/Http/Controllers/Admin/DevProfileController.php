<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Importo il modello
use App\Models\Admin\Profile;
use Illuminate\Support\Facades\Auth;

class DevProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $user_id = Auth::id();
        $profile = Profile::where('user_id', $user_id)->get();

        //return view('admin.profile.index', compact('profile'));
        
        if ($user->$user_id->exists()) {
            // The user has already created a profile, so redirect to the create view.
            return view ('admin.profile.index', compact('profile'));
        } else {
            // The user has not yet created a profile, so redirect to the index view.
            return view ('profile.create');
        }
        // if ($profile['items'] != []) {
        //     //dd($profile);
        //     return view('admin.profile.index', compact('profile'));
        // }else{
        //     return view('admin.profile.create', compact('profile'));
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        return view('admin.profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $form_data = $request->all();

        $newProfile = Profile::create($form_data);

        // aggiungere un redirect
        return view('admin.profile.index', compact('newProfile'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
