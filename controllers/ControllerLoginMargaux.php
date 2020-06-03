<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once('views/View.php');
require_once('controllers/Controller.php');


class ControllerLogin
{
    private $_userManager;
    private $_view;
    private $_loader;
    private $_twig;

    public function __construct()
    {
        $this->_loader = new \Twig\Loader\FilesystemLoader(__DIR__. '/../views');
        $this->_twig = new \Twig\Environment($this->_loader,[
            'cache' => false,
        ]);
    }
public function login()
{
    if(isset($url) && count($url) > 1)
    {
        throw new \Exception("page introuvable", 1);
    }
    else
    {
        var_dump($_POST['email']);
        $this->login();
    }
}
 

public function get($url)
    { 
        //var_dump($this->_twig);
        $this->render('viewLogin.twig',[]);

        //echo $this->_twig->render('viewRegister.twig',[]);
        //$view = $this->generateFile(__DIR__ . '/../views/template.php', array('t' => 'Le blog du Mont Blanc','content'=> $content));
    }


}  