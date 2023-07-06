<?php

namespace App\Models;

use PDO;
use App\core\CoreModel;
use App\Utils\Database;

/**
 * Un modèle représente une table (un entité) dans notre base
 * 
 * Un objet issu de cette classe réprésente un enregistrement dans cette table
 */
class Tag extends CoreModel {
   
    /**
     * @var string
     */
    private $name;
   
    // todo creer les proprietes

    public function insert()
    {
        # code...
    }
    public function update()
    {
        # code...
    }
    public static function delete($id)
    {
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'DELETE FROM `tag` WHERE `id` =' . $id;

        // exécuter notre requête
        $pdoStatement = $pdo->exec($sql);
        return $pdoStatement;
    }

    public static function find($typeId)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'SELECT * FROM `tag` WHERE `id` =' . $typeId;

        // exécuter notre requête
        $pdoStatement = $pdo->query($sql);

        // un seul résultat => fetchObject
        $type = $pdoStatement->fetchObject('App\Models\Tag');

        // retourner le résultat
        return $type;
    }
    public static function findAllByProduct($productId)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'SELECT
                tag.name as tag_name,
                product.name as product_name,
                product.id as product_id 
                FROM tag 
                INNER JOIN product_has_tag ON tag.id = product_has_tag.tag_id 
                INNER JOIN product ON product.id = product_has_tag.product_id
                WHERE product.id ='.$productId.'
                ORDER BY product.id';

        // exécuter notre requête
        $pdoStatement = $pdo->query($sql);

        // un seul résultat => fetchObject
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Tag');

        // retourner le résultat
        return $results;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table type
     * 
     * @return Type[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `tag`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Tag');
        
        return $results;
    }

    /**
     * Récupérer les 5 types mis en avant dans le footer
     * 
     * @return Type[]
     */
    public static function findAllFooter()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM tag
            WHERE footer_order > 0
            ORDER BY footer_order ASC
        ';
        $pdoStatement = $pdo->query($sql);
        $types = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Tag');
        
        return $types;
    }

   

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    
    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }
}
