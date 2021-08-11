<?php

namespace App\Controllers;

use App\Models\Category;






class CategoryController extends CoreController
{

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function categories()
    {
        // Je veux recuperer le liste de toutes les categories
        // sous la forme d'un tableau d'objets
        $categories = Category::findAll();

        $this->show('category/categories', [
            'categories' => $categories,
        ]);
    }

    public function newCategory()
    {
        $this->show('category/categoryForm');
    }
    public function updateCategoryForm($id)
    {
        // On recupere le contenu d'un produit via son id

        // On l'envoie vers la vue
        $category = Category::find($id);

        if ($category) {
            $this->show('category/categoryForm', [
                'category' => $category,
            ]);
        } else {
            dd('Id non trouvée dans la BDD');
        }
    }
    public function categoryFormValid($id = 0)
    {
        // Dans le cas d'un update : On recupere le contenu d'un produit via son id

        // dans le cas d'un         // TODO : il faut récupérer les données du $_POST


        // On envoies les info du POST au model

        //envoie vers la vue
        $category = new Category();
        // TODO utiliser les setters pour mettre "peupler" les propriétés
        $category->insert();
        dd($category);

        $this->show('category/categoryFormValid', [
            'category' => $category,
        ]);
    }
}
