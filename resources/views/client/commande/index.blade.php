@extends('layouts.app')
@section('content')
<div class="container py-5 min-vh-100">
    <!-- <nav>
        <ol class="breadcrumb vo_bg-primary pl-0">
            <li class="p-3 mr-3 border--gray border-radius__5px"><a href="#">@lang('client.votre_compte')</a></li>
            <li class="pr-3"><a href="#">{{ auth()->user()->nomUsager }}</a></li>
            <li class="p-3 border--gray border-radius__5px" aria-current="page">@lang('client.list_commande')</li>
        </ol>
    </nav> -->

    <div class="accordion py-5" id="accordionExample">
        <div class="accordion-item border--gray border-radius__5px p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        @lang('client.list_commande')
                    </button>
                </h2>
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fa-solid fa-chevron-down text-white"></i>
                </button>
            </div>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    @if($mesCommandes->isEmpty())
                    <!-- TODO fr/en -->
                    <div class="mt-5 text-white-50" style="font-size: 16px;">@lang('client.message_aucune_commande')</div>
                    @else
                    @foreach ($mesCommandes as $maCommande)
                    <div class="table-responsive-md card vo_bg-primary mt-4">
                        <!-- détail client -->
                        <div class=" card-header bg-transparent d-flex justify-content-between text-white p-5">
                            <div>
                                <p>@lang('client.numero_commande') : <strong>CO-{{ $maCommande->numeroDeCommande }}</strong></p>
                                <p>@lang('admin.date_commande') : {{ $maCommande->created_at->format('Y-m-d') }}</p>
                                @if($maCommande->selectStatut->id == 1)
                                <div class="px-5 py-1 my-2 badge badge-warning">@lang('client.status') : <span>{{ $maCommande->selectStatut->nom }}</span></div>
                                @elseif($maCommande->selectStatut->id == 2)
                                <p> @lang('admin.mode_paiement') : {{ $maCommande->selectModePaiement->nom }}</p>
                                <div class="px-5 py-1 my-2 badge badge-success text-dark">@lang('client.status') : <span>{{ $maCommande->selectStatut->nom }}</span></div>
                                @endif
                            </div>
                            <div>
                                <div class="d-flex justify-content-between text-white my-2 pt-2">
                                    <p style="font-size: 16px; font-weight:bold;">@lang('client.nb_items') : {{$maCommande->nbVoitures}}</p>
                                </div>
                                <div class="d-flex justify-content-between text-white border-top border-white my-2 pt-2">
                                    <p style="font-size: 16px; font-weight:bold;">@lang('client.total') : {{ number_format($maCommande->prixTotal) }}$</p>
                                </div>
                            </div>
                        </div>
                        <div class="border--gray"></div>
                        <div class="card-footer bg-transparent d-flex justify-content-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <!-- bouton affiche détail commande-->
                                <a class="btn__border m-2" href="{{ route('commande.detail', $maCommande->id) }}">@lang('client.voir_commande')</a>
                            </div>
                        </div>

                    </div>

                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="accordion-item border--gray border-radius__5px p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        @lang('client.votre_compte')
                    </button>
                </h2>
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <i class="fa-solid fa-chevron-down text-white"></i>
                </button>
            </div>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body pt-3">
                    <div class="form-group col m-1">
                        <strong>@lang('auth.nom')</strong>
                        <input type="text" class="form__inscription__input" name="nom" placeholder="@lang('auth.nom')" value="{{$user->nom}}">
                    </div>
                    <div class="form-group col mx-1 my-2">
                        <strong>@lang('auth.prenom')</strong>
                        <input type="text" class="form__inscription__input" name="prenom" placeholder="@lang('auth.prenom')" value="{{$user->prenom}}">
                    </div>
                    <div class="form-group col m-1">
                        <strong>@lang('auth.nom_usager')</strong>
                        <input type="text" class="form__inscription__input" name="nomUsager" placeholder="@lang('auth.nom_usager')" value="{{$user->nomUsager}}">
                    </div>
                    <div class="control-group col mx-1 my-2">
                        <strong>@lang('auth.courriel')</strong>
                        <input type="text" class="form__inscription__input" name="courriel" placeholder="@lang('auth.email')" value="{{$user->courriel}}">
                    </div>
                    <div class="d-flex justify-content-between p-3">
                        <a href="{{ route('user.modification', $user->id) }}" class="btn__border p-2">@lang('auth.modifier')</a>
                        <a href="" class="btn btn-outline-danger p-2">@lang('auth.supprimer')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection('content')
