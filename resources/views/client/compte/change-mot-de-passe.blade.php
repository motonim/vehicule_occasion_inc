@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-6 py-2">
       <div class="card bg-dark">
         <div class="card-header">
            Change password
         </div>
         <div class="card-body">
            <form action="" id="" medthod="post">
               @csrf
               <div class="form-group">
                  <label for="old_password">Old Password</label>
                  <input type="password" name="old_password" id="old_password" class="form-control">
               </div>

               <div class="form-group">
                  <label for="password">New Password</label>
                  <input type="password" name="new_password" id="new_password" class="form-control">
               </div>

               <div class="form-group">
                  <label for="confirm_password">Confirm Password</label>
                  <input type="password" name="confirm_password" id="confirm_password" class="form-control">
               </div>

               <button type="submit" class="btn__inscription">Update password</button>
            </form>
         </div>
       </div>
    </div>
</div>

@endsection
