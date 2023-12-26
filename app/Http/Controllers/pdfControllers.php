<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\categories;
use App\Models\produits;

use Illuminate\Http\Request;

class pdfControllers extends Controller
{
    public function seeproduits()
    {

        // Session::put('id', $id);

        // try{
        $pdf = produits::make('dompdf.wrapper')->setPaper('a4', 'landscape');
        $pdf->loadHTML($this->convert_orders_data_to_html());

        return $pdf->stream();
        // }
        // catch(Exception $e){
        //     return redirect('produit.produits')->with('error', $e->getMessage());
        // }

    }

    public function convert_orders_data_to_html()
    {
        $output = '<link rel="stylesheet" href="frontend/css/style1.css">
            <table class="table">
                <thead class="thead-primary">
                    <tr class="text-center">
                        <th>qr</th>
                        <th>Libélle</th>
                        <th>prix</th>
                    </tr>
                </thead>
                <tbody>';

            foreach (produits::all() as $item) {

                $output .= '<tr class="text-center">
                                <td class="product-name">
                                    <h3>' . $item->qrProduit . '</h3>
                                </td>
                                <td class="price">' . $item->nomProduit . '</td>
                                <td class="qty">' . $item->prixProduit . 'FCFA</td>
                            </tr><!-- END TR-->
                            </tbody>';
            }

        $output .= '</table>';
        return $output;
    }
}
