<?php
require_once('controllers/Router.php');

//-->
require('./vendor/autoload.php');
//-->



//on definit l'url en constante pour pouvoir le récuperer facilement si on fait plusieurs niveaux.
//on fait une condition ternaire 
define('URL', str_replace("index.php","",(isset($_SERVER['HTTPS'])? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

// on créé une variable egale a une instance de la classe router, dans l'objet router
$router = new Router();
// puis il ne nous reste plus qu'à lancer la méthode routReq qui gere le routage des pages avec GET, encapsulation etc..
$router->routeReq();

//-->


    //$template = $twig->load('template.php');
    //echo $template->render();
//-->


//twig
//$loader = new Twig_Loader_Filesystem(__DIR__ . '/views');
//ensuite on initialise twig. La fonction prend des objets en parametre
//on utilise un moteur de template et il va devoir parser le template
//$twig = new Twig_Environment($loader,[
//'cache' => __DIR__ .'/tmp'
//pour recharger durant le dev :
//'cache' => false
//]);



