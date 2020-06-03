<?php
//->


//-->
require_once('views/View.php');
require_once('controllers/Controller.php');


//fichier de classes
// la classe doit avoir le meme nom que le .php
class ControllerNotfound extends Controller
{
    //on cree une nouvelle instance du model Article Manager, pour accéder aux fonctions. On le met en privé. on encapsule au max.
    

    public function get($url)
    {
        
        $this->render('viewNotfound.twig', []);
    }

   
}