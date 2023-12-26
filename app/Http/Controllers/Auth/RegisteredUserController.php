<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\fonctions;
use App\Models\entrepots;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $fonctions=fonctions::All();
        $entrepots=entrepots::All();
        $users=User::all();
        return view('auth.register',compact(['fonctions','users','entrepots']));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images/users/'), $imageName);

        $request->validate([
            'nom' => ['string', 'max:25'],
            'prenom' => ['string', 'max:55'],
            'contact' => ['string', 'max:10'],
            'fonction' => ['int'],
            'entrepot' => ['int'],
            'email' => ['string', 'email', 'max:60', 'unique:'.User::class],
            'password' => ['string','max:20'],
        ]);

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'contact' => $request->contact,
            'photo' => $imageName,
            'fonction_id' => $request->fonction,
            'entrepot_id' => $request->entrepot,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect()->route('register');
    }
}
