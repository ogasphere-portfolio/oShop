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

    public function displayNewCategory()
    {
        $this->show('category/categoryForm');
    }
    
    public function displayUpdateCategory($id)
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

    public function createCategory()
    {
        global $router;
        // Recuperer le contenu du formulaire
        // Valider le contenu du formulaire
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $subtitle = filter_input(INPUT_POST, 'subtitle', FILTER_SANITIZE_STRING);
        $picture = filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_STRING);
        
        // @TODO
        // Ajout possible d'un test pour une valeur du formulaire egale
        // a null ou false

        // J'instancie une nouvelle categorie vide
        $newCategory = new Category();

        // Je remplis ma categorie avec les données du formulaire
        $newCategory->setName($name);
        $newCategory->setSubtitle($subtitle);
        $newCategory->setPicture($picture);

        // Inserer le contenu du formulaire en BDD
        $newCategory->insert();

        header('location: ' . $router->generate('category-categories'));

        // Rediriger vers une page pertinente


    }

    public function updateCategory($id = 0)
    {
        // Dans le cas d'un update : On recupere le contenu d'un produit via son id

        // dans le cas d'un         // TODO : il faut récupérer les données du $_POST

        
        // On envoies les info du POST au model

        //envoie vers la vue
        $category = new Category();
        // TODO utiliser les setters pour mettre "peupler" les propriétés





        $category->insert();
        dd($category);

        $this->show('category/categoryForm', [
            'category' => $category,
        ]);
    }
}
