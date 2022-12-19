<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;


class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.connexion');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.inscription');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|min:2|max:191',
            'prenom' => 'required|min:2|max:191',
            'nomUsager' => 'required|min:2|max:191|unique:users',
            'courriel' => 'required|email|unique:users',
            'password' => ['required', 'max:20', Password::min(4)
                ->mixedCase()
                ->letters(),
            ],
            'password_confirmation' => 'required_with:password',

        ]);


        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();


        return redirect('connexion')->withSuccess('Utilisateur créé avec succès');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function authentication(Request $request)
    {
        $request->validate([
            'courriel' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('courriel', 'password');

        // return $credentials;
        // die();

        if (!Auth::validate($credentials)) :
            return redirect('connexion')
                ->withErrors(trans('auth.failed'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user, $remember = true);

        $privilege = Auth::user()->privilege_id;
        // die();

        if ($privilege == 1 || $privilege == 2 || $privilege == 3) {
            return redirect('dashboard');
        }
        else if ($privilege == 4) {
            return redirect()->intended('catalogue');
        }
    }


    public function logout()
    {
        Session::flush();
        // Session::save();
        Auth::logout();
        return redirect('connexion');
    }
}
