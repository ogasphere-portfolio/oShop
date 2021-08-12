<?php

use App\Models\CoreModel;

    $name = CoreModel::valid_donnees($_POST["name"]);
    $subtitle = CoreModel::valid_donnees($_POST["subtitle"]);
    $picture = CoreModel::valid_donnees($_POST["picture"]);
    $home_order = CoreModel::valid_donnees($_POST["home_order"]);
    $created_at = CoreModel::valid_donnees($_POST["created_at"]);
    $updated_at = CoreModel::valid_donnees($_POST["updated_at"]);
    
    die();
    
    /*Si les champs prenom et mail ne sont pas vides et si les donnees ont
     *bien la forme attendue...*/
    if (!empty($prenom)
        && strlen($prenom) <= 20
        && preg_match("^[A-Za-z '-]+$",$prenom)
        && !empty($mail)
        && filter_var($mail, FILTER_VALIDATE_EMAIL)){
    
        try{
            //On se connecte à la BDD
            $dbco = new PDO("mysql:host=$eerveur;dbname=$dbname",$user,$pass);
            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //On insère les données reçues
            $sth = $dbco->prepare("
                INSERT INTO form(prenom, mail, age, sexe, pays)
                VALUES(:prenom, :mail, :age, :sexe, :pays)");
            $sth->bindParam(':prenom',$prenom);
            $sth->bindParam(':mail',$mail);
            $sth->bindParam(':age',$age);
            $sth->bindParam(':sexe',$sexe);
            $sth->bindParam(':pays',$pays);
            $sth->execute();
            //On renvoie l'utilisateur vers la page de remerciement
            header("Location:form-merci.html");
        }
        catch(PDOException $e){
            echo 'Erreur : '.$e->getMessage();
        }
    }else{
        header("Location:formulaire.html");
    }
?>