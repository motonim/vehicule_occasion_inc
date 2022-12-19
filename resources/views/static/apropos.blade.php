@extends('layouts.app')
@section('content')

    <div class="container py-5">
        <h2 class='py-3'>@lang('apropos.titre')</h2>
        <div class="d-flex justify-content-center my-4">
            <img src="{{asset('assets/img/apropos.jpg')}}" alt="" class='img__apropos'>
        </div>
        <div class="row mt-5">
            <div class="col-12 col-md-4">
                <p>@lang('apropos.apropos1')</p>
                <p class='pt-3'>@lang('apropos.apropos2')</p>
            </div>
            <div class="col-12 col-md-4 mt-avant-768">
                <p>@lang('apropos.apropos3')</p>
            </div>
            <div class="col-12 col-md-4 mt-avant-768">
                <p>@lang('apropos.apropos4')</p>
            </div>
        </div>
    </div>
@endsection('content')