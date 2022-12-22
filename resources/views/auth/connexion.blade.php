@extends('layouts.app')
@section('content')
<!-- <div class="container"> -->
    <div class="d-flex justify-content-center">
        <div class="col-12 col-sm-8 col-md-6 col-xl-4 py-2">
            <div class="border--gray rounded my-5 p-4">
                <h1 class="display-5 m-2 text-center fs-3">@lang('auth.connexion')</h1>
                <hr>
                <form action="{{route('connexion.authentication')}}" method="post" class="p-3">
                    @csrf
                    @foreach($errors->all() as $error)
                        <span class="text-danger">{{ $error }}</span><br>
                    @endforeach

                    @if(session('success'))
                        <div class="alert alert-danger">{{ session('success')}}</div>
                    @endif
                        <div class="form-row d-flex justify-content-between">
                        <div class="control-group col m-1">
                            <input type="email" class="form__connexion__input" name="courriel" placeholder="@lang('auth.email')" value="{{old('courriel')}}">
                        </div>
                    </div>
                    <div class="form-row d-flex justify-content-center">
                        <div class="control-group col m-1">
                            <input type="password" class="form__connexion__input" name="password" placeholder="@lang('auth.mot_de_passe')">
                        </div>
                    </div>
                    <div class="row">
                        <a class="ml-3 my-2 text-secondary" href="{{ route('connexion.forgot') }}">@lang('auth.forgot-password')</a>
                    </div>
                    <div class="row mt-2">
                        <div class="control-group col m-1 d-flex justify-content-center"> <button id="btn-submit" class="btn__connexion">@lang('auth.connexion')</button> </div>
                    </div>
                    <div class="row mt-3 align-items-center flex-column">
                        <p class='pb-2'>@lang('auth.noaccount')</p>
                        <a class="text-center btn__border" href="{{ route('user.registration')}}">
                            @lang('auth.inscription')
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- </div> -->
@endsection
