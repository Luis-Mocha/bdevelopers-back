<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Importo il modello
use App\Models\Admin\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

// importo lo Storage
use Illuminate\Support\Facades\Storage;

//importo il request
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;


class DevProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id = Auth::id();
        $profile = Profile::where('user_id', $user_id)->get();

        //Verica se l'utente è registrato e ha un profilo developer
        if (Profile::where('user_id', $user_id)->exists()) {

            return view('admin.profile.index', compact('profile'));

            //Verica se l'utente è registrato ma non ha un profilo developer
        } elseif (Profile::where('user_id', $user_id)->doesntExist()) {

            return view('admin.profile.create');
        }
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
    public function store(StoreRequest $request)
    {

        $form_data = $request->all();



        if ($request->hasFile('profile_image')) {

            // creo un path dove viene salvata l'immagine del profilo
            // 'project_covers' è una sottocartella che creo in storage
            $path = Storage::disk('public')->put('project_covers', $request->profile_image);

            $form_data['profile_image'] = $path;
        }

        $newProfile = Profile::create($form_data);

        // aggiungere un redirect
        return redirect()->route('admin.index');
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
        $user_id = Auth::id();

        $profile_id =  Profile::find($id);

        // condizione che confronta l'id user con l'id profile
        if ($profile_id->user_id == $user_id) {
            return view('admin.profile.edit', compact('profile_id'));
        } else {
            //reindirizzamento alla pagina di errore
            abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $profile_id =  Profile::find($id);
        $form_data = $request->all();

        if ($request->hasFile('profile_image')) {

            //PROCEDIMENTO SOLO SE SIAMO NELLA UPDATE!!!!!
            if ($profile_id->profile_image) {
                Storage::delete($profile_id->profile_image);
            }
            //FINE: PROCEDIMENTO SOLO SE SIAMO NELLA UPDATE!!!!!

            //Genere un path di dove verrà salvata l'iimagine nel progetto
            $path = Storage::disk('public')->put('project_covers', $request->profile_image);

            $form_data['profile_image'] = $path;
        }
        $profile_id->update($form_data);

        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {



        $profile_id =  Profile::find($id);
        if ($profile_id->profile_image) {
            Storage::delete($profile_id->profile_image);
        }
        $profile_id->delete();

        return view('welcome');
    }
}
