@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-12 col-sm-8 col-md-6 col-xl-4 py-2">
        <div class="border--gray rounded my-5 p-4">
            <h1 class="display-5 m-2 text-center fs-3">@lang('auth.inscription')</h1>
            <hr>
            <form action="{{route('user.store')}}" method="post" class="p-3">
                @csrf
                <div class="form-group col m-1">
                    <input type="text" class="form__inscription__input" name="nom" placeholder="@lang('auth.nom')" value="{{old('nom')}}">
                    @if($errors->has('nom'))
                    <span class="text-danger">{{ $errors->first('nom') }}</span>
                    @endif
                </div>
                <div class="form-group col m-1">
                    <input type="text" class="form__inscription__input my-2" name="prenom" placeholder="@lang('auth.prenom')" value="{{old('prenom')}}">
                    @if($errors->has('prenom'))
                    <span class="text-danger">{{ $errors->first('prenom') }}</span>
                    @endif
                </div>
                <div class="form-group col m-1">
                    <input type="text" class="form__inscription__input" name="nomUsager" placeholder="@lang('auth.nom_usager')" value="{{old('nomUsager')}}">
                    @if($errors->has('nomUsager'))
                    <span class="text-danger">{{ $errors->first('nomUsager') }}</span>
                    @endif
                </div>
                <div class="control-group col m-1">
                    <input type="text" class="form__inscription__input my-2" name="courriel" placeholder="@lang('auth.email')" value="{{old('courriel')}}">
                    @if($errors->has('courriel'))
                    <span class="text-danger">{{ $errors->first('courriel') }}</span>
                    @endif
                </div>
                <div class="control-group col m-1">
                    <input type="password" class="form__inscription__input" name="password" placeholder="@lang('auth.mot_de_passe')">
                    @if($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="control-group col m-1">
                    <input type="password" class="form__inscription__input my-2" name="password_confirmation" placeholder="@lang('auth.mot_de_passe_confirmation')">
                    @if($errors->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                <input type="hidden" class="form-control" name="privilege_id" value="4">

                <div class="control-group col m-1 d-flex justify-content-center"> <button id="btn-submit" class="btn__inscription">@lang('auth.enregistrer')</button> </div>
            </form>
        </div>
    </div>
</div>

@endsection
