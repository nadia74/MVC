<?php
//->


//-->
require_once('views/View.php');
require_once('controllers/Controller.php');
require_once('models/Session.php');
use App\Helpers\Session;




//fichier de classes
// la classe doit avoir le meme nom que le .php
class ControllerLogout extends Controller
{
    //on cree une nouvelle instance du model Article Manager, pour accéder aux fonctions. On le met en privé. on encapsule au max.
    

    public function get($url)
    {
        session_start();
        session_destroy();        
        $this->render('viewLogout.twig', []);
    }

   
}