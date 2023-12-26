@extends('dashboard.super_admin')
@section('title')
Register    
@endsection
@section('content')

    {{-- affichage des utilisateurs --}} 
    <div class="content-wrapper">
        <br><br>
        <div class="row">
            <div class="col-md-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="card-title">Utilisateurs</h4>
                            <div class="d-flex">
                                <button type="button" class="btn btn-outline-primary btn-icon-text my-2 my-lg-0">
                                    <i class="mdi mdi-printer text-extra-small btn-icon-prepend"></i>
                                    Imprimer
                                </button>
                                <button type="button" class="btn btn-primary ml-3  my-2 my-lg-0" data-bs-toggle="modal" data-bs-target="#exampleModal1">Ajouter</button>
                            </div>
                        </div>
                        @php
                            // compte le nombre d'utilisateur
                            $total = 0;
                            $userCount = count($users);
                        @endphp
                        <div class="mb-4">
                            <span class="pr-2">Nombre d'utilisateur : {{ $userCount }}</span>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="font-weight: bold;">#</th>
                                                <th scope="col" style="font-weight: bold;">photo</th>
                                                <th scope="col" style="font-weight: bold;">Nom</th>
                                                <th scope="col" style="font-weight: bold;">Prénom</th>
                                                <th scope="col" style="font-weight: bold;">Contact</th>
                                                <th scope="col" style="font-weight: bold;">Email</th>
                                                <th scope="col" style="font-weight: bold;">Fonction</th>
                                                <th scope="col" style="font-weight: bold;"></th>
                                                <th style="font-weight: bold;" class="text-center">
                                                    Action
                                                </th>
                                                <th scope="col" style="font-weight: bold;"></th>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i=0;
                                                $j=1;
                                            @endphp
                                            @if ($users->isEmpty())
                                                <tr>
                                                    <td colspan="9" style="text-align: center">Auccun utilisateur Enregister</td>
                                                </tr>
                                            @else
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>
                                                            {{$i+=$j}}
                                                        </td>
                                                        <td class="py-1">
                                                            <div class="d-flex align-items-center"><img
                                                                    src="{{asset('images/users/'.$user->photo)}}" class="product-icon" alt="image">
                                                                
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{$user->nom}}
                                                        </td>
                                                        <td>
                                                            {{$user->prenom}}
                                                        </td>
                                                        <td>
                                                            {{$user->contact}}
                                                        </td>
                                                        <td>
                                                            {{$user->email}}
                                                        </td>
                                                        <td>
                                                            {{$user->fonctions->nomFonction}}
                                                        </td>
                                                        <td>  </td>
                                                        <td>
                                                            <a href="">
                                                                <button class="btn btn-outline-primary btn-rounded btn-secondary">Modifier</button>
                                                            </a>
                                                            <a href="">
                                                                <button class="btn btn-outline-primary btn-rounded  btn-danger">Supprimer</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
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

    {{-- formulaire d'enregistrement d'un utilisateur --}}
    <div class="modal fade" id="exampleModal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Formulaire d'Enregistrement</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <form method="post" action="{{url('register')}}"  enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="firstname">Nom</label>
                                    <input id="nom" class="form-control" name="nom" type="text">
                                </div>
                                <div class="mb-3">
                                    <label for="lastname">Prénoms</label>
                                    <input id="prenom" class="form-control" name="prenom" type="text">
                                </div>
                                <div class="mb-3">
                                    <label for="lastname">Contact</label>
                                    <input id="contact" class="form-control" name="contact" type="text">
                                </div>
                                <br>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input id="email" class="form-control" name="email" type="email">
                                </div>
                            </div>                   
                       
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="fw-bold form-label" >Photo</label>
                                    <input type="file" class="form-control" id="inputGroupFile01" name="image">                      
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold form-label">Fonction</label>
                                    <select class="form-select" id="inputGroupSelect01" name="fonction">
                                        <option selected disabled>Choix de la fonction</option>
                                        @foreach($fonctions as $fonction)
                                        <option value="{{$fonction->id}}">{{$fonction->nomFonction}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="mb-3">
                                    <label for="password">Mot de passe</label>
                                    <input id="password" class="form-control" name="password" type="password">
                                </div>
                                <br>
                                <div class="mb-3">
                                    <label for="confirm_password">Confirmez le mot de passe</label>
                                    <input id="confirm_password" class="form-control" name="confirm_password" type="password">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Entrepôt</label>
                            <select class="form-select" id="inputGroupSelect01" name="entrepot">
                                <option selected>Choix d'un Entrepôt</option>
                                @foreach ($entrepots as $affiche)
                                 <option value="{{ $affiche->id }}"><a href="entrepots.php">{{ $affiche->nomEntrepot }}</a></option>
                               @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button class="btn btn-primary" type="submit" value="Submit">Enregister</button>               
                        </div>
                    </form>        
                </div>
            </div>
        </div>
    </div>
@endsection

