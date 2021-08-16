<?php
namespace App\Controllers;

use App\Models\AppUser;
use App\core\CoreController;





class AppUserController extends CoreController {

    
    
    public function connexion()
    {
        
        $this->show('connexion/login');
    }

    public function connexionControl()
    {
        
       global $router;
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");

        // Recuperation de l'utilisateur via son email
        $connectedUser = AppUser::findByEmail($email);

        if($connectedUser) {
            // Comparer le mdp avec celui lié au compte
            if(password_verify($password, $connectedUser->getPassword())) {
                // On ajoute en session l'objet de l'utilisateur connecté
                $_SESSION['connectedUser'] = $connectedUser;
                // On redirige vers l'accueil
                header('Location:' . $router->generate('main-home'));
            } else {
                $_SESSION['errorMessage'] = "ERREUR DE CONNEXION MDP";
                header('Location:' . $router->generate('user-connexion'));
            }

        } else {
            $_SESSION['errorMessage'] = "ERREUR DE CONNEXION";
            header('Location:' . $router->generate('user-connexion'));
        }
    }

    public function disconnect()
    {
       // suppression du connectedUser , deconnecte l'utilisateur
        unset($_SESSION['connectedUser']); 

        global $router;
        // Redirection vers la page de connexion
        header('Location:' . $router->generate('user-connexion'));
        return;

    }
    
    public function users()
    {
        // Je veux recuperer le liste de toutes les categories
        // sous la forme d'un tableau d'objets
        $Users = AppUser::findAll();

        $this->show('category/categories', [
            'categories' => $categories,
        ]);
    }

    public function displayNewUser()
    {
        $this->show('category/categoryForm');
    }

    public function displayUpdateUser($id)
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

    public function createUser()
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
        // todo a remodifier en insert() apres les test
        $newCategory->testInsert('category');

        header('location: ' . $router->generate('category-categories'));

        // Rediriger vers une page pertinente


    }

    public function updateUser($categoryId)
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

    }
}
