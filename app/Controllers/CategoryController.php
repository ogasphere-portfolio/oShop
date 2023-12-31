<?php

namespace App\Controllers;

use DateTime;
use App\Models\Category;
use App\core\CoreController;






class CategoryController extends CoreController
{

    public function categoriesOrderForm()
    {
        $randToken = bin2hex(random_bytes(32));
        $_SESSION['token'] = $randToken;
        $categories = Category::findAll();
        $this->show('category/categoriesOrder', [
            'categories' => $categories,
            'token' => $randToken
        ]);
    }
    public function categoriesOrderAction()
    {
        global $router;
        // On recupere un tableau de toutes les categories
        $categories = Category::findAll();

        // On recupere le contenu du formulaire sous la forme
        /**
         * [
         * 'home_order' => 'id'
         * ]
         */
        $categoriesPosition = $_POST['emplacement'];

        // Je parcours chacune de mes categories
        foreach ($categories as $category) {
            // on verifie si l'id de la categorie est présente dans $categoriesPosition
            if(in_array($category->getId(), $categoriesPosition)) {
                // Je met a jour home_order avec le resultat de la recherche suivante
                // Recuperer la clé correspondant a l'id de notre categorie
                $homeOrder = array_search($category->getId(), $categoriesPosition);
                $category->setHomeOrder($homeOrder);
            } else {
                // Je met home_order a 0
                $category->setHomeOrder(0);
            }
            $category->save();
        }
        header('location: ' . $router->generate('category-categoriesOrderForm'));
        exit();
    }
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
        $randToken = bin2hex(random_bytes(32));
        $_SESSION['token'] = $randToken;
        $this->show('category/categoryForm', [
            'token' => $randToken
        ]);
        
    }

    public function displayUpdateCategory($id)
    {
        $randToken = bin2hex(random_bytes(32));
        $_SESSION['token'] = $randToken;
       
        // On recupere le contenu d'un produit via son id

        // On l'envoie vers la vue
        $category = Category::find($id);

        if ($category) {
            $this->show('category/categoryForm', [
                'category' => $category,
                'token' => $randToken
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

       
        // J'instancie une nouvelle categorie vide
        $newCategory = new Category();

        // Je remplis ma categorie avec les données du formulaire
        $newCategory->setName($name);
        $newCategory->setSubtitle($subtitle);
        $newCategory->setPicture($picture);

        // Inserer le contenu du formulaire en BDD
        
        $newCategory->save();
        
;        header('location: ' . $router->generate('category-categories'));
        exit();
        // Rediriger vers une page pertinente


    }

    public function updateCategory($categoryId)
    {
       
        global $router;

        //je récupère les données entrées dans le formulaire
        $newName = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $newSubtitle = filter_input(INPUT_POST, "subtitle", FILTER_SANITIZE_STRING);
        $newPicture = filter_input(INPUT_POST, "picture", FILTER_SANITIZE_STRING);
        
        //je récupère l'id de la catégorie qu'on veut modifier
        $findCategoryById = Category::find($categoryId);
        //$categoryId = $findCategoryById->getId();
        
        //$category = new Category();
        // je définis les nouvelles données via nos setter correspondants
        $findCategoryById->setName($newName);
        $findCategoryById->setSubtitle($newSubtitle);
        $findCategoryById->setPicture($newPicture);
        
        // j'envoie la méthode update pour mettre à jour la BDD et je redirige vers la liste des catégories mise à jour.
        $findCategoryById->save();
        header('Location: ' . $router->generate('category-categories'));
        exit();

    }
    public function deleteCategory($id)
    {
        
        global $router;

        Category::delete($id);
        header('location: ' . $router->generate('category-categories'));
        exit();
    }
}
