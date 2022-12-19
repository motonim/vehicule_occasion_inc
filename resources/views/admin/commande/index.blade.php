@extends('layouts.app-admin')
@section('content')
    <div class="container p-5 bg-light col-12 col-lg-10 min-vh-100">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="fs-2 text-dark">@lang('admin.list_commande')</h1>
            {{-- Recherche de la commande  --}}
            <form action="">
                <div class="input-group  ">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="@lang('admin.recherche')" aria-label="Username"
                        aria-describedby="basic-addon1">
                </div>
            </form>

        </div>

        <p class='font-color-grey text-avant-768px'>@lang('admin.scroll')</p>
        <!-- Tableau des Commandes -->
        <div class="table-responsive-md">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">@lang('admin.numero_commande')</th>
                        <th scope="col" class="pe-4">@lang('admin.client')</th>
                        <th scope="col" class="pe-4">@lang('auth.email')</th>
                        <th scope="col" class="ps-3 pe-5">@lang('admin.status')</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($commandes as $commande)
                        <tr>

                            <th scope="row">CO-{{ $commande->numeroDeCommande }}</th>
                            <td class="img-td-container w-25">{{ $commande->selectClient->nom }}
                                {{ $commande->selectClient->prenom }}</td>
                            <td>{{ $commande->selectClient->courriel }}</td>
                            <td class="text-nowrap ps-3">{{ $commande->selectStatut->nom }}</td>

                            <td class="align-start">
                                <div class="d-flex justify-content-end align-items-center">
                                    <!-- bouton affiche détail commande-->
                                    <a class="btn__border mr-2" href="{{ route('commande.show', $commande->id) }}">
                                        <i class="fa-regular fa-folder-open font-color-yellow"></i>
                                    </a>

                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection('content')
