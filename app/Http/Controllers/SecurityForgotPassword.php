<?php

namespace App\Http\Controllers;

use App\Models\User;
use Mail;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Reminder;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;

class SecurityForgotPassword extends Controller
{
    public function forgot(){
        return view('auth.forgot');
    }

    public function password(Request $request){
        // dd($request->all());
        $user = User::whereCourriel($request->email)->first();
        // $user = DB::table('users')
        //         ->where('courriel', '=', $request->email)
        //         ->get();
        // dd($user);

        if($user == null){
            return redirect()->back()->with(['error' => "Ce courriel n'existe pas"]);
        }

        $user = Sentinel::findById($user->id);
        // dd($user);
        $reminder = Reminder::exists($user) ? : Reminder::create($user);
        // dd($reminder->code);
        $this->sendEmail($user, $reminder->code);

        return redirect()->back()->with(['success' => 'Reset code sent to your email.']);
    }

    public function sendEmail($user, $code) {
        Mail::send(
            'courriel.forgot',
            ['user' => $user, 'code' => $code],
            function($message) use ($user){
                $message->to($user->courriel);
                $message->subject("$user->nom, reset your password.");
            }
        );
    }

    public function reset($email, $code) {
        $user = User::whereCourriel($email)->first();
    
        if($user == null){
            echo "Email doesn't exist";
        }

        $user = Sentinel::findById($user->id);
        $reminder = Reminder::exists($user, $code);

        // dd($reminder);
        // print_r($code);
        // echo "<br>";
        // print_r($reminder->code);
        // die();
        if($reminder) {
            return view('auth.reset_password_form')->with(['user'=>$user, 'code'=>$code]);

            // if($code == $reminder->code) {
            // }
            // else {
            //     return redirect('/');
            // }
        } else {
            echo 'Time has expired';
        }
    }

    public function resetPassword(Request $request, $email, $code) {
        // dd($request);
        $this->validate($request, [
            'password' => ['required', 'max:20', Password::min(4)
                ->mixedCase()
                ->letters(),
            ],
            'password_confirmation' => 'required_with:password',        
        ]);

        $user = User::whereCourriel($email)->first();

        if($user == null) {
            echo "Email does not exist";
        };

        $user = Sentinel::findById($user->id);
        $reminder = Reminder::exists($user, $code);

        if($reminder) {
            Reminder::complete($user, $code, $request->password);
                return redirect('/connexion')->with('success', 'Password has been reset. Please login with new password.');
                
            // if($code == $reminder->code){
                // Reminder::complete($user, $code, $request->password);
                // return redirect('/connexion')->with('success', 'Password has been reset. Please login with new password.');
            // } else {
            //     return redirect('/');
            // }
        }else {
            echo "time expired";
        }

    }
}
