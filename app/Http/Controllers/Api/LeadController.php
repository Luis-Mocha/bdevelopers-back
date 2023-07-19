<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Lead;
use Illuminate\Http\Request;

use App\Mail\NewContact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $data = $request->all();

        // VALIDAZIONE
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        // VALIDAZIONE NON ANDATA A BUON FINE
        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors()
                ]
            );
        }

        // SALVATAGGIO DATI NEL DB
        // $new_lead = new Lead();
        // $new_lead->fill($data);
        // $new_lead->save();

        $new_lead = Lead::create($data);

        // INVIO DELLE MAIL
        Mail::to('info@boolfolio.it')->send(new NewContact($new_lead));

        // OTTENERE UNA RISPOSTA POSITIVA IN JSON
        return response()->json(
            [
                'success' => true
            ]
        );
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
