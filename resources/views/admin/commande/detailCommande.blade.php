@extends('layouts.app-admin')
@section('content')
    <div class="container p-5 col-12 col-lg-10 min-vh-100 bg-light">

        <div class="table-responsive-md card  border-black text-dark">

            <!-- détail client -->
            <div class=" text-dark card-header bg-transparent border-black d-flex justify-content-between  p-5">
                <div>
                    <p>{{ $commande->selectClient->nom }} {{ $commande->selectClient->prenom }}</p>
                    <p>{{ $commande->selectClient->adresse }}</p>
                    <p>{{ $commande->ville }}, {{ $province }}</p>
                    <p>{{ $commande->selectClient->codePostal }}</p>
                    <p>{{ $commande->selectClient->telephone }}</p>
                    <p>{{ $commande->selectClient->courriel }} </p>

                </div>
                <div>
                    <p>@lang('client.numero_commande') : <strong>CO-{{ $commande->numeroDeCommande }}</strong></p>
                    <p>@lang('admin.date_commande') : {{ $commande->created_at->format('Y-m-d') }}</p>
                    @if ($commande->selectStatut->id == 1)
                        <div class="px-5 py-1 my-2 badge badge-warning">@lang('client.status') :
                            <span>{{ $commande->selectStatut->nom }}</span></div>
                    @elseif($commande->selectStatut->id == 2)
                        <p> @lang('admin.mode_paiement') : {{ $commande->selectModePaiement->nom }}</p>
                        <div class="px-5 py-1 my-2 badge badge-success text-dark">@lang('client.status') :
                            <span>{{ $commande->selectStatut->nom }}</span></div>
                    @endif
                </div>
            </div>

            <div class=" card-body text-dark">
                @foreach ($voituresCommandes as $voitureCommande)
                    <div class="d-flex justify-content-between my-3 align-items-center">
                        <div class="d-flex align-items-center ">
                            <div class="vo_img-thumbnail-container  mr-3"><img class="vo_img-thumbnail"
                                    src="{{ asset('assets/img/' . $voitureCommande->imagePrincipale) }}" alt="" />
                            </div>
                            <div>
                                <p class=""> {{ $voitureCommande->marque_nom }}, {{ $voitureCommande->modele_nom }}
                                </p>
                                <p class="- text-dark">{{ $voitureCommande->annee }} |
                                    {{ $voitureCommande->transmission_nom }} | {{ $voitureCommande->carburant_nom }}</p>
                            </div>
                        </div>

                        <div>
                            <p class=""> {{ number_format($voitureCommande->prixAchat * $voitureCommande->marge) }} $
                                </td>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-footer bg-transparent border-black d-flex justify-content-end text-dark">
                <div class="w-50">
                    <div class="d-flex justify-content-between ">
                        <p>@lang('commande.sous_total')</p>
                        <p> {{ number_format($prixSousTotal) }} $</p>
                    </div>
                    <div class="d-flex justify-content-between ">
                        <p>@lang('commande.tps') (5%)</p>
                        <p>{{ number_format($prixSousTotal * 0.05) }} $</p>
                    </div>
                    <div class="d-flex justify-content-between ">
                        <p>@lang('commande.tvq') (9.975%)</p>
                        <p>{{ number_format($prixSousTotal * 0.09975) }} $</p>
                    </div>
                    <div class="d-flex justify-content-between  border-top border-black my-2 pt-2 text-dark">
                        <p style="font-size: 16px; font-weight:bold;">@lang('admin.total')</p>
                        <p style="font-size: 16px; font-weight:bold;">{{ number_format($prixTotal) }} $</p>
                    </div>
                </div>
            </div>

        </div>
        <!-- Finaliser la commande -->
        <div class="text-dark card p-4  border-black mt-4 table-responsive-md align-items-center">
            <div>
                @if ($commande->selectStatut->id == 1)
                        <form method="POST" action="">
                            @method('PUT')
                            @csrf
                            @foreach ($paiements as $paiement)
                                <div class="d-flex justify-content-between ">
                                    <label for="paiement">{{ $paiement->nom }}</label>
                                    <input type="checkbox" name="paiement_id" id='paiement' value="{{ $paiement->id }}">
                                </div>
                            @endforeach
                            <button class='btn btn-outline-success mt-1'>@lang('admin.finaliser')</button>
                        </form>
                @endif
            </div>

            <div>
                @if ($commande->selectStatut->id == 2)
                <a href="{{route('facture.pdf' , $commande->id)}}" class="btn__commander font-weight-bold d-flex "> 
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-file-pdf p-2"></i>
                        <p class=""> @lang('client.telecharger_facture')</p>
                    </div>
                </a> 
                @endif  
            </div>

        </div>
    </div>

@endsection('content')