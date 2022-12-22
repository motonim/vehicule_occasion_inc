@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-6 py-2">
       <div class="card bg-dark">
         <div class="card-header">
            Reset Password
         </div>
         <div class="card-body">
            <h2>{{ $user->courriel }}</h2>
            <form action="{{ route('connexion.resetPassword', [$user->courriel, $code]) }}" method="POST">
               @csrf

               @if(count($errors) > 0)
                  @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
               @endif

               <div class="form-group">
                  Password:<br>
                  <input type="password" name="password" id="password">
               </div>

               <div class="form-group">
                  Confirm Password:<br>
                  <input type="password" name="password_confirmation" id="password_confirmation">
               </div>

               <button type="submit">Reset password</button>

            </form>
         </div>
       </div>
    </div>
</div>

@endsection
