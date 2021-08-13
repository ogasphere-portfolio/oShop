<?php

namespace App\Models;

use PDO;
use Exception;
use App\Utils\Database;

// Classe mère de tous les Models
// On centralise ici toutes les propriétés et méthodes utiles pour TOUS les Models
class CoreModel
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $created_at;
    /**
     * @var string
     */
    protected $updated_at;

    private $column_names;

    public function getColumnNames($table)
    {
        // Méthode pour récuprer le nom des colonnes de $table
        $pdo = Database::getPDO();
        $sql = "select column_name from information_schema.columns where table_name = '{$table}'";

        $pdoStatement = $pdo->prepare($sql);

        try {
            if ($pdoStatement->execute()) {
                $raw_column_data = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($raw_column_data as $outer_key => $array) {
                    foreach ($array as $inner_key => $value) {
                        if (!(int)$inner_key) {
                            $this->column_names[] = $value;
                        }
                    }
                }
            }
            return $this->column_names;
        } catch (Exception $e) {
            return $e->getMessage(); //return exception 
        }
    }

    public function testInsert($table)
    {
        // Todo tentative de mise en place d'un insert dynamique
        
        $pdo = Database::getPDO();
        $fields_list="";
        $value_list="";
        // on recupere le nom des colonnes de la table $table
        // todo trouver un moyen de verifier les attributs auto-increment et timestamp pour ne pas les inclure dans la requete
        $columns = $this->getColumnNames($table);
        $cpt = 0;
        foreach ($columns as $col) {
           $cpt++;
           
           if ($cpt == 1) {
            $fields_list = "({$col}," ;
            $value_list = "[:{$col}" ;

           } else {
            $fields_list = "{$fields_list},{$col}";
            $value_list = "{$value_list},:{$col}";
           }
          
        }
        //on ferme la parenthese
        $fields_list = "{$fields_list})";   // pour la table produit $fields_list vaut : "(id,,name,subtitle,picture,home_order,created_at,updated_at)"
        
        // on ferme les crochets
        $value_list = "{$value_list}]"; // pour la table produit $value_list vaut : [:id,:name,:subtitle,:picture,:home_order,:created_at,:updated_at]"
       

       
        
        $sql = "
            INSERT INTO `{$table}` {$fields_list}
            VALUES $value_list";


        $request = $pdo->prepare($sql);
        dd($request);
        // todo dynamiser l' execution avec $columns et $table
        // todo creer la chaine de caractzeres à passer à execute() à faire dans le for each au dessus
        $insertedRows = $request->execute([
            ':name' => $table->getName(),
            ':subtitle' => $table->getSubtitle(),
            ':picture' => $table->getPicture()
        ]);

        // Si au moins une ligne ajoutée
        if ($insertedRows > 0) {
            // Alors on récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();

            // On retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
            // => l'interpréteur PHP sort de cette fonction car on a retourné une donnée
        }

        // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
        return false;
    }




    public static function valid_donnees($donnees)
    {
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }
    /**
     * Get the value of id
     *
     * @return  int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of created_at
     *
     * @return  string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * Get the value of updated_at
     *
     * @return  string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @param  string  $updated_at
     *
     * @return  self
     */
    public function setUpdated_at(string $updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Set the value of created_at
     *
     * @param  string  $created_at
     *
     * @return  self
     */
    public function setCreated_at(string $created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }
}
