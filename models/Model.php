<?php
//ce fichier contient les methodes communes aux autres classes

// on créé une classe abstraite qui ne as etre instanciée, puis on crééra des classe qui veont l'étendre

abstract class Model
{
    private static $_bdd;

    //INSTANCIE LA CONNECTION A LA BDD
    private static function setBdd()
   {
       //?
       //self :: j'accède a la variable statique de l'idée de la classe Model, et non de l'instance
       self::$_bdd = new PDO('mysql:host=localhost;dbname=rushmvc;port=3306;charset=utf8','nadia', 'toto');


       //on utilise des constantes de pdo qui gerent les erreurs
       self::$_bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

   } 
   //RECUPERE LA CONNEXION A LA BDD
   // ensuite on créé une méthode qui cree la connexion à la bdd
   //ceci est un singleton de la bdd
   protected function getBdd()
   {
       //on regarde si la connection existe, sinon on la créé
       if(self::$_bdd == null){
           self::setBdd();
        }
           return self::$_bdd;

   }

   // METHODE QUI R2CUPERE TOUTES LES DONNEES D UNE TABLE
   protected function getAll($table, $obj)
   {
       
       $var = [];
       $req = $this->getBdd()->prepare('SELECT * FROM ' .$table. ' ORDER BY id desc');
       $req->execute();
       //ensuite on execute la requete, avvec une boucle dont le parametre est une variable data
       while($data = $req->fetch(PDO::FETCH_ASSOC))
       {
           // on met dans var les données sous forme d'objet, la variable objet qu'on a en parametre, ce sera l'objet qu'on lui demande de créer
           //$var[]= new $obj($data);
           array_push($var, new $obj($data));
       }
       //on retourne alors la variable qui contient tous les objets
       return $var;
       //puis on ferme le cursor
       $req->closeCursor();
   }
}