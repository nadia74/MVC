<?php
require_once('views/View.php');
require_once('controllers/Controller.php');

//fichier de classes
// la classe doit avoir le meme nom que le .php
class ControllerIndex extends Controller
{
    //on cree une nouvelle instance du model Article Manager, pour accéder aux fonctions. On le met en privé. on encapsule au max.
    private $_articleManager;
    private $_view;

    
 //mettre une methode get et post dans tous les controllers
    public function get($url)
    {
        $this->_articleManager = new ArticleManager();
        // ivi la fonction get article fait appel a ArticleManager>getArticle, qui fait appel à la
        $articles = $this->_articleManager->getArticle();
        //ensuit on requiere ensuite la vue de façon  sécurisée
        //$this->_view = new View ('Index');
        //$this->_view->generate(array('articles'=> $articles));
        $this->render('viewIndex.php', []);
    }

    public function post ($data){
    }
    
}