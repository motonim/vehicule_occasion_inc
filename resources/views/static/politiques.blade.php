@extends('layouts.app')
@section('content')

   <div class="container py-5">
      <h2>@lang('politiques.titre')</h2>
      <div class="py-3">
         <p>@lang('politiques.p1')</p>
         <ul class="pt-2 pl-5 list-style-circle">
            @lang('politiques.li1')
         </ul>
      </div>
      <div class="py-3">
         <h3 class="py-3 text-underline">@lang('politiques.h3_1')</h3>
         <p>@lang('politiques.p2')</p>
         <ul class="pt-2 pl-5 list-style-circle">
            @lang('politiques.li2')
         </ul>
      </div>
      <div class="py-3">
         <h3 class="py-3 text-underline">@lang('politiques.h3_2')</h3>
         <p>@lang('politiques.p3')</p>
      </div>
      <div class="py-3">
         <h3 class="py-3 text-underline">@lang('politiques.h3_3')</h3>
         <p>@lang('politiques.p4')</p>
         <p class="py-3">@lang('politiques.p5')</p>
         <p>@lang('politiques.p6')</p>
         <ul class="py-2 pl-5 list-style-circle">
            @lang('politiques.li3')
         </ul>
         <p>@lang('politiques.p7')</p>
      </div>
      <div class="py-3">
         <h3 class="py-3 text-underline">@lang('politiques.h3_4')</h3>
         <p>@lang('politiques.p8')</p>
         <p class="pt-3">@lang('politiques.p9')</p>
      </div>
      <div class="py-3">
         <h3 class="py-3 text-underline">@lang('politiques.h3_5')</h3>
         <p>@lang('politiques.p10')</p>
      </div>
      <div class="py-3">
         <h3 class="py-3 text-underline">@lang('politiques.h3_6')</h3>
         <p>@lang('politiques.p12')</p>
         <p class="pt-3">@lang('politiques.p13')</p>
      </div>
   </div>
@endsection('content')