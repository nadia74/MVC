<?php

//ce fichier est l'orm
//on hydrate les données, elles seront toutes privées
//la classe porte le nom du parametre passé dans la fonction de ArticleManager.php
class Article
{
    //on passe toutes les données qu'on recupere en données privées
    // il faut que les noms des attributs privés correspondent aux titres de la table
    private $_id;
    private $_title;
    private $_content;
    private $_date;

    // le constructeur est appellé en premier et automatiquement quand on cree une instance de la class article, la variable data en parametre sont les données récupérées
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }
    public function hydrate(array $data)
    {
        //la fonction renvoie aux setters, setters car l'on va mettre a jour les données que l'on récupere sur les attributs privates, mais sous certaines conditions, il y a des vérifications à faire
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            //ensuite on vérifie si la méthode existe
            if(method_exists($this, $method))
            //si lle existe, il reste juste a la lancer
            $this->$method($value);
        }

    }

    //pour récupérer les données : setters et getters

    //setters
    public function setId($id)
    {
        $id = (int) $id;
        if($id > 0)
        $this->_id = $id;
    }
    public function setTitle($title)
    {
        if(is_string($title))
        $this->_title = $title;
    }
    public function setContent($content)
    {
        if(is_string($content))
        $this->_content = $content;
    }
    public function setDate($date)
    {
        
        $this->_date = $date;
    }

    //getters --> accès au données
    public function id(){
        return $this->_id;
    }
    public function title(){
        return $this->_title;
    }
    public function content(){
        return $this->_content;
    }
    public function date(){
        return $this->_date;
    }
// a présent pour afficher tout cela sur le blog, il faut le controller(ControllerAccueil.php)

}