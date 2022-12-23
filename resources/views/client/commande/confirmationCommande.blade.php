<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #e29101;
            color: #fff;
        }
        .facture-container{
            border: 1px solid #ddd;
            padding: 3vw; 

            
        }
    </style>
</head>
<body>   	

<p>@lang('facture.bonjour')</p>
<p>@lang('facture.confirmation')</p>

<div class="facture-container" >
    <table class="order-details">
        
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h3 class="text-start">VEHICULES D’OCCASION INC.</h3>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    
                    <span>@lang('admin.date_commande') : {{ $commande->created_at->format('Y-m-d') }}</span> <br>
                    <span>{{ $commande->adresse }}, {{ $commande->ville }},
                        {{ $province }}</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">@lang('facture.commande_detail')</th>
                <th width="50%" colspan="2">@lang('facture.client_detail')</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>@lang('facture.facture_num') :</td>
                <td>CO-{{$commande->numeroDeCommande}}</td>

                <td>@lang('facture.nom_prenom'):</td>
                <td>{{ $commande->selectClient->nom }} {{ $commande->selectClient->prenom }}</td>
            </tr>
            <tr>
                
                <td>@lang('admin.mode_paiement'):</td>
                <td> {{$commande->selectModePaiement->nom}}</td>

                <td>@lang('auth.email')</td>
                <td>{{ $commande->selectClient->courriel }}</td>
            </tr>
            <tr>
                <td>@lang('admin.date_commande')</td>
                <td>{{ $commande->created_at->format('Y-m-d') }}</td>

                <td>@lang('auth.telephone') </td>
                <td>{{ $commande->selectClient->telephone }}</td>

            </tr>
                       
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="4">
                    @lang('facture.voiture')
                </th>
            </tr>
            <tr class="bg-blue">
                <th>@lang('voiture.annee')</th>
                <th>@lang('voiture.marque')</th>
                <th>@lang('voiture.modele')</th>
                <th>@lang('voiture.prix')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($voituresCommandes as $voitureCommande)
            <tr>
                <td width="10%">{{ $voitureCommande->annee  }}</td>
                <td>{{ $voitureCommande->marque_nom }} </td>
                <td>{{ $voitureCommande->modele_nom }}</td>                           
                <td width="15%" class="fw-bold"> {{ number_format($voitureCommande->prixAchat * $voitureCommande->marge) }} $</td>
            </tr>
            @endforeach
            
            <tr>
                <td colspan="3" >@lang('commande.sous_total') :</td>
                <td colspan="1" >{{ number_format($prixSousTotal) }} $</td>
            </tr>
            <tr>
                <td colspan="3" >@lang('commande.tps') :</td>
                <td colspan="1" >(5%)</td>
            </tr>
            
            <tr>
                <td colspan="3" >@lang('commande.tvq') :</td>
                <td colspan="1" >(9.975%)</td>
            </tr>
            <tr>
                <td colspan="3" class="total-heading">@lang('admin.total') :</td>
                <td colspan="1" class="total-heading">{{ number_format($prixTotal) }} $</td>
            </tr>
        </tbody>
    </table>
</div>

    <br>
    <p class="text-center">
        @lang('facture.facture_fin')
    </p>

</body>
</html>