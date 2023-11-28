<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\super_admins;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $superAdmin = super_admins::all();

        $super_admin = "";

        foreach ($superAdmin as $item) {
            if ($request->email == $item->emailS) {
                $super_admin = $request->email;
            }
        }

        $utilisateur = DB::table('super_admins')
            ->where('emailS', $request->email)
            ->where('passwordS', $request->password)
            ->first();
        // dd($utilisateur);
        // die();

        // mise en place des condions d'authentication en fonction de la table super_admins

        if ($super_admin) {
            session_start();
            Session::put('superAdmin', $utilisateur);
            return redirect()->route('superAdmins');
        } else {

            // mise en place des condions d'authentication en fonction de la table fonction


            $request->authenticate();
            if (Auth::user()->fonction_id == 1) {
                $request->session()->regenerate();
                return redirect()->route('homeAdmin');
            } elseif (Auth::user()->fonction_id == 2) {
                $request->session()->regenerate();
                return redirect()->route('homeUser');
            } else {
                return view('erreur');
            }
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function deco(Request $request)
    {
        Session::forget('utilisateur');

        return redirect('/');
    }
}
