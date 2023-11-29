@extends('dashboard.admin')
@section('title')
    Categories
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
                                <h4 class="card-title">Categories</h4>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-outline-primary btn-icon-text my-2 my-lg-0">
                                        <i class="mdi mdi-printer text-extra-small btn-icon-prepend"></i>
                                        Imprimer
                                    </button>
                                    <button type="button" class="btn btn-primary ml-3  my-2 my-lg-0"
                                     data-bs-toggle="modal"
                                     data-bs-target="#exampleModalcategorie" href="">Ajouter</button>
                                </div>
                            </div>
                            @php
                            // compte le nombre 
                            $total = 0;
                            $categCount = count($affiche_categorie);
                            @endphp
                            <div class="mb-4">
                                <span class="pr-2"><i
                                        class="mdi mdi-chevron-right"></i></span><span>Nombre Categories : {{ $categCount }} </span>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <input type="hidden" {{ $increment = 1 }}>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="font-weight: bold;">#</th>
                                                    <th scope="col" style="font-weight: bold;"></th>
                                                    <th scope="col" style="font-weight: bold;"></th>
                                                    <th scope="col" style="font-weight: bold;">Libelle Catégorie</th>
                                                    <th scope="col" style="font-weight: bold;"></th>
                                                    <th scope="col" style="font-weight: bold;"></th>
                                                    <th scope="col" style="font-weight: bold;"></th>
                                                    <th style="font-weight: bold;" class="text-center">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @if ($affiche_categorie->isEmpty())
                                                    <tr>
                                                        <td colspan="9" style="text-align: center">Aucune Categorie Enregister</td>
                                                    </tr>
                                               @else --}}
                                                @foreach ($affiche_categorie as $resultat)
                                                    <tr>
                                                        <td>{{ $increment }}</td>
                                                        <td></td>
                                                        <td></td>

                                                        <td>{{ $resultat->nomCategorie }}</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>

                                                        <td class="text-center">
                                                            <button class="btn btn-outline-primary btn-rounded btn-success" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalupdate{{ $resultat->id }}">Modifier</button>
                                                                <button data-bs-target="#deleteCategorie{{ $resultat->id }}" class="btn btn-outline-primary btn-rounded btn-danger" data-bs-toggle="modal">Supprimer</button>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal update categories-->
                                                    <div class="modal fade" id="exampleModalupdate{{ $resultat->id }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        Enregistrement de categories</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <div class="modal-body p-3">
                                                                    <form method="post"
                                                                        action="{{ url('update_categorie/' . $resultat->id) }}">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Categorie</label>
                                                                            <input type="text"
                                                                                value="{{ $resultat->nomCategorie }}"
                                                                                name="nomCategorie"
                                                                                class="form-control " required>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Fermer</button>
                                                                            <button type="submit" class="btn btn-outline-primary  btn-success"
                                                                                data-bs-dismiss="modal">Modifier</button>
                                                                        </div>
                                                                    </form> <!-- Form END -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                    </div>
                                    <input type="hidden" {{ $increment++ }}>
                                    <!-- Modal delete categories-->
                                    <div class="modal fade" id="deleteCategorie{{ $resultat->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                        Supprimer la categorie</h1>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-3">
                                                    <form method="POST"
                                                        action="{{ url('delete_categorie/' . $resultat->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <p>Êtes-vous sûr de vouloir supprimer cet
                                                            {{ $resultat->nomCategorie }} ?</p>
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
                                    <!-- endModal delete categories-->
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

    <!-- Modal ajout categories-->
    <div class="modal fade" id="exampleModalcategorie" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Enregistrement de categories</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-3">
                    <form method="post" action="{{ route('ajout_categorie') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Categorie</label>
                            <input type="text" name="nomCategorie" class="form-control "
                                placeholder="Nom categorie" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary ml-3  my-2 my-lg-0"  data-bs-dismiss="modal">Ajouter une
                                categorie</button>
                        </div>
                    </form> <!-- Form END -->
                </div>
            </div>
        </div>
    @endsection
