<?php
namespace App\src\DAO;
 
use PDO;
use Exception;

//Concernant la base de données...
abstract class DAO
{
    /**
     * Stocke la connexion si celle-ci existe, sinon renvoie  null
     */
    private $connection;


    /**
     * Teste si  $connection  est  null et appelle  getConnection()  pour créer une nouvelle connexion.
     * Si  $connection  a une connexion existante, la méthode renvoie celle-ci.
     */
    private function checkConnection()
    {
        //Vérifie si la connexion est nulle et fait appel à getConnection()
        if($this->connection === null) {
            return $this->getConnection();
        }
        //Si la connexion existe, elle est renvoyée, inutile de refaire une connexion
        return $this->connection;
    }

    /**
     * Se connecter à la base de données...
     * Grace à la méthode getConnection
     */
    private function getConnection()
    {
        //Tentative de connexion à la base de données
        try{
            $this->connection = new PDO(DB_HOST, DB_USER, DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //On renvoie un message avec le mot-clé return
            return $this->connection;
        }
        //On lève une erreur si la connexion échoue
        catch(Exception $errorConnection)
        {
            die ('Erreur de connection :'.$errorConnection->getMessage());
        }
    }

    // Gére nos requêtes
    /**
     * @param mixed $sql
     * @param null $parameters
     * 
     * @return [type]
     */
    protected function createQuery($sql, $parameters = null)
    {
        //Si tu as des parametres passés
        if($parameters)
        {
            $result = $this->checkConnection()->prepare($sql);
            $result->execute($parameters);
            return $result;
        }
        //Sinon
        $result = $this->checkConnection()->query($sql);
        return $result;
    }
}