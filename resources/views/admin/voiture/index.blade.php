@extends('layouts.app-admin')
@section('content')
    <div class="container p-5 bg-light col-12 col-lg-10 min-vh-100">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="fs-2 text-dark">@lang('admin.inventaire')</h1>
            <a class="btn__border" href="{{ route('voiture.ajout') }}">
                <i class="fa-solid fa-plus fs-5 font-color-yellow"></i>
            </a>
        </div>

        <p class='font-color-grey text-avant-768px'>@lang('admin.scroll')</p>
        <!-- Tableau de produits -->
        <div class="table-responsive-md">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="pe-4">@lang('admin.img')</th>
                        <th scope="col" class="pe-4">@lang('admin.modele')</th>
                        <th scope="col" class="pe-4">@lang('admin.marque')</th>
                        <th scope="col" class="pe-4">@lang('admin.prix_achat')</th>
                        <th scope="col" class="ps-3 pe-5">@lang('admin.marge')</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($voitures as $voiture)
                        <tr>
                            <th scope="row">VO-{{ $voiture->id }}</th>
                            <td class="img-td-container w-25"><img class="img-thumbnail"
                                    src="{{ asset('assets/img/' . $voiture->imagePrincipale) }}" alt="" /></td>
                            <td>{{ $voiture->modele_nom }}</td>
                            <td>{{ $voiture->marque_nom }}</td>
                            <td>{{ $voiture->prixAchat }} $</td>
                            <td class="text-nowrap ps-3">{{ ($voiture->marge - 1) * 100 }} %</td>

                            <td class="align-start">

                                <!--si la voiture n'a pas une commande  ou elle etait dans une commande avec statut reservé  mais elle est devenu disponible  on affiche les button pour la modifie ou la supprimer -->
                                @if ($voiture->commande_id == null)
                                    <div class="d-flex justify-content-end align-items-center">
                                        <!-- bouton modification-->
                                        <a class="btn__border mr-2"
                                            href="{{ route('voiture.modification', $voiture->id) }}">
                                            <i class="fa-solid fa-pencil font-color-yellow"></i>
                                        </a>
                                        @if (Auth::user()->privilege_id == 2 || Auth::user()->privilege_id == 1)
                                            <!-- bouton suppression -->
                                            <a class="btn btn-outline-danger"
                                                href="{{ route('voiture.suppression', $voiture->id) }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        @endif
                                    </div>
                                @else
                                    <p>@lang('voiture.non_disponible')</p> 
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection('content')
