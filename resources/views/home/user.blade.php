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
                                {{-- <li class="nav-item nav-search d-none d-sm-block">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="search">
                                                <i class="mdi mdi-magnify"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="search" aria-label="search"
                                            aria-describedby="search" id="myInput">
                                    </div>
                                </li> --}}
                                <button type="button" class="btn btn-outline-primary btn-icon-text my-2 my-lg-0">
                                    <i class="mdi mdi-printer text-extra-small btn-icon-prepend"></i>
                                    Imprimer
                                </button>
                                <button type="button" class="btn btn-primary ml-3  my-2 my-lg-0" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalarticle">Ajouter </button>
                            </div>
                        </div>
                        <div class="mb-4">
                            <span class="pr-2">Dashboard</span><span class="pr-2"><i
                                    class="mdi mdi-chevron-right"></i></span><span>Produits </span>
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
                                                {{-- <th scope="col" style="font-weight: bold;">Quantite</th> --}}
                                                <th scope="col" style="font-weight: bold;">Catégorie</th>
                                                <th style="font-weight: bold;"></th>
                                                <th style="font-weight: bold;" class="text-center">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                     
                                            <tr>
                                                <td>{{$increment}}</td>
                                                <td class="py-1">
                                                    <div class="d-flex align-items-center"><img  src="" class="product-icon"alt="image">
                                                    </div>
                                                </td>
                                                <td>
                                                   
                                                </td>
                                                <td>
                                                   
                                                </td>
                                                {{-- <td>
                                                    {{$item->quantite}}
                                                </td> --}}

                                                <td>
                                                   
                                                </td>
                                                <td>

                                                </td>
                                                
                                                <td class="text-center">
                                                    <a class="btn btn-outline-primary btn-rounded btn-success" href="">Voir</a>    
                                                    <a class="btn btn-outline-primary btn-rounded btn-secondary" href="">Ajouter au panier</a>       
                                                </td>
                                            </tr>
                                            <input type="hidden" {{$increment++}}>
                                       
                                            
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

@section('script')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/filtre.js')}}"></script> 
<script> 
$(document).ready(function () {
    $("#myInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

</script> 
@endsection
