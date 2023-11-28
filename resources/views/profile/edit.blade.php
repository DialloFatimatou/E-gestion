
@extends(Auth::user()->fonction_id == 2 ? 'dashboard.user' : 'dashboard.admin')
@section('title')
Edit Profil   
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Formulaire d'Enregistrement</h4>
                <form class="cmxform" id="signupForm" method="post" action="{{route('profile.update',$user->id)}}" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <div class="form-group">
                            <label for="firstname">Nom</label>
                            <input id="nom" class="form-control" name="nom" type="text" value="{{ $user->nom }}">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Prénoms</label>
                            <input id="prenom" class="form-control" name="prenom" type="text" value="{{ $user->prenom }}">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Contact</label>
                            <input id="contact" class="form-control" name="contact" type="text" value="{{ $user->contact }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" class="form-control" name="email" type="email" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label class="input-group-text" for="inputGroupFile01">Photo</label>
                            <input type="file" class="form-control" id="inputGroupFile01" name="image">                      
                        </div>
                        <div class="form-group">
                            <label for="password">Nouveau mot de passe</label>
                            <input id="password" class="form-control" name="password" type="password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirmez le mot de passe</label>
                            <input id="confirm_password" class="form-control" name="confirm_password" type="password">
                        </div>
                        <button class="btn btn-primary" type="submit" value="Submit">Modifier</button>
                    </fieldset>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
  <br><br><br>
  <br><br><br>
@endsection
