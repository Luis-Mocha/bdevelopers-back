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
            ->leftJoin('profile_sponsorship', 'profiles.id', '=', 'profile_sponsorship.profile_id')


            ->select(
                'profiles.*',
                'users.*',
                DB::raw('profiles.id as profile_id'),
                DB::raw('GROUP_CONCAT(DISTINCT fields.name ORDER BY fields.name) as field_names'),
                DB::raw('GROUP_CONCAT(DISTINCT fields.id ORDER BY fields.id) as field_ids'),
                DB::raw('GROUP_CONCAT(DISTINCT technologies.name ORDER BY technologies.name) as technology_names'),
                DB::raw('GROUP_CONCAT(DISTINCT technologies.id ORDER BY technologies.id) as technology_ids'),
                DB::raw('COUNT(DISTINCT reviews.id) as total_reviews'), // Aggiungi il conteggio delle recensioni
                DB::raw('AVG(reviews.vote) as average_vote'),
                DB::raw('MAX(profile_sponsorship.end_date) as max_end_date'),
                DB::raw('CASE WHEN NOW() <= MAX(profile_sponsorship.end_date) THEN 1 ELSE 0 END as active_sponsorship'),

            )
            ->groupBy('profiles.id', 'users.id')
            ->orderBy('active_sponsorship', 'desc')
            ->orderBy('average_vote', 'desc');


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
                'total_reviews' => $result->total_reviews,
                'average_vote' => intval($result->average_vote) ? intval($result->average_vote) : 0,
                'active_sponsorship' => $result->active_sponsorship,
                'max_end_date' => $result->max_end_date
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
            )
            ->groupBy('profiles.id', 'users.id')
            ->first();

        // dati relativi alle recensioni del profilo
        $reviews = DB::table('reviews')
            ->where('profile_id', '=', $id)
            ->select('description', 'name', 'surname', 'date', 'vote')
            ->orderBy('created_at', 'desc')
            ->get();
        $profileQuery->reviews = $reviews;
        // totale recensioni
        $totalReviews = count($reviews);
        // media voti
        $averageVote = $reviews->avg('vote');



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
            // recensioni
            'total_reviews' => $totalReviews,
            'average_vote' => $averageVote,
            'reviews' => $profileQuery->reviews,
        ];



        if ($profileQuery) {
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
