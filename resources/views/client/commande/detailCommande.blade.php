@extends('layouts.app')
@section('content')
<div class="container p-5 col-12 col-lg-10 min-vh-100">
    <div class="d-flex justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb vo_bg-primary pl-0">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">VO</a></li>
                <li class="breadcrumb-item"><a href="#">{{ auth()->user()->nomUsager }}</a></li>
                <li class="breadcrumb-item"><a href="{{route('commande.index')}}">@lang('client.list_commande')</a></li>
                <li class="breadcrumb-item active" aria-current="page">CO-{{ $commande->numeroDeCommande }}</li>
            </ol>
        </nav>

        @if($commande->selectStatut->id == 1)
        <a class="btn btn-outline-danger mb-4 mt-1" href="{{route('commande.annulation', $commande->id)}}">@lang('client.annuler')</a>
        @endif

    </div>

    <div class="table-responsive-md card vo_bg-primary border-white">
        <!-- détail client -->
        <div class=" card-header bg-transparent border-white d-flex justify-content-between text-white p-5">
            <div>
                <p>{{ $commande->selectClient->nom }} {{ $commande->selectClient->prenom }}</p>
                <p>{{ $commande->selectClient->adresse }}</p>
                <p>{{ $commande->provinceVille->ville_nom }}, {{ $commande->provinceVille->province_nom }}</p>
                <p>{{ $commande->selectClient->codePostal }}</p>

            </div>
            <div>
                <!-- <p>{{ $commande->selectClient->telephone }}</p> -->
                <!-- <p>{{ $commande->selectClient->courriel }} </p> -->
                <p>@lang('client.numero_commande') : <strong>CO-{{ $commande->numeroDeCommande }}</strong></p>
                <p>@lang('admin.date_commande') : {{ $commande->created_at->format('Y-m-d') }}</p>
                @if($commande->selectStatut->id == 1)
                <div class="px-5 py-1 my-2 badge badge-warning">@lang('client.status') : <span>{{ $commande->selectStatut->nom }}</span></div>
                @elseif($commande->selectStatut->id == 2)
                <p> @lang('admin.mode_paiement') : {{ $commande->selectModePaiement->nom }}</p>
                <div class="px-5 py-1 my-2 badge badge-success text-dark">@lang('client.status') : <span>{{ $commande->selectStatut->nom }}</span></div>
                @endif
            </div>

        </div>

        <div class="text-white card-body">
            @foreach ($voituresCommandes as $voitureCommande)
            <div class="d-flex justify-content-between my-3 align-items-center">
                <div class="d-flex align-items-center">
                    <div class="vo_img-thumbnail-container text-white mr-3"><img class="vo_img-thumbnail" src="{{ asset('assets/img/' . $voitureCommande->imagePrincipale) }}" alt="" /></div>
                    <div>
                        <p class=""> {{ $voitureCommande->marque_nom }}, {{ $voitureCommande->modele_nom }}</p>
                        <p class="text-white-50">{{ $voitureCommande->annee }} | {{ $voitureCommande->transmission_nom }} | {{ $voitureCommande->carburant_nom }}</p>
                    </div>
                </div>

                <div>
                    <p class=""> {{ number_format($voitureCommande->prixAchat * $voitureCommande->marge) }} $ </td>
                </div>
            </div>
            @endforeach
        </div>
        <div class="card-footer bg-transparent border-white d-flex justify-content-end">
            <div class="w-50">
                <div class="d-flex justify-content-between text-white">
                    <p>@lang('commande.sous_total')</p>
                    <p> {{ number_format($prixSousTotal) }} $</p>
                </div>
                <div class="d-flex justify-content-between text-white">
                    <p>@lang('commande.tps') (5%)</p>
                    <p>{{ number_format($prixSousTotal * 0.05) }} $</p>
                </div>
                <div class="d-flex justify-content-between text-white">
                    <p>@lang('commande.tvq') (9.975%)</p>
                    <p>{{ number_format($prixSousTotal * 0.09975) }} $</p>
                </div>
                <div class="d-flex justify-content-between text-white border-top border-white my-2 pt-2">
                    <p style="font-size: 16px; font-weight:bold;">@lang('admin.total')</p>
                    <p style="font-size: 16px; font-weight:bold;">{{ number_format($prixTotal) }} $</p>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection('content')
