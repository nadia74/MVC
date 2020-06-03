<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once('views/View.php');
require_once('controllers/Controller.php');
require_once('models/User.php');
require_once('vendor/autoload.php');

class ControllerRegister extends Controller
{
    private $_userManager;
    private $_view;
    private $_loader;
    private $_twig;
    private $_param;

    public function __construct()
    {
        $this->_loader = new \Twig\Loader\FilesystemLoader(__DIR__. '/../views');
        
        $this->_twig = new \Twig\Environment($this->_loader,[
            'cache' => false,
            "debug" => true, 
        ]);
    }
    public function post($param)
    {
        $this->_param = $param;
        $this->register();
    }

    public function get($url)
    { 
        //var_dump($this->_twig);
        echo $this->_twig->render('viewRegister.twig',[]);
        //$view = $this->generateFile(__DIR__ . '/../views/template.php', array('t' => 'Le blog du Mont Blanc','content'=> $content));
    }



    public function register()
    {
        if(isset($url) && count($url) > 1)
        {
            throw new \Exception("page introuvable", 1);
        }
        else
        {
            var_dump($this->_param);
            $modelUser = new User($this->_param);
            $modelUser ->register($this->_param['username'],$this->_param['email'], $this->_param['password']);
            $this->users();
        }
    }

  private function registers ()
  {
   
    $viewPath = $_SERVER['DOCUMENT_ROOT']. "/PHP_Rush_MVC/views/viewRegister.twig";
    if (file_exists($viewPath))
    {
        require_once($viewPath);
        $this->ctrl = new Register;
    }
  }
}
