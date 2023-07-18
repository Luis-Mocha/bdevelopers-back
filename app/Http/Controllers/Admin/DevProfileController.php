<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Importo il modello
use App\Models\Admin\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin\Field;
use App\Models\Admin\Technology;
use App\Models\User;

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

            return redirect()->route('admin.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $fields = Field::all();

        $currentUser = Auth::user();

        $technologies = Technology::all();
        // dd($technologies);
        return view('admin.profile.create', compact('technologies', 'fields', 'currentUser'));
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
        //Controllo checked Technologies

        $newProfile = Profile::create($form_data);

        // Ottengo lo user autenticato
        $user_id = Auth::id();
        $currentUser = User::find($user_id);

        // fields
        if ($request->has('fields')) {

            $currentUser->fields()->sync($request->fields);
        }

        // technolpogies
        if ($request->has('technologies')) {

            $newProfile->technologies()->attach($request->technologies);
        }


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

        $fields = Field::all();

        $technologies = Technology::all();

        $currentUser = Auth::user();

        // condizione che confronta l'id user con l'id profile
        if ($profile_id->user_id == $user_id) {
            return view('admin.profile.edit', compact('profile_id', 'fields', 'technologies', 'currentUser'));
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

        $user_id = Auth::id();

        $user = User::find($user_id);

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


        //Controllo Technologies aggiornati
        if ($request->has('technologies')) {
            $profile_id->technologies()->sync($request->technologies);
        }
        //Controllo Fields aggiornati
        if ($request->has('fields')) {
            $user->fields()->sync($request->fields);
        }

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
