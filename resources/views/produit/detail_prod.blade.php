@extends('dashboard.user')
@section('title')
    Detail Produits
@endsection
@section('content')
{{-- Detail Produits --}}
<!-- Page Content-->
<div class="container">
<!-- Gallery + details-->      
<div class="bg box-shadow-lg rounded-lg px-4 py-3 mb-5">
<h2>{{$produit->nomProduit}}</h2>
<div class="px-lg-3">
    <div class="row">
    <!-- Product gallery-->
    <div class="col-lg-7 pr-lg-0 pt-lg-4">
        <div class="cz-product-gallery">
        <div class="cz-preview order-sm-2">
        </div>
        <div class="cz-thumblist order-sm-1">
        <a class="cz-thumblist-item active" href="">
        <img src="{{ asset('/images/produits/' . $produit->imageProduit) }}" alt="Product thumb" width="500">
        </a></div>
        </div>
    </div>
    <!-- Product details-->
        <div class="col-lg-5 pt-4 pt-lg-0">
        <form class="mb-grid-gutter" method="post" action="{{route('addtocart',[$produit->id])}}">
            @method('put')
            @csrf
            <div class="product-details ml-auto pb-3">             
            <div class="d-flex justify-content-between align-items-center mb-2"><a href="#reviews" data-scroll>
                <div class="star-rating"><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star-filled active"></i><i class="sr-star czi-star"></i>
                </div><span class="d-inline-block font-size-sm text-body align-middle mt-1 ml-1"></span></a>
                {{-- <button class="btn-wishlist mr-0 mr-lg-n3" type="button" data-toggle="tooltip" title="Add to wishlist"><i class="czi-heart"></i></button> --}}
            </div>
            <div class="mb-3"><span class="h3 font-weight-normal text-accent mr-1">{{$produit->prixProduit}}<small> FCFA </small></span>
            </div>
                <div class="form-group d-flex align-items-center">
                <button type="submit" class="btn btn-primary btn-shadow btn-block" ><i class="czi-cart font-size-lg mr-2"></i>Ajouter au panier</button>
                </div>
            <!-- Product panels-->
            <div class="accordion mb-4" id="productPanels">
                <div class="card">
                <div class="card-header">
                    <h3 class="accordion-heading"><a href="#productInfo" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="productInfo"><i class="czi-announcement text-muted font-size-lg align-middle mt-n1 mr-2"></i>Information du produit<span class="accordion-indicator"></span></a></h3>
                </div>
                <div class="collapse show" id="productInfo" data-parent="#productPanels">
                    <div class="card-body">
                    <h6 class="font-size-sm mb-2">Composition</h6>
                    {{-- @foreach ($produit as $result) --}}
                        <ul class="font-size-sm pl-4">
                            <li>{{ $produit->descriptionProduit }}</li>
                        </ul>
                        <h6 class="font-size-sm mb-2">Art. Numero : {{ $produit->id}}</h6>
                        <ul class="font-size-sm pl-4 mb-0">
                            <li>Categories :  {{ $produit->categorie->nomCategorie}}</li>
                        </ul>
                    {{-- @endforeach --}}
                    </div>
                </div>
                </div>
            
            </div>
        </form>
        </div>
    </div>
</div>
</div>
</div>
@endsection