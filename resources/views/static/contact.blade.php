@extends('layouts.app')
@section('content')

<div class="container py-5">
   <h2 class='py-3'>@lang('formContact.contactez_nous')</h2>
   <div class="row align-items-center">
      <div class="col-12 col-md-6">
            <form action="" class='form__contactez'>
               <p class='form__accueil__titre'>@lang('formContact.laissez_message')</p>
               <input type="text" class='form__accueil__input' placeholder="@lang('auth.nom')" name="nom" id="nom">
               <input type="email" class='form__accueil__input' placeholder="@lang('auth.email')" name="courriel" id="courriel">
               <input type="number" class='form__accueil__input' placeholder="@lang('auth.telephone')" name="phone" id="phone">
               <textarea name="message" class='form__accueil__input' id="message" cols="30" rows="4">@lang('formContact.message')</textarea>
               <button type="submit" class='btn__soumettre mt-3'>@lang('formContact.soumettre')</button>
            </form>
      </div>
      <div class="col-12 col-md-6">
            <div class="bg__contactez-info">
               <p><i class="fa-solid fa-envelope font-color-yellow mr-2"></i> info@vo.ca</p>
               <p><i class="fa-solid fa-phone font-color-yellow mr-2 py-3"></i> 514 254 7131</p>
               <p><i class="fa-solid fa-location-dot font-color-yellow mr-2"></i> 3800 R. Sherbrooke E, Montréal, QC, H1X 2A2</p>
               <p><i class="fa-solid fa-clock font-color-yellow mr-2 pt-3"></i> Lun - Sam 09:00 - 19:00</p>
            </div>
      </div>
   </div>
</div>
@endsection('content')