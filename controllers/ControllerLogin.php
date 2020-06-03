<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once('controllers/Controller.php');
require_once('models/User.php');
require_once('models/Session.php');
use App\Helpers\Session;


class ControllerLogin extends Controller
{
    
    

    public function get($url)
    { 
        //var_dump($this->_twig);
        $this->render('viewLogin.twig',[]);

        //echo $this->_twig->render('viewRegister.twig',[]);
        //$view = $this->generateFile(__DIR__ . '/../views/template.php', array('t' => 'Le blog du Mont Blanc','content'=> $content));
    }



    public function post($regist)
    {
        
        $email =  $regist["email"];
        $password =  $regist["password"];
        
        $errors =[];
        
        
        
        if ($email == "" || !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email) || $password == ""){
            $errors ['erreurlogin'] = 'Invalid username and/or password';

        }

        
        
        

        if (count($errors) != 0){
            $this->render('viewLogin.twig',$errors);

        }

        else {

            $this->_userManager = new UserManager();
            $user = $this->_userManager->login($email, $password);
            if ($user){
                //var_dump($user);
                Session::getInstance()->set("groupofloggeduser", $user["group"]);
                Session::getInstance()->set("name", $user["username"]);

                if ($user["group"]=="admin"){
                    header("Location:admin");           
                    echo "vous etes loggé en tant qu'administrateur"; 
                }
                else{
                    header("Location:acceuil");           
                    echo "vous etes loggé en tant que rédacteur"; 
                }

            }

            else{
                $errors ['erreurlogin'] = 'Invalid username and/or password';
                $this->render('viewLogin.twig',$errors);

            }
         }

        



        
        
    }

 
}
