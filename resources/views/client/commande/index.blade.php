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
                    <div class="table-responsive-md card vo_bg-primary border-white mt-4">
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
                        <div class="card-footer bg-transparent border-white d-flex justify-content-end">
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
            <div class="accordion-body">
                <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
            </div>
        </div>
    </div>




    <!-- <div class="d-flex justify-content-between align-items-center">
        <h1 class="fs-2">@lang('client.list_commande')</h1>
    </div> -->

    
</div>
@endsection('content')
