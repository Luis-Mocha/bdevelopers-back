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

        $profilesQuery = DB::table('profiles')
            ->join('users', 'profiles.user_id', '=', 'users.id')
            ->join('field_user', 'users.id', '=', 'field_user.user_id')
            ->join('fields', 'field_user.field_id', '=', 'fields.id')
            ->leftJoin('reviews', 'profiles.id', '=', 'reviews.profile_id')
            ->leftJoin('profile_technology', 'profiles.id', '=', 'profile_technology.profile_id')
            ->leftJoin('technologies', 'profile_technology.technology_id', '=', 'technologies.id')

            ->select(
                'profiles.*',
                'users.*',
                DB::raw('profiles.id as profile_id'),
                DB::raw('GROUP_CONCAT(DISTINCT fields.name ORDER BY fields.name) as field_names'),
                DB::raw('GROUP_CONCAT(DISTINCT fields.id ORDER BY fields.id) as field_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT technologies.name ORDER BY technologies.name) as technology_names'),
                DB::raw('GROUP_CONCAT(DISTINCT technologies.id ORDER BY technologies.id) as technology_ids'),
                //DB::raw('GROUP_CONCAT(DISTINCT reviews.description ORDER BY reviews.description) as review_desc'),
                // DB::raw('GROUP_CONCAT(DISTINCT reviews.id ORDER BY reviews.id) as review_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT reviews.vote) as review_vote'),
                DB::raw('GROUP_CONCAT(DISTINCT reviews.description) as review_desc'),
                DB::raw('GROUP_CONCAT(DISTINCT reviews.name) as review_name'),
                DB::raw('GROUP_CONCAT(DISTINCT reviews.surname) as review_surname'),
                DB::raw('GROUP_CONCAT(DISTINCT reviews.date) as review_date'),
                DB::raw('COUNT(DISTINCT reviews.id) as total_reviews'), // Aggiungi il conteggio delle recensioni
                DB::raw('AVG(reviews.vote) as average_vote'),

            )
            ->groupBy('profiles.id', 'users.id');

        // filtro fields 
        if ($request->has('field_ids')) {
            $field_ids = explode(',', $request->field_ids);

            $profilesQuery->whereExists(function ($query) use ($field_ids) {
                $query->select(DB::raw(1))
                    ->from('field_user')
                    ->whereRaw('field_user.user_id = users.id')
                    ->whereIn('field_user.field_id', $field_ids);
            });
        }

        // filtro numero recensioni
        if ($request->has('total_reviews')) {
            $total_reviews = intval($request->total_reviews);

            $profilesQuery->having('total_reviews', '>=', $total_reviews);
        }

        // filtro voto medio recensioni
        if ($request->has('average_vote')) {
            $average_vote = intval($request->average_vote);

            $profilesQuery->having('average_vote', '>=', $average_vote);
        }

        $profiles = $profilesQuery->get();

        $profilesData = [];
        foreach ($profiles as $result) {
            $profileData = [
                'profile_id' => $result->profile_id,
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
                // Field e technologies
                'field_names' => explode(',', $result->field_names), // Converto la stringa in un array di nomi dei campi
                'field_ids' => explode(',', $result->field_ids), // Converto la stringa in un array di ID dei campi
                'technology_names' =>  $result->technology_names ? explode(',', $result->technology_names) : null,
                'technology_ids' => $result->technology_ids ? explode(',', $result->technology_ids) : null,
                'review_desc' => $result->review_desc ? explode(',', $result->review_desc) : null,
                'review_vote' => $result->review_vote ? explode(',', $result->review_vote) : null,
                'review_name' => $result->review_name ? explode(',', $result->review_name) : null,
                'review_surname' => $result->review_surname ? explode(',', $result->review_surname) : null,
                'review_date' => $result->review_date ? explode(',', $result->review_date) : null,
                'total_reviews' => $result->total_reviews,
                'average_vote' => intval($result->average_vote) ? intval($result->average_vote) : 0,
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
        // $profile = Profile::with('technologies', 'reviews')->where('id', $id)->first(); // !! sto usando l'id !!

        $profileQuery = DB::table('profiles')
            ->join('users', 'profiles.user_id', '=', 'users.id')
            ->join('field_user', 'users.id', '=', 'field_user.user_id')
            ->join('fields', 'field_user.field_id', '=', 'fields.id')
            ->leftJoin('reviews', 'profiles.id', '=', 'reviews.profile_id')
            ->leftJoin('profile_technology', 'profiles.id', '=', 'profile_technology.profile_id')
            ->leftJoin('technologies', 'profile_technology.technology_id', '=', 'technologies.id')
            ->where('profiles.id', '=', $id)

            ->select(
                'profiles.*',
                'users.*',
                DB::raw('profiles.id as profile_id'),
                DB::raw('GROUP_CONCAT(DISTINCT fields.name ORDER BY fields.name) as field_names'),
                DB::raw('GROUP_CONCAT(DISTINCT fields.id ORDER BY fields.id) as field_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT technologies.name ORDER BY technologies.name) as technology_names'),
                DB::raw('GROUP_CONCAT(DISTINCT technologies.id ORDER BY technologies.id) as technology_ids'),
                //DB::raw('GROUP_CONCAT(DISTINCT reviews.description ORDER BY reviews.description) as review_desc'),
                // DB::raw('GROUP_CONCAT(DISTINCT reviews.id ORDER BY reviews.id) as review_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT reviews.vote) as review_vote'),
                DB::raw('GROUP_CONCAT(DISTINCT reviews.description) as review_desc'),
                DB::raw('GROUP_CONCAT(DISTINCT reviews.name) as review_name'),
                DB::raw('GROUP_CONCAT(DISTINCT reviews.surname) as review_surname'),
                DB::raw('GROUP_CONCAT(DISTINCT reviews.date) as review_date'),
                DB::raw('COUNT(DISTINCT reviews.id) as total_reviews'), // Aggiungi il conteggio delle recensioni
                DB::raw('AVG(reviews.vote) as average_vote'),

            )
            ->groupBy('profiles.id', 'users.id')
            ->first();


        $profileData = [
            'profile_id' => $profileQuery->profile_id,
            'name' => $profileQuery->name,
            'surname' => $profileQuery->surname,
            'birth_date' => $profileQuery->birth_date,
            'address' => $profileQuery->address,
            'phone_number' => $profileQuery->phone_number,
            'email' => $profileQuery->email,
            'github_url' => $profileQuery->github_url,
            'linkedin_url' => $profileQuery->linkedin_url,
            'profile_image' => $profileQuery->profile_image,
            'curriculum' => $profileQuery->curriculum,
            'performance' => $profileQuery->performance,
            // Field e technologies
            'field_names' => explode(',', $profileQuery->field_names), // Converto la stringa in un array di nomi dei campi
            'field_ids' => explode(',', $profileQuery->field_ids), // Converto la stringa in un array di ID dei campi
            'technology_names' => $profileQuery->technology_names ? explode(',', $profileQuery->technology_names) : null,
            'technology_ids' => $profileQuery->technology_ids ? explode(',', $profileQuery->technology_ids) : null,
            'review_desc' => $profileQuery->review_desc ? explode(',', $profileQuery->review_desc) : null,
            'review_vote' => $profileQuery->review_vote ? explode(',', $profileQuery->review_vote) : null,
            'review_name' => $profileQuery->review_name ? explode(',', $profileQuery->review_name) : null,
            'review_surname' => $profileQuery->review_surname ? explode(',', $profileQuery->review_surname) : null,
            'review_date' => $profileQuery->review_date ? explode(',', $profileQuery->review_date) : null,
            'total_reviews' => $profileQuery->total_reviews,
            'average_vote' => intval($profileQuery->average_vote) ? intval($profileQuery->average_vote) : 0,
        ];

        if ($profileData) {
            return response()->json([
                'success' => true,
                'profile' => $profileData
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Non risulta alcun post'
            ])->setStatusCode(404);
        }
    }
}
