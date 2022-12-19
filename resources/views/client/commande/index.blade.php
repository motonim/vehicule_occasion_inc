@extends('layouts.app')
@section('content')
<div class="container p-5 col-12 col-lg-10 min-vh-100">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb vo_bg-primary pl-0">
            <li class="breadcrumb-item"><a href="{{route('accueil')}}">VO</a></li>
            <li class="breadcrumb-item"><a href="#">{{ auth()->user()->nomUsager }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('client.list_commande')</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fs-2">@lang('client.list_commande')</h1>
    </div>

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
@endsection('content')
