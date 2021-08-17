<?php
namespace App\Controllers;


use App\core\CoreModel;
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
        $this->checkAuthorization([
            'admin',
        ]);
        // Je veux recuperer le liste de toutes les categories
        // sous la forme d'un tableau d'objets
        $users = AppUser::findAll();

        $this->show('user/users', [
            'users' => $users,
        ]);
    }

    public function displayNewUser()
    {
        $this->checkAuthorization([
            'admin',
        ]);
        $this->show('user/userForm');
    }

    public function displayUpdateUser($id)
    {

        $this->checkAuthorization([
            'admin',
        ]);
        // On recupere le contenu d'un produit via son id

        // On l'envoie vers la vue
        $user = AppUser::find($id);

        if ($user) {
            $this->show('user/userForm', [
                'user' => $user,
            ]);
        } else {
            dd('Id non trouvée dans la BDD');
        }
    }

    public function createUser()
    {
        global $router;

        $this->checkAuthorization([
            'admin',
        ]);

        // Recuperer le contenu du formulaire
        // Valider le contenu du formulaire
        $email = filter_input(INPUT_POST, 'email', \FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', \FILTER_SANITIZE_STRING);
        $firstname = filter_input(INPUT_POST, 'firstname', \FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', \FILTER_SANITIZE_STRING);
        $role = filter_input(INPUT_POST, 'role', \FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_POST, 'status', \FILTER_SANITIZE_NUMBER_INT);

        $email = CoreModel::valid_donnees($_POST["email"]);
        $password = CoreModel::valid_donnees($_POST["password"]);
        $firstname = CoreModel::valid_donnees($_POST["firstname"]);
        $lastname = CoreModel::valid_donnees($_POST["lastname"]);
        $role = CoreModel::valid_donnees($_POST["role"]);
        $status = CoreModel::valid_donnees($_POST["status"]);
        
        // J'instancie une nouvelle categorie vide
        $newUser = new Appuser();

        // Je remplis ma categorie avec les données du formulaire
        $newUser->setEmail($email);
        $newUser->setPassword($password);
        $newUser->setFirstname($firstname);
        $newUser->setLastname($lastname);
        $newUser->setRole($role);
        $newUser->setStatus($status);


        // Inserer le contenu du formulaire en BDD
        // todo a remodifier en insert() apres les test
        $newUser->Insert('user');

        header('location: ' . $router->generate('user-users'));

        // Rediriger vers une page pertinente


    }

    public function updateUser($userId)
    {
        global $router;

        $this->checkAuthorization([
            'admin',
        ]);

        //je récupère les données entrées dans le formulaire
        $newEmail = filter_input(INPUT_POST, 'email', \FILTER_SANITIZE_EMAIL);
        $newPassword = filter_input(INPUT_POST, 'password', \FILTER_SANITIZE_STRING);
        $newFirstname = filter_input(INPUT_POST, 'firstname', \FILTER_SANITIZE_STRING);
        $newLastname = filter_input(INPUT_POST, 'lastname', \FILTER_SANITIZE_STRING);
        $newRole = filter_input(INPUT_POST, 'role', \FILTER_SANITIZE_STRING);
        $newStatus = filter_input(INPUT_POST, 'status', \FILTER_SANITIZE_NUMBER_INT);

        $newEmail = CoreModel::valid_donnees($_POST["email"]);
        $newPassword = CoreModel::valid_donnees($_POST["password"]);
        $newFirstname = CoreModel::valid_donnees($_POST["firstname"]);
        $newLastname = CoreModel::valid_donnees($_POST["lastname"]);
        $newRole = CoreModel::valid_donnees($_POST["role"]);
        $newStatus = CoreModel::valid_donnees($_POST["status"]);
        
        //je récupère l'id du user qu'on veut modifier
        $findUserById = AppUser::find($userId);
       
        
        // je définis les nouvelles données via nos setter correspondants
        $findUserById->setEmail($newEmail);
        $findUserById->setPassword($newPassword);
        $findUserById->setFirstname($newFirstname);
        $findUserById->setLastname($newLastname);
        $findUserById->setRole($newRole);
        $findUserById->setStatus($newStatus);




        
        // j'envoie la méthode update pour mettre à jour la BDD et je redirige vers la liste des Users mis à jour.
        $findUserById->save();
        header('Location: ' . $router->generate('user-users'));

    }
    public function delete($userId)
    {
        $this->checkAuthorization([
            'admin',
        ]);
    }
}