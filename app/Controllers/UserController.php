<?php
namespace App\Controllers;

use App\Models\AppUser;
use App\core\CoreController;





class UserController extends CoreController {

    
    
    public function connection()
    {
        
        $this->show('connexion');
    }

    public function connectionControl()
    {
        
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
       
        $userMail = AppUser::findByEmail($email);

        global $router;
        if ($userMail === false) {

            header('Location:' . $router->generate('user-connexion'));
            return;

        } 

        if ($password !== $userMail->getPassword()) {

            header('Location:' . $router->generate('user-connexion'));
            return;

        } 

        $_SESSION['appUser'] = $userMail;
        
        header('Location:' . $router->generate('main-home'));
    }

    public function disconnect()
    {
        session_destroy(); // ancienne manière pas suffisante
        unset($_SESSION); // detruit la variable

        global $router;
        header('Location:' . $router->generate('user-connexion'));
        return;

    }
    

}
