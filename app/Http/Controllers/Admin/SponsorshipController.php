<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Importo il modello
use App\Models\Admin\Profile;
use App\Models\Admin\Sponsorship;
use Illuminate\Support\Facades\Auth;


class SponsorshipController extends Controller
{

    public function token(Request $request)
    {

        $amount = $request->input('amount');


        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);

        if ($request->input('nonce') != null) {
            $nonceFromTheClient = $request->input('nonce');

            $gateway->transaction()->sale([
                'amount' => $amount,
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);

            $duration = 0;
            $sponsorshipType = [];

            if ($amount == 2.99) {
                $duration = 24;
                $sponsorshipType = Sponsorship::where('id', 1)->first();
            } elseif ($amount == 5.99) {
                $duration = 72;
                $sponsorshipType = Sponsorship::where('id', 2)->first();
            } else {
                $duration = 144;
                $sponsorshipType = Sponsorship::where('id', 3)->first();
            }


            $user_id = Auth::id();
            $profile = Profile::where('user_id', $user_id)->first();

            $today = now();

            $last_sponsorship = $profile->sponsorships()->latest('end_date')->first();


            if ($last_sponsorship && $today <= $last_sponsorship->end_date) {

                $start_date_value = $last_sponsorship->end_date->addSecond();

                if ($amount == 2.99) {

                    $sponsorshipType = Sponsorship::where('id', 1)->first();
                    $end_date_value = $start_date_value->addHours(24);
                } elseif ($amount == 5.99) {

                    $sponsorshipType = Sponsorship::where('id', 2)->first();
                    $end_date_value = $start_date_value->addHours(72);
                } else {

                    $sponsorshipType = Sponsorship::where('id', 3)->first();
                    $end_date_value = $start_date_value->addHours(144);
                }

                $profile->sponsorships()->attach($sponsorshipType->id, ['start_date' => $start_date_value, 'end_date' => $end_date_value]);
            } else {

                $profile->sponsorships()->attach($sponsorshipType->id, ['start_date' => now(), 'end_date' => now()->addHours($duration)]);
            }


            // return view('dashboard');
        } else {
            $clientToken = $gateway->clientToken()->generate();
            return view('admin.profile.sponsorship', ['token' => $clientToken]);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.profile.sponsorship');
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
