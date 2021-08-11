<?php

namespace App\Controllers;

use App\Models\Product;


class ProductController extends CoreController {

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function products()
    {
        $products = Product::findAll();

        $this->show('product/products', [
            'products' => $products,
        ]);
    }

    public function newProductForm()
    {
        $this->show('product/productForm');
    }

    public function updateProductForm($id)
    {
        // On recupere le contenu d'un produit via son id

        // On l'envoie vers la vue
        $product = Product::find($id);

        if($product) {
            $this->show('product/productForm', [
                'product' => $product,
            ]);
        } else {
            dd('Id non trouvée dans la BDD');
        }
        
    }
}
