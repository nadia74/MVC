<?php
//->


//-->
require_once('views/View.php');
require_once('controllers/Controller.php');
require_once('models/Session.php');

use App\Helpers\Session;




//fichier de classes
// la classe doit avoir le meme nom que le .php
class ControllerAdmin extends Controller
{

    //on cree une nouvelle instance du model Article Manager, pour accéder aux fonctions. On le met en privé. on encapsule au max.



    public function get($url)
    {
        if (Session::getInstance()->get("groupofloggeduser") != "admin"){
            echo "Vous devez être loggé en tant qu'administrateur pour afficher cette page";
        }
        else{

            
            
            $this->_userManager = new UserManager();
            
            // ivi la fonction get article fait appel a ArticleManager>getArticle, qui fait appel à la
            $users = $this->_userManager->getUser();
            //ensuit on requiere ensuite la vue de façon  sécurisée
            //$this->_view = new View ('Accueil');
            //$this->_view->generate(array('articles'=> $articles));
            $this->render('viewAdmin.twig', array('user' => $users));
        }
    }
        
    public function post($data)
    {
        //var_dump($data);
        $this->_userManager = new UserManager();
        
        
        $id = $data["id"];
       
        $group =  $data["group"];
        
        if ($id == "creation") {
            
            $username = $data["username"];
            $email =  $data["email"];
            $password =  $data["password"];

            $this->_userManager->createuserviaadmin($username, $email, $password, $group);
        }
        
        else  {
            
            if (!isset($data["supression"])) {
                
                
                
                if (($data["accountactivation"]) == "activated") {
                    $isact = true;
                } else if (($data["accountactivation"] == "notactivated")) {
                    $isact = false;
                }

                if (($data["banned"]) == "banned") {
                    $isban = true;
                } else if (($data["banned"] == "allowed")) {
                    $isban = false;
                }


                $this->_userManager->update($id, $isban, $isact, $group);
            }
            //this datamanager ->update(arguments)
            if (isset($data["supression"])) {
                $this->_userManager->delete($id);
            }
        }

        $this->get([]);
        echo "<script>alert(\"Vos modifications ont été enregistrées\")</script>";


    }
}
