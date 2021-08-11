<?php

namespace App\Controllers;
use App\Models\Category;
use App\Models\Product;


// Si j'ai besoin du Model Category
// use App\Models\Category;

class MainController extends CoreController {

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {
        $homeCategories = Category::findSome();
        $homeProducts = Product::findSome();
        // On appelle la méthode show() de l'objet courant
        // En argument, on fournit le fichier de Vue
        // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller
        $this->show('main/home', [
            'homeCategories' => $homeCategories,
            'homeProducts' => $homeProducts,
        ]);
    }
}
