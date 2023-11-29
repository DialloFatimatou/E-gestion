@extends('dashboard.super_admin')
@section('title')
Entrepôts    
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
                    <h4 class="card-title">Entrepôts</h4>
                    <div class="d-flex">
                        {{-- <button type="button" class="btn btn-outline-primary btn-icon-text my-2 my-lg-0">
                            <i class="mdi mdi-printer text-extra-small btn-icon-prepend"></i>
                            Imprimer
                        </button> --}}
                        <button type="button" class="btn btn-primary ml-3  my-2 my-lg-0" data-bs-toggle="modal"
                            data-bs-target="#exampleModalarticle">Ajouter </button>
                    </div>
                </div>
                @php
                // compte le nombre 
                $total = 0;
                $entrepotCount = count($entrepots);
                @endphp
                <div class="mb-4">
                   <span class="pr-2"><i
                            class="mdi mdi-chevron-right"></i></span><span> Nombre d'entrepôts : {{ $entrepotCount }}</span>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                        <input type="hidden" {{$increment=1}}>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="font-weight: bold;">#</th>
                                        <th scope="col" style="font-weight: bold;">Libelle</th>
                                        <th scope="col" style="font-weight: bold;">Email</th>
                                        <th scope="col" style="font-weight: bold;">Contact</th>
                                        <th style="font-weight: bold;" class="text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($entrepots as $result)
                                    <tr>
                                        <td>{{$increment}}</td>
                                        <td>
                                            {{$result->nomEntrepot}}
                                        </td>
                                        <td>
                                            {{$result->emailEntrepot}}
                                        </td>
                                        <td>
                                            {{$result->contactEntrepot}}
                                        </td>
                                        <td class="text-center">
                                            {{-- <button class="btn btn-outline-primary btn-rounded btn-success">Modifier</button>            --}}
                                                <form action="" method="POST" style="display:inline">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-outline-primary btn-rounded btn-danger">Supprimer</button>
                                                </form>
                                            <a class="btn btn-outline-primary btn-rounded btn-success" href="">Produits</a>
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
<!-- content-wrapper ends -->
    </div>
</div> 
<!-- Modal ajout entrepot-->
<div class="modal fade" id="exampleModalarticle" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Enregistrement d'entrepôt</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <form method="post" action="{{ route('ajout_entrepot') }}"  enctype="multipart/form-data">
                        @csrf                 
                        <div class="mb-3">
                            <label class=" fw-bold form-label">Libelle</label>
                            <input type="text" name="nomEntrepot" class="form-control "  required>
                        </div>
                        <div class="mb-3">
                            <label class=" fw-bold form-label">Email</label>
                            <input type="text" name="adress" class="form-control"  required>
                        </div>
                        <div class="mb-3">
                            <label class=" fw-bold form-label">Contact</label>
                            <input type="text" name="contact" class="form-control"  required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary ml-3  my-2 my-lg-0" data-bs-dismiss="modal">Ajouter</button>
                        </div>
                    </form> <!-- Form END -->         
        </div>
    </div>
</div>  
@endsection

   