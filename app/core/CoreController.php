<?php
namespace App\core;



abstract class CoreController {

    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewData Tableau des données à transmettre aux vues
     * @return void
     */
  
    protected function checkAuthorization($roles = [])
    {
        global $router;
        // Si le user est connecté
        if(isset($_SESSION['connectedUser']) && $_SESSION['connectedUser'] !== '') {
            // Alors on récupère l'utilisateur connecté
            $currentUser = $_SESSION['connectedUser'];
                
            // Puis on récupère son role
            $currentUserRole = $currentUser->getRole();
            // si le role fait partie des roles autorisées (fournis en paramètres)
            if(in_array($currentUserRole, $roles)) {
                // Alors on retourne vrai
                return true;
            } else {
                // Sinon le user connecté n'a pas la permission d'accéder à la page
                // => on envoie le header "403 Forbidden"
                header('HTTP/1.0 403 Forbidden');
                // Puis on affiche la page d'erreur 403
                $this->show('error/err403');
                // Enfin on arrête le script pour que la page demandée ne s'affiche pas
                exit();
            }
        } else {
            // Sinon, l'internaute n'est pas connecté à un compte
            $_SESSION['errorMessage'] = "Vous n'avez pas le droit d'acceder à cette page sans etre connecté";
            header('Location:' . $router->generate('user-connexion'));
            exit();
            // Alors on le redirige vers la page de connexion
        }
    }

    protected function show(string $viewName, $viewData = []) {
        // On globalise $router car on ne sait pas faire mieux pour l'instant
        global $router;
        $absoluteURL = isset($_SERVER['BASE_URI']) ? $_SERVER['BASE_URI'] : '';

        // Comme $viewData est déclarée comme paramètre de la méthode show()
        // les vues y ont accès
        // ici une valeur dont on a besoin sur TOUTES les vues
        // donc on la définit dans show()
        $viewData['currentPage'] = $viewName; 

        // définir l'url absolue pour nos assets
        $viewData['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        // définir l'url absolue pour la racine du site
        // /!\ != racine projet, ici on parle du répertoire public/
        $viewData['baseUri'] = $_SERVER['BASE_URI'];

         // Gestion des flashMessage d'erreurs
         $viewData['errorMessage'] = false;
         if(isset($_SESSION['errorMessage']) && $_SESSION['errorMessage'] !== '') {
             $viewData['errorMessage'] = $_SESSION['errorMessage'];
             unset($_SESSION['errorMessage']);
         }
        // On veut désormais accéder aux données de $viewData, mais sans accéder au tableau
        // La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
        extract($viewData);
        // => la variable $currentPage existe désormais, et sa valeur est $viewName
        // => la variable $assetsBaseUri existe désormais, et sa valeur est $_SERVER['BASE_URI'] . '/assets/'
        // => la variable $baseUri existe désormais, et sa valeur est $_SERVER['BASE_URI']
        // => il en va de même pour chaque élément du tableau

        // $viewData est disponible dans chaque fichier de vue
        require_once __DIR__.'/../views/layout/header.tpl.php';
        require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
        require_once __DIR__.'/../views/layout/footer.tpl.php';
    }
}
