<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\entrepots;
use Illuminate\Http\Request;
use App\Models\produits;

class produitControllers extends Controller
{
// Affichage Produit
public function index(){ 
     $affiche_categorie = categories::all();
     $affiche_produit = produits::all();
     $entrepots = entrepots::all();
     return view('produit.produits',[

     'affiche_categorie' => $affiche_categorie,
     'affiche_produit' => $affiche_produit,
     'entrepots' => $entrepots ,
]);
}
// Affichage categories
public function indexCat(){ 
     // cette requete me permet d'afficher les categories
     $affiche_categorie = categories::all();
     return view('produit.categories',[
          'affiche_categorie' => $affiche_categorie,
     ]);
}     

//Enregistre une categorie dans la DB

public function AjoutCat(Request $request)
{
$categorie= new categories();
$categorie->nomCategorie = $request->input('nomCategorie');
$categorie->save();

return back()->with("status", "Votre catégorie a été crée avec succés");
}
//update categories
public function editCat($id,){
     $categorie = categories::find($id);
}

public function updateCat($id,Request $request){
     $categorie = categories::find($id);
     $categorie->nomCategorie = $request->input('nomCategorie');

     $categorie->update();
     return back()->with("status", "Votre catégorie a été  modifiée avec succés");
}

public function deletecategorie($id){
     $categorie = categories::find($id);
     $categorie->delete();

     return back()->with("status", "Votre catégorie a été  supprimée avec succés");
}

//   //Selection d'un produit dans la BD en fonction de l'ID     
//   public function select($id){
//        $produit = DB::table('produits')->where('id','=',$id)->first();
//        // $affiche_taille_produit = DB::table('taille_produits')->where('ref_produit','=',$ref_produit)->get();
//        return view('gerant.detail-produit',[
//             'produit'=>$produit,
//             // 'affiche_taille_produit'=>$affiche_taille_produit
//          ]);
//   }

//Enregistre un produit dans la DB
public function AjoutProduit(Request $request)
{
     if ($request->hasFile('image')) {
          $image = $request->file('image');
          $imageName = time().'.'.$image->getClientOriginalExtension();
          $image->move(public_path('images/produits/'), $imageName);
          
     }
     //var_dump($imageName); die();
     $produit = new produits();
     $produit->imageProduit = $imageName;
     $produit-> qrProduit = rand(999999999, 100000000);
     $produit-> nomProduit = $request-> nom;
     $produit-> descriptionProduit = $request-> desc;
     $produit-> prixProduit = $request-> prix;
     $produit-> quantiteProduit = $request-> qtite;
     $produit-> categorie_id = $request-> categorie;
     $produit->entrepot_id= $request->entrepot;
     $produit->save();

     return back()->with("status", "Votre produit a été  enregistré avec succés");
}

public function deleteProduit($id){
     $produit =  produits::find($id);
     $produit->delete();

     return back()->with("status", "Votre produit a été  supprimé avec succés");
}
public function updateProduit($id, Request $request){
     if ($request->hasFile('image')) {
          $image = $request->file('image');
          $imageName = time().'.'.$image->getClientOriginalExtension();
          $image->move(public_path('images/produits/'), $imageName);
          
     }
     $produit =  produits::find($id);
     $produit->imageProduit = $imageName;
     $produit-> nomProduit = $request-> nom;
     $produit-> descriptionProduit = $request-> desc;
     $produit-> prixProduit = $request-> prix;
     $produit-> quantiteProduit = $request-> qtite;
     $produit-> categorie_id = $request-> categorie;
     $produit->entrepot_id= $request->entrepot;
     
     $produit->update();
     return back()->with("status", "Votre produit a été  modifiée avec succés");
}


// Affichage des produits de la station de l'utilisateur
public function homeUser()
{  
return view('home.user');
}
public function homeAdmin()
{
return view('home.admin');
}

}
