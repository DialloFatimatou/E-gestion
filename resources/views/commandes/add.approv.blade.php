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
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h4 class="card-title">Approvisionnements</h4>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-primary ml-3  my-2 my-lg-0" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalarticle">Ajouter </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <input type="hidden" {{ $increment = 1 }}>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="font-weight: bold;">#</th>
                                                    <th scope="col" style="font-weight: bold;">Libelle produit</th>
                                                    <th scope="col" style="font-weight: bold;">Quantité</th>
                                                    <th scope="col"><a href="" class="btn btn-sn btn-success rounded-circle add_more"  aria-label="Plus">
                                                    <i class="mdi mdi-plus-circle btn-icon-prepend"></i></a></th>
                                                </tr>
                                            </thead>
                                            <tbody class="addMoreProduct">
                                                <tr>
                                                    <td>1</td>
                                                    <td>
                                                        <select name="produit" id="produit_id" class="form-control produit_id">
                                                            @foreach ($produits as $prod)
                                                                <option value="{{ $prod->id }}">
                                                                    {{ $prod->libelle_produit }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="quantite[]" id="quantite"  class="form-control">
                                                    </td>
                                                    <td><a href="#" class="preview btn btn-sn btn-danger rounded-circle" aria-label="Close">
                                                    <i  class="btn-close"></i></a></td>
                                                </tr>
                                                <input type="hidden" {{ $increment++ }}>
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
@section('script')
    <script>
        // $(document).ready(function(){

        // })
        $('.add_more').on('click', function() {
            event.preventDefault(); // Empêche le comportement par défaut du bouton
            var produits = $('.produit_id').html();
            var numberofrow = $('.addMoreProduct tr').length + 1;
            var tr = '<tr><td class="no">' + numberofrow + '</td>' +
                '<td><select class="form-control produit_id" name="produit_id[]">' + produits +
                '</select></td>' +
                '<td> <input type="number" name="quantite[]" id="quantite" class="form-control"></td>' +
                '<td> <a class="btn btn-danger btn-sn delete rounded-circle"><i class="btn-close"></i></a></td></tr>';
            $('.addMoreProduct').append(tr);
        });
        //delete a row
        $('.addMoreProduct').delegate('.delete', 'click', function() {
            $(this).parent().parent().remove();
        })
    </script>
@endsection
