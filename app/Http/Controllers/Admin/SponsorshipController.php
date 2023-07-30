<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Importo il modello
use App\Models\Admin\Profile;
use App\Models\Admin\Sponsorship;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;


class SponsorshipController extends Controller
{
    // SILVER
    public function tokenSilver(Request $request)
    {

        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);

        $user_id = Auth::id();
        $profile = Profile::where('user_id', $user_id)->first();

        $today = Carbon::now();
        $last_sponsorship = $profile->sponsorships()->latest('end_date')->first();

        if ($request->input('nonce') != null) {
            $nonceFromTheClient = $request->input('nonce');

            $gateway->transaction()->sale([
                'amount' => '2.99',
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);

            $duration = 24;
            $sponsorshipType = Sponsorship::where('id', 1)->first();
            
            if ($last_sponsorship && $today->lessThan($last_sponsorship->pivot->end_date)) {

                $dataStringa = $last_sponsorship->pivot->end_date;
                $dataOra= Carbon::parse($dataStringa);

                $dataOraAggiornata = $dataOra->clone()->addHours($duration);

                $profile->sponsorships()->attach($sponsorshipType->id, ['start_date' => $dataOra, 'end_date' => $dataOraAggiornata]);

            } else {
                
                $profile->sponsorships()->attach($sponsorshipType->id, ['start_date' => now(), 'end_date' => now()->addHours($duration)]);
            }

            
        } else {
            $clientToken = $gateway->clientToken()->generate();
            return view('admin.profile.paymentSilver', ['token' => $clientToken]);
        }
    }
    // GOLD
    public function tokenGold(Request $request)
    {

        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);

        $user_id = Auth::id();
        $profile = Profile::where('user_id', $user_id)->first();

        $today = Carbon::now();
        $last_sponsorship = $profile->sponsorships()->latest('end_date')->first();

        if ($request->input('nonce') != null) {
            $nonceFromTheClient = $request->input('nonce');

            $gateway->transaction()->sale([
                'amount' => '5.99',
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);

            $duration = 72;
            $sponsorshipType = Sponsorship::where('id', 2)->first();
            
            if ($last_sponsorship && $today->lessThan($last_sponsorship->pivot->end_date)) {

                $dataStringa = $last_sponsorship->pivot->end_date;
                $dataOra= Carbon::parse($dataStringa);

                $dataOraAggiornata = $dataOra->clone()->addHours($duration);

                $profile->sponsorships()->attach($sponsorshipType->id, ['start_date' => $dataOra, 'end_date' => $dataOraAggiornata]);

            } else {
                
                $profile->sponsorships()->attach($sponsorshipType->id, ['start_date' => now(), 'end_date' => now()->addHours($duration)]);
            }

            
        } else {
            $clientToken = $gateway->clientToken()->generate();
            return view('admin.profile.paymentGold', ['token' => $clientToken]);
        }
    }
    // PLATINUM
    public function tokenPlatinum(Request $request)
    {

        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);

        $user_id = Auth::id();
        $profile = Profile::where('user_id', $user_id)->first();

        $today = Carbon::now();
        $last_sponsorship = $profile->sponsorships()->latest('end_date')->first();

        if ($request->input('nonce') != null) {
            $nonceFromTheClient = $request->input('nonce');

            $gateway->transaction()->sale([
                'amount' => '9.99',
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);

            $duration = 144;
            $sponsorshipType = Sponsorship::where('id', 3)->first();
            
            if ($last_sponsorship && $today->lessThan($last_sponsorship->pivot->end_date)) {

                $dataStringa = $last_sponsorship->pivot->end_date;
                $dataOra= Carbon::parse($dataStringa);

                $dataOraAggiornata = $dataOra->clone()->addHours($duration);

                $profile->sponsorships()->attach($sponsorshipType->id, ['start_date' => $dataOra, 'end_date' => $dataOraAggiornata]);

            } else {
                
                $profile->sponsorships()->attach($sponsorshipType->id, ['start_date' => now(), 'end_date' => now()->addHours($duration)]);
            }

            
        } else {
            $clientToken = $gateway->clientToken()->generate();
            return view('admin.profile.paymentPlatinum', ['token' => $clientToken]);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //prendo i dati delle sponsor
        // Ottengo lo user autenticato
        $user_id = Auth::id();
        $profile = Profile::where('user_id', $user_id)->first();

        $sponsorshipsData = DB::table('profile_sponsorship')
        ->where('profile_id', '=', $profile->id)
        ->orderBy('end_date', 'desc')
        ->get();

        return view('admin.profile.sponsorship', compact('sponsorshipsData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
