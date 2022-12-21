@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-12 col-sm-8 col-md-6 col-xl-4 py-2">
        <div class="border--gray rounded my-5 p-4">
            <h1 class="display-5 m-2 text-center fs-3">@lang('auth.modifier')</h1>
            <hr>
            <form method="post" class="p-3">
            @method('PUT')
                @csrf
                <div class="form-group col m-1">
                    @lang('auth.nom')
                    <input type="text" class="form__inscription__input" name="nom" placeholder="@lang('auth.nom')" value="{{ $user->nom }}">
                    @if($errors->has('nom'))
                    <span class="text-danger">{{ $errors->first('nom') }}</span>
                    @endif
                </div>
                <div class="form-group col m-1">
                    @lang('auth.prenom')
                    <input type="text" class="form__inscription__input my-2" name="prenom" placeholder="@lang('auth.prenom')" value="{{ $user->prenom }}">
                    @if($errors->has('prenom'))
                    <span class="text-danger">{{ $errors->first('prenom') }}</span>
                    @endif
                </div>
                <div class="form-group col m-1">
                    @lang('auth.nom_usager')
                    <input type="text" disabled class="form__inscription__input bg-secondary bg-gradient" name="nomUsager" placeholder="@lang('auth.nom_usager')" value="{{ $user->nomUsager }}">
                </div>
                <div class="control-group col m-1">
                    @lang('auth.email')
                    <input type="text" class="form__inscription__input my-2" name="courriel" placeholder="@lang('auth.email')" value="{{ $user->courriel }}">
                    @if($errors->has('courriel'))
                    <span class="text-danger">{{ $errors->first('courriel') }}</span>
                    @endif
                </div>
                <div class="control-group col m-1">
                    @lang('auth.mot_de_passe')
                    <input type="password" disabled class="form__inscription__input bg-secondary bg-gradient" name="password" value="{{ $user->password }}">
                    @if($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <input type="hidden" class="form-control" name="privilege_id" value="4">

                <div class="control-group col mt-3 d-flex justify-content-center"> 
                    <button id="btn-submit" type="submit" class="btn__inscription">@lang('auth.sauvegarder')</button> 
                </div>

                <div class="control-group col mt-3 d-flex justify-content-center"> 
                    <a href="{{ route('user.changeMDP', $user->id) }}" class="btn__border">@lang('auth.re_mot_de_passe')</a> 
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
