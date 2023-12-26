@extends('dashboard.user')
@section('title')
    Panier Ventes
@endsection
@section('content')
<div class="container pb-5 mb-2 mb-md-4">
    <div class="row">
    <br><br>
        <!-- List of items-->
        <section class="col-lg-8">
            <form action="{{route('registerVenteProduit')}}" method="POST">
                @csrf
            <div class="d-flex justify-content-between align-items-center pt-3 pb-2 pb-sm-5 mt-1">
            <h2 class="h6 text-light mb-0">Produits</h2>
            
            <button class="btn btn-primary btn-shadow btn-sm pl-2"><i class="czi-card font-size-lg mr-2"></i>Vendre</button>

            </div>
            @if(Session::has('topCart'))
                @foreach(Session::get('topCart') as $produit)
            <!-- Item-->
                <div class="d-sm-flex justify-content-between align-items-center my-4 pb-3 border-bottom">
                <div class="media media-ie-fix d-block d-sm-flex align-items-center text-center text-sm-left">
                <a class="d-inline-block mx-auto mr-sm-4" href="" style="width: 10rem;">
                <img src="{{ asset('/images/produits/' .$produit['produit_image']) }}" alt="Product" width="100"></a>
                    <div class="media-body pt-2">
                    <h3 class="product-title font-size-base mb-2"><small>LIBELLE :</small>{{$produit['produit_name']}}</h3>
                    <div class="font-size-lg text-accent pt-2"><small>PRIX :</small>{{number_format($produit['produit_price'] )}}<small>FCFA</small></div>
                    </div>
                </div>
                <form action="{{route('updateCart', [$produit['produit_id']])}}" method="POST">
                    @method('put')
                    @csrf
                    <div class="pt-2 pt-sm-0 pl-sm-3 mx-auto mx-sm-0 text-center text-sm-left" style="max-width: 9rem;">
                        <div class="form-group mb-0">
                        <label class="font-weight-medium" for="quantity1">Quantité</label>
                        <input class="form-control" type="number" name="qty[{{$produit['produit_id']}}]" id="quantity1" value="{{$produit['qty']}}">
                        </div>
                        <button class="btn btn-link px-0 text-accent" type="submit" ><i class="czi-close-circle mr-2"></i><span class="font-size-sm">Actualiser</span></button>
                    </div>
                    <input type="hidden" name="id[{{$produit['produit_id']}}]" value="{{$produit['produit_id']}}">
                </form>
                
                <div class="pt-1 pt-sm-0 pl-sm-3 mx-auto mx-sm-0 text-center text-sm-left" style="max-width: 9rem;">
                    <a class="btn btn-link px-0 text-danger" href="{{route('removeitem' ,[$produit ['produit_id']])}}"><i class="czi-close-circle mr-2"></i><span class="font-size-sm">Supprimer</span></a>
                </div>
                </div>
                @endforeach
            @endif
            </form>
        </section>
        <!-- Sidebar-->
        <aside class="col-lg-4 pt-4 pt-lg-0">      
            <div class="cz-sidebar-static rounded-lg box-shadow-lg ml-lg-auto">
                <br><br>
                <div class="text-center mb-4 pb-3 border-bottom">
                    <h2 class="h6 mb-3 pb-1">Total</h2>
                    <h3 class="font-weight-normal">{{number_format(Session::get('cart')->totalPrice)}}<small>  FCFA</small></h3>
                </div>
                {{-- <div class="form-group mb-4">
                    <label class="mb-3" for="order-comments"><span class="badge badge-info font-size-xs mr-2">Note</span><span class="font-weight-medium">Additional comments</span></label>
                    <textarea class="form-control" rows="6" id="order-comments"></textarea>
                </div> --}}
                <a class="btn btn-outline-primary btn-block mt-4" href="{{route('homeUser')}}"><i class="czi-arrow-left mr-2"></i>Continuer la vente</a>
            </div>
        </aside>
    </div>
</div>
@endsection