@extends('dashboard.admin')
@section('title')
    Commandes
@endsection
@section('content')
    <!-- content-wrapper  -->
    <div class="tab-content home-tab-content">
        <div class="tab-pane fade show active" id="Dashboards-1" role="tabpanel" aria-labelledby="Dashboards-tab">
            @if (Session::has('status'))
                <br>
                <div class="alert alert-success">
                    {{ Session::get('status') }}
                </div>
            @endif
            <br><br>
            <div class="row">
                <div class="col-md-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h4 class="card-title">Commandes</h4>
                                @php
                                    $total =0;
                                    foreach ($cmd as $key) {
                                        $total += ($key->produits->prixProduit * $key->quantiteCmdProd);
                                    }
                                @endphp
                                <h3>Total : {{ $total }} FCFA</h3>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="font-weight: bold;">#</th>
                                                    <th scope="col" style="font-weight: bold;">Image</th>
                                                    <th scope="col" style="font-weight: bold;">Libelle</th>
                                                    <th scope="col" style="font-weight: bold;">description</th>
                                                    <th scope="col" style="font-weight: bold;">Prix</th>
                                                    <th scope="col" style="font-weight: bold;">Quantite</th>
                                                    <th scope="col" style="font-weight: bold;">Statut</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i=0;
                                                    $j=1;
                                                @endphp
                                                @foreach ($cmd as $items)
                                                    <tr>
                                                        <td>
                                                            {{$i+=$j}}
                                                        </td>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><img
                                                                    src="{{asset('images/produits/'.$items->produits->imageProduit)}}" class="product-icon"
                                                                    alt="image">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{$items->produits->nomProduit}}
                                                        </td>
                                                        <td>
                                                            {{$items->produits->descriptionProduit}}
                                                        </td>
                                                        <td>
                                                            {{$items->produits->prixProduit}} FCFA
                                                        </td>
                                                        <td>
                                                            {{$items->quantiteCmdProd}}
                                                        </td>
                                                        <td>
                                                            {{$items->statutCmdProd}}
                                                            {{$items->statutCmdProdenat}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    </div>
    </div>
@endsection

