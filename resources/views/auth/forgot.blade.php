@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-6 py-2">
       <div class="card bg-dark">
         <div class="card-header">
            Forgot password?
         </div>
         <div class="card-body">
            <form action="{{ route('connexion.password') }}" method="POST">
               @csrf

               @if(session('error'))
                  <div>{{ session('error')}}</div>
               @endif

               @if(session('success'))
                  <div>{{ session('success')}}</div>
               @endif

               <div class="form-group">
                  <input type="email" name="email" id="email">
                  <button type="submit">Submit</button>
               </div>
            </form>
         </div>
       </div>
    </div>
</div>

@endsection
