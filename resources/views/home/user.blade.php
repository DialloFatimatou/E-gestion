@extends('dashboard.user')
@section('title')
    Dashboard
@endsection
@section('content')

<!-- content-wrapper  -->
<div class="tab-content home-tab-content">
    <div class="tab-pane fade show active" id="Dashboards-1" role="tabpanel"
        aria-labelledby="Dashboards-tab">
    @if(Session::has('status'))
        <br>
        <div class="alert alert-success">
            {{Session::get('status')}}
        </div>
        @endif
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="card-title">Produits</h4>
                            <div class="d-flex">
                                <button type="button" class="btn btn-outline-primary btn-icon-text my-2 my-lg-0">
                                    <i class="mdi mdi-printer text-extra-small btn-icon-prepend"></i>
                                    Imprimer
                                </button>
                                <button type="button" class="btn btn-primary ml-3  my-2 my-lg-0" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalarticle">Ajouter </button>
                            </div>
                        </div>
                        <div class="mb-4">
                            <i class="mdi mdi-chevron-right"></i></span><span>Listes des Produits </span>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                <input type="hidden" {{$increment=1}}>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="font-weight: bold;">#</th>
                                                <th scope="col" style="font-weight: bold;">Image</th>
                                                <th scope="col" style="font-weight: bold;">Libelle</th>
                                                <th scope="col" style="font-weight: bold;">Prix</th>
                                                <th scope="col" style="font-weight: bold;">Quantite</th>
                                                <th scope="col" style="font-weight: bold;">Catégorie</th>
                                                <th style="font-weight: bold;" class="text-center">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                        @foreach ($affiche_produit as $item)
                                            <tr>
                                                <td>{{$increment}}</td>
                                                <td class="py-1">
                                                    <div class="d-flex align-items-center"><img  src="{{asset('images/produits/'.$item->imageProduit)}}" class="product-icon"alt="image">
                                                    </div>
                                                </td>
                                                <td>
                                                    {{$item->nomProduit}}
                                                </td>
                                                <td>
                                                    {{$item->prixProduit}}
                                                </td>
                                                <td>
                                                    {{$item->quantiteProduit}}
                                                </td>
                                                <td>
                                                    {{$item->categorie->nomCategorie}}
                                                </td>
                                                <td class="text-center">
                                                    <form class="mb-grid-gutter" method="post" action="{{route('addtocart',[$item->id])}}">
                                                    <a class="btn btn-outline-primary btn-rounded btn-info" href="{{ route('select_prod',$item->id)}}">Voir</a> 
                                                        @method('put')
                                                        @csrf
                                                        <button class="btn btn-outline-primary btn-rounded btn-secondary">Ajouter au panier</button>  
                                                    </form>     
                                                </td>
                                            </tr>
                                            <input type="hidden" {{$increment++}}>
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
@endsection

