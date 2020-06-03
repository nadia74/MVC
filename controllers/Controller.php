<?php

abstract class Controller
{
    private $_twig;
    public function __construct ()
    {

        $loader = new \Twig\Loader\FilesystemLoader(__DIR__. '/../views');
        $this->_twig = new \Twig\Environment($loader,[
    'cache' => false,
    
    ]);
        //$this->articles();

    }


    public function post($data){
        throw new Exception ('Post not supported');
    }
    public function get($get){
        throw new Exception ('Get not supported');
    }

    /*private function articles()
    {
        echo 'tata';
        $this->_articlesManager = new ArticleManager;
        // ivi la fonction get article fait appel a ArticleManager>getArticle, qui fait appel à la
        $articles = $this->_articlesManager->getArticle();

       echo $this ->_twig->render('viewAccueil.twig');
    }*/

    protected function render($viewname, $data){
        $content = $this->_twig->render($viewname, $data);
        $view = $this->generateFile(__DIR__ . '/../views/template.php', array('t' => 'Le blog du Mont Blanc','content'=> $content));
echo $view;



    }
    private function generateFile($file, $data)
    {
        if(file_exists($file))
        {
            //extract permet d'afficher les données dans la vue
            extract($data);
            //démarrage de la mise en tampon
            ob_start();

            //INCLUT LE FICHIER VUE
            // puis on requiere le fichier passé en parametre
            require $file;
            
            //puis on arrete la temporisation, en revoyant le tampon de sortie
            return ob_get_clean();

        }

        else
        throw new Exception('Fichier '.$file.' introuvable.');
    }
}