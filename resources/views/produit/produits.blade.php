@extends('dashboard.admin')
@section('title')
    Produits
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
                @php
                // compte le nombre 
                $total = 0;
                $prodCount = count($affiche_produit);
                @endphp
                <div class="mb-4">
                    <span class="pr-2"><i
                            class="mdi mdi-chevron-right"></i></span><span>Nombre Produits : {{  $prodCount }} </span>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <input type="hidden" {{ $increment = 1 }}>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="font-weight: bold;">#</th>
                                        <th scope="col" style="font-weight: bold;">Image</th>
                                        <th scope="col" style="font-weight: bold;">Libelle</th>
                                        <th scope="col" style="font-weight: bold;">Prix</th>
                                        <th scope="col" style="font-weight: bold;">Description</th>
                                        <th scope="col" style="font-weight: bold;">Quantite</th>
                                        <th scope="col" style="font-weight: bold;">Alert_Stock</th>
                                        <th scope="col" style="font-weight: bold;">Catégorie</th>
                                        <th scope="col" style="font-weight: bold;">Entrepôt</th>
                                        <th style="font-weight: bold;" class="text-center">
                                            Action
                                        </th>
                                        <th style="font-weight: bold;"></th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    {{-- @if ($produits->isEmpty())
                                    <tr>
                                        <td colspan="9" style="text-align: center">Auccun produit Enregister</td>
                                    </tr>
                                @else --}}
                                    @foreach ($affiche_produit as $result)
                                        <tr>
                                            <td>{{ $increment }}</td>
                                            <td class="py-1">
                                                <div class="d-flex align-items-center"><img
                                                        src="{{ asset('images/produits/' . $result->image) }}"
                                                        class="product-icon"alt="image">
                                                </div>
                                            </td>
                                            <td>
                                                {{ $result->nomProduit }}
                                            </td>
                                            <td>
                                                {{ $result->prixProduit }}
                                            </td>
                                            <td>
                                                {{ $result->descriptionProduit }}
                                            </td>
                                            <td>
                                                {{ $result->quantiteProduit }}
                                            </td>
                                            <td>
                                                @if ($result->quantite <= 40)
                                                    <span class="badge badge-danger">Faible stock >
                                                        {{ $result->alert_stock }}</span>
                                                @else
                                                    <span class="badge badge-success">
                                                        {{ $result->alert_stock }} </span>
                                                @endif
                                            </td>

                                            <td>
                                                {{ $result->categories->nomCategorie}}
                                            </td>
                                            <td>
                                                {{-- {{ $result->entrepots->nomEntrepot }} --}}
                                            </td>
                                            <td class="text-center">
                                                <button data-bs-target="#editProduit{{ $result->id }}" class="btn btn-outline-primary btn-rounded btn-success" data-bs-toggle="modal">Modifier</button>
                                                <button data-bs-target="#deleteProduit{{ $result->id }}" class="btn btn-outline-primary btn-rounded btn-danger" data-bs-toggle="modal">Supprimer</button>
                                            </td>
                                        </tr>
                                        <input type="hidden" {{ $increment++ }}>
                                <!-- Modal edit produit-->
                                <div class="modal fade" id="editProduit{{ $result->id }}"
                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                    aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                    Modifier un produit </h1>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-3">
                                                <form method="post" action="{{ route('update_produit/'. $result->id) }}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label class=" fw-bold form-label">Libelle</label>
                                                        <input type="text" name="nom" class="form-control " value="{{ $result->nomProduit }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class=" fw-bold form-label">Prix</label>
                                                        <input type="text" name="prix" class="form-control " value="{{ $result->prixProduit }}" required>
                                                    </div>
                            
                                                    <div class="mb-3">
                                                        <label class="fw-bold form-label">Image</label>
                                                        <input type="file" name="image" class="form-control " value="{{ $result->imageProduit }}" required>
                                                    </div>
                                                    {{-- <div class="mb-3">
                                                        <label class="fw-bold form-label">Alert Stock</label>
                                                        <input type="text" name="alert_stock" class="form-control" required>
                                                    </div> --}}
                                                    <div class="mb-3">
                                                        <label class="fw-bold form-label">Description</label>
                                                        <textarea name="desc" id="" cols="30" rows="2" class="form-control "></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="fw-bold form-label">Categorie</label>
                                                        <select class="form-select d-inline" aria-label="Default select example" name="categorie">
                                                            <option selected disabled>Selectionner une categorie</option>
                                                            @foreach ($affiche_categorie as $affiche)
                                                                <option value="{{ $affiche->id }}"><a
                                                                        href="categories.php">{{ $affiche->nomCategorie }}</a></option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="fw-bold form-label">Entrepôt</label>
                                                        <select class="form-select d-inline" aria-label="Default select example" name="entrepot">
                                                            <option selected disabled>Selectionner un Entrepôt</option>
                                                            @foreach ($entrepots as $affiche)
                                                                <option value="{{ $affiche->id }}"><a
                                                                        href="entrepots.php">{{ $affiche->nomEntrepot }}</a></option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                        <button type="submit" class="btn btn-outline-primary  btn-success" data-bs-dismiss="modal">Modifier</button>
                                                    </div>
                                                </form> <!-- Form END -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- endModal edit produit-->
                                        <!-- Modal delete produit-->
                                        <div class="modal fade" id="deleteProduit{{ $result->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            Supprimer le produit</h1>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-3">
                                                        <form method="POST"
                                                            action="{{ route('delete_produit/' . $result->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <p>Êtes-vous sûr de vouloir supprimer cet
                                                                {{ $result->nomProduit }} ?</p>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Fermer</button>
                                                                <button type="submit" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">Supprimer</button>
                                                            </div>
                                                        </form> <!-- Form END -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- endModal delete produit-->
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
<!-- Modal ajout Produit-->
<div class="modal fade" id="exampleModalarticle" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="exampleModalLabel1" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Enregistrement de produit</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-3">
            <form method="post" action="{{ route('ajout_produit') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class=" fw-bold form-label">Libelle</label>
                    <input type="text" name="nom" class="form-control " required>
                </div>
                <div class="mb-3">
                    <label class=" fw-bold form-label">Prix</label>
                    <input type="text" name="prix" class="form-control " required>
                </div>
                <div class="mb-3">
                    <label class=" fw-bold form-label">Quantité</label>
                    <input type="text" name="qtite" class="form-control " required>
                </div>
                <div class="mb-3">
                    <label class="fw-bold form-label">Image</label>
                    <input type="file" name="image" class="form-control " required>
                </div>
                <div class="mb-3">
                    <label class="fw-bold form-label">Description</label>
                    <textarea name="desc" id="" cols="30" rows="2" class="form-control "></textarea>
                </div>
                <div class="mb-3">
                    <label class="fw-bold form-label">Categorie</label>
                    <select class="form-select d-inline" aria-label="Default select example" name="categorie">
                        <option selected disabled>Selectionner une categorie</option>
                        @foreach ($affiche_categorie as $affiche)
                            <option value="{{ $affiche->id }}"><a
                                    href="categories.php">{{ $affiche->nomCategorie }}</a></option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="fw-bold form-label">Entrepôt</label>
                    <select class="form-select d-inline" aria-label="Default select example" name="entrepot">
                        <option selected disabled>Selectionner un Entrepôt</option>
                        @foreach ($entrepots as $affiche)
                            <option value="{{ $affiche->id }}"><a
                                    href="entrepot.php">{{ $affiche->nomEntrepot }}</a></option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary ml-3  my-2 my-lg-0"  data-bs-dismiss="modal">Ajouter un
                        produit</button>
                </div>
            </form> <!-- Form END -->
        </div>
    </div>
</div>
@endsection
