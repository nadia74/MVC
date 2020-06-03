<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once('views/View.php');
require_once('controllers/Controller.php');
require_once('models/Users.php');


class ControllerUsers
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
public function register()
{
    if(isset($url) && count($url) > 1)
    {
        throw new \Exception("page introuvable", 1);
    }
    else
    {
        var_dump($_POST);
        $modelUser = new User;
        $modelUser ->login($_POST['email']);
        $this->users();
    }
}
  public function login ()
  {
   
    $viewPath = $_SERVER['DOCUMENT_ROOT']. "/PHP_Rush_MVC/views/viewLogin.twig";
    if (file_exists($viewPath))
    {
        require_once($viewPath);
        $this->ctrl = new Login;
    }
  }
}

    // private function users()
    // {
    //     $this->users.
    // }

 