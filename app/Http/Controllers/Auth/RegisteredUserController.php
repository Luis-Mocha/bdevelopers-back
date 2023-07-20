<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

// importo i modelli
use App\Models\Admin\Field;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // importo i field dal modello Field
        $fields = Field::all();

        // dd($fields, 'hello');

        return view('auth.register', compact('fields'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(

            [
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:' . User::class,
                'address' => 'required|string|max:255',
                'fields' => 'required',
                'password' => 'required|confirmed'
            ],

            // 'name' => ['required', 'string', 'max:255'],
            // 'surname' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            // 'address' => ['required', 'string', 'max:255'],
            // 'fields' => ['required'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],

            [
                'name.required' => 'Il campo "nome" è obbligatorio',
                'surname.required' => 'Il campo "cognome" è obbligatorio',
                'email.required' => 'Il campo "email" è obbligatorio',
                'address.required' => 'Il campo "address" è obbligatorio',
                'password.required' => 'Il campo "password" è obbligatorio',

                'email.unique' => 'Questa email è già utilizzata da un altro utente',

                'password.confirmed' => 'La password non corrisponde'
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        //Controllo checked Fields
        if ($request->has('fields')) {

            $user->fields()->attach($request->fields);
        }

        // dd($user, $request);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
