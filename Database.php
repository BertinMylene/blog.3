<?php

//Concernant la base de données...
class Database
{

    //Nos constantes
    const DB_HOST = 'mysql:host=localhost;dbname=blog.3;charset=utf8';
    const DB_USER = 'root';
    const DB_PASS = '';

    /**
     * Se connecter à la base de données...
     * Grace à la méthode getConnection
     */
    public function getConnection()
    {
        //Tentative de connexion à la base de données
        try{
            $connection = new PDO(self::DB_HOST, self::DB_USER, self::DB_PASS);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //On renvoie un message avec le mot-clé return
            return $connection;
        }
        //On lève une erreur si la connexion échoue
        catch(Exception $errorConnection)
        {
            die ('Erreur de connection :'.$errorConnection->getMessage());
        }
    }
}