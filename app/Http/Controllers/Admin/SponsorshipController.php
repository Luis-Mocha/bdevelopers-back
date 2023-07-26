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

            $user_id = Auth::id();
            $profile = Profile::where('user_id', $user_id)->first();

            $today = now();

            if ($amount == 2.99) {

                //
                $sponsorshipType = Sponsorship::where('id', 1)->first();

                $end_date_value = $today->addHours(24);

                $profile->sponsorships()->attach($sponsorshipType->id, ['start_date' => now(), 'end_date' => $end_date_value]);
            } elseif ($amount == 5.99) {

                $sponsorshipType = Sponsorship::where('id', 2)->first();

                $end_date_value = $today->addHours(72);

                $profile->sponsorships()->attach($sponsorshipType->id, ['start_date' => now(), 'end_date' => $end_date_value]);
            } else {


                $sponsorshipType = Sponsorship::where('id', 3)->first();

                $end_date_value = $today->addHours(144);

                $profile->sponsorships()->attach($sponsorshipType->id, ['start_date' => now(), 'end_date' => $end_date_value]);
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
