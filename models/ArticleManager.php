<?php
//manager (ici, les fonctions) de tout ce aura un rapport avec les articles, les ajouter, les supprimer etc...
//il faut que la class aie le meme nom que le  fichier, pour que l'autoload puisse retrouver le fichier.php par rapport au nom de la classe
class ArticleManager extends Model
{
    public function getArticle()
    {

        //ici on appelle la connection a la bdd
        $this->getBdd();

        //la ligne suivante permet de tout récuperer dans une table
        //Article va etre un objet (cf Model.php)
        return $this->getAll('articles', 'Article');
    }
}