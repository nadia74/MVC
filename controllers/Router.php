<?php
require_once('views/View.php');

// en fonction de l'action de l'utilisateur, d'autres pages seront incluses sur la page index. Par exemple, quand il arrive sur le site, il accede a la page accueil(defaut), mais s'il clique sur un lien la page va changer en fonction de son action.

class Router
{
    private $_ctrl;
    private $_view;

    //requete du routeur, selon l'action de l'utilisateur, c'est ici que c'est géré.

    public function routeReq()
    {
        try {

            //CHARGEMENT AUTOMATIQUE DES CLASSES.
            //on utilise unt fonction php qui va charger automatiquement les classes.
            // quand on créé une instance de classe, on doit requerir le fichier de la classe en question. 
            // la fonction spl autoload register de php va detecter le nom de la classe et il va charger le .php automatiquement. 
            spl_autoload_register(function ($class) {
                //le dossier créé précédemment, puis le nom du parametre class (il va récuperer le fichier qui porte le nom de la classe)
                require_once('models/' . $class . '.php');

                //--> ici l'autoloader charge uniquement les classes du dossier "models". Par la suite il faut créer une classe spéciale pour l'autoload pour qu'il charge toutes les classes. 


            });


            // on créé une variable url qui est égale à rien du tout
            $url = [];

            //LE CONTROLLER EST INCLUS SELON L ACTION DE L UTILISATEUR
            // puis on définit ce que l'on va inclure comme fichier en fonction des differentes actions des utilisateurs.
            //1-s'il y a un parametre get url, 
            if (isset($_GET['url']) && $_GET['url'] != "") {


                // avec explode, on récupere tous les parametres de maniere séparée.
                // on utilise aussi un filtre de php pour controler ce qu'il se passe dans le get, on sécurise ce que l'on récupere
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));


                //puis on créé une variable controller, avec uc first qui est la premiere lettre en maj et str to lower c'est tout le reste en minuscule.
                // c'est à dire que la variable controller sera egale au premier parametre qui sera dans l'url
                $controller = ucfirst(strtolower($url[0]));
                $controller = pathinfo($controller, PATHINFO_FILENAME);
                //var_dump (filter_var($_GET['url'], FILTER_SANITIZE_URL));

                //puis on crée une variabke qui s'appelle controllerClass
                //cf camelcase
                // cette variable est égale à "Controller et la variable (l'action)controller qu'ona  créé plus haut.
                //cela permet d'avoir la meme syntacxe que les noms de fichiers controller dont la convention d'écriture est ControllerClass
                $controllerClass = "Controller" . $controller;
                //echo $controllerClass;


                // la variable suivante nomme vers le dossier controllers.
                // c'est le routeur qui va inclure selon l'acton de l'utilisateur
                $controllerFile = "controllers/" . $controllerClass . ".php";

                // ensuite on vérifie si le fichier existe

                if (file_exists($controllerFile)) {
                    require_once($controllerFile);
                    // puis on appelle l'attribut privé créé au début
                    //par exemple si le fichier ControllerAccueil existe alors on va requerir ce fichier.
                    // et pour pouvoir utiliser l'encapsulation et un max de securité, l'attribut ctrl est egal a new controller class
                    //--> new controller class sera l'instance que l'on va lancer avec le fichier ControllerAccueil.php (qui comporte une class)
                    // c'est en récupérant les parametres url que l'on récupere les parametres de la classe

                    // expliqué plus loin..
                    $this->_ctrl = new $controllerClass();

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $this->_ctrl->post($_POST);
                        // The request is using the POST method
                    } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {

                        $this->_ctrl->get($url);
                    }
                }

                // ICI IL FAUDRA GÉRER LA CONDITION GET OU POST

                //sinon on créé une exception
                else{
                    require_once('controllers/ControllerNotfound.php');

                    // puis pour proteger tout cela : (cette fois pas besoin de passer par une variable)
                    $this->_ctrl = new ControllerNotfound();
                    $this->_ctrl->get($url);
    
                }
            }
            // sinon, s'il n'y a pas de get url, il faut lancer une page automatiquement
            // ce sera la page accueil qui sera chargée par defaut.
            else {
                require_once('controllers/ControllerAcceuil.php');
                // puis pour proteger tout cela : (cette fois pas besoin de passer par une variable)
                $this->_ctrl = new ControllerAcceuil();
                $this->_ctrl->get($url);


                //echo 'toto';

            }
        }

        //GESTION DES ERREURS
        catch (Exception $e) {

            //pour les exceptions, on créé une variable 
            $errorMsg = $e->getMessage();
            // puis on va requerir cette fois pas un controller mais directement la page vue
            //--> on récupérera plus la vue avec un attribut privé
            //require_once('views/viewError.php');
            $this->_view = new View('Error');
            $this->_view->generate(array('errorMsg' => $errorMsg));
        }

        // ensuite on va dans index.php pour lancer le routeur
    }
}
