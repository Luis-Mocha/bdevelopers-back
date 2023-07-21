<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Profile;
use Illuminate\Support\Facades\DB;

class DevProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$profiles = Profile::all();

        $profiles = DB::table('profiles')
        ->join('users', 'profiles.user_id', '=', 'users.id')
        ->join('field_user', 'users.id', '=', 'field_user.user_id')
        ->join('fields', 'field_user.field_id', '=', 'fields.id')
        ->select('profiles.*', 'users.*', DB::raw('GROUP_CONCAT(fields.name ORDER BY fields.name) as field_names'), DB::raw('GROUP_CONCAT(fields.id ORDER BY fields.id) as field_ids'))
        ->groupBy('profiles.id', 'users.id') // Raggruppa per l'ID del profilo e l'ID dell'utente
        ->get();

        $profilesData = [];
        foreach ($profiles as $result) {
            $profileData = [
                'id' => $result->id,
                'name' => $result->name,
                'surname' => $result->surname,
                'birth_date' => $result->birth_date,
                'address' => $result->address,
                'phone_number' => $result->phone_number,
                'email' => $result->email,
                'github_url' => $result->github_url,
                'linkedin_url' => $result->linkedin_url,
                'profile_image' => $result->profile_image,
                'curriculum' => $result->curriculum,
                'performance' => $result->performance,
                // Altri attributi del profilo
                'field_names' => explode(',', $result->field_names), // Converto la stringa in un array di nomi dei campi
                'field_ids' => explode(',', $result->field_ids), // Converto la stringa in un array di ID dei campi
            ];
            $profilesData[] = $profileData;
        }

        return response()->json([
            'success' => true,
            'profilesData' => $profilesData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }
}
