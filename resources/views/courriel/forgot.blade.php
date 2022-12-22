<h1>Hello {{ $user->nom }}</h1>
<p>
   Please click the password reset button to reset your password.
   <a href="{{ url('reset-password/'.$user->courriel.'/'.$code) }}">Reset password</a>
</p>