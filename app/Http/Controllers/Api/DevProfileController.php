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
            ->select('profiles.*', 'users.*', 'fields.name as field_name', 'fields.slug', 'fields.id as field_id')
            ->get();


        return response()->json([
            'success' => true,
            'profiles' => $profiles
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
