<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use App\Models\super_admins;
use App\Models\User;

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

    // Vérification si la table est vide

    public function store(Request $request)
    {

        $pConAdmin = super_admins::all();
        if ($pConAdmin->isEmpty()) {
            $pConAdmin = new super_admins();
            $pConAdmin->nomS = "super admin";
            $pConAdmin->emailS = "superadmin@gmail.com";
            $pConAdmin->passwordS = Hash::make("12345678");
            $pConAdmin->save();
        }

        $admin = super_admins::where('emailS', $request->email)
            ->first();

        if ($admin && Hash::check($request->password, $admin->passwordS)) {
            Auth::login($admin);
            $request->session()->regenerate();
            if (Auth::check()) {
                return redirect()->route("superAdmins");
            }
        } else {
            $user = User::where('email', $request->email)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                if (Auth::user()->fonction_id == 1) {
                    $request->session()->regenerate();
                    return redirect()->route('homeAdmin');
                } elseif (Auth::user()->fonction_id == 2) {
                    $request->session()->regenerate();
                    return redirect()->route('homeUser');
                } else {
                    return redirect()->route('login');
                }
            } else {
                return "cet utilisateur n'existe pas";
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
}