<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once('controllers/Controller.php');
require_once('models/User.php');

class ControllerRegister extends Controller
{
    
    

    public function get($url)
    { 
        //var_dump($this->_twig);
        $this->render('viewRegister.twig',[]);

        //echo $this->_twig->render('viewRegister.twig',[]);
        //$view = $this->generateFile(__DIR__ . '/../views/template.php', array('t' => 'Le blog du Mont Blanc','content'=> $content));
    }



    public function post($regist)
    {
        $username = $regist["username"];
        $email =  $regist["email"];
        $password =  $regist["password"];
        $passwordverify =  $regist["passwordconfirmation"];
        $errors =[];
        
        
        if ($username == ""){
          $errors ['erreurname'] = 'Veuillez indiquer un nom dans le champs.';

        }
        else if(strlen($username) < 3 || strlen($username) > 10) {
            $errors ['erreurname'] = 'Veuillez entrer un nom de 3 à 10 caractères.';
  
          }
        if ($email == ""){
            $errors ['erreurmail'] = 'Veuillez indiquer un mél dans le champs.';


        }
        else if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
            $errors ['erreurmail'] = 'Veuillez indiquer un mél valide.';

        }
        if ($password != $passwordverify){
            $errors ['erreurpass'] = 'Les mots de passe ne correspondent pas';

        }
        if ($password == ""){
            $errors ['erreurpassvoid'] = 'Veuillez indiquer un mot de passe dans le champs.';

        }
        if (strlen($password) < 8 || strlen($password) > 20){
            $errors ['erreurpassvoid'] = 'Veuillez entrer un mot de passe comportant de 8 à 20 caractères.';

        }
        if ($passwordverify == ""){
            $errors ['erreurpassverifvoid'] = 'Veuillez comfirmer le mot de passe.';

        }

        if (count($errors) != 0){
            $this->render('viewRegister.twig',$errors);

        }

        else {

            $this->_userManager = new UserManager();
            $this->_userManager->createuserviaregist($username, $email, $password);
            
            // the message
            $msg = "Veuillez cliquer sur ce lien pour activer votre compte <a> href=\"activation\">Activer</a></li>";
            // send email
            mail("$email","activation blog mont blanc",$msg);
            
            $this->render('viewLogin.twig',$errors);

            echo "<script>alert(\"Votre compte a été créé. Veuillez l'activer depuis votre boite mél, dans un délai de 30 jours.\")</script>";
        }

        



        
        
    }

 
}
