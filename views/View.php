<?php
class View
{
    private $_file;
    private $_t;

    public function __construct($action)
    {
        $this->_file = 'views/view'.$action.'.php';
    }

    //methode qui permet de générer et d'afficher la vue. 
    public function generate($data)
    {
        //data sont les données qu'on va passer dans cette fonction pour les récupérer dans la vue
        // par exemple dans le controllerAccueil on va récupérer la variable articles
        

        //PARTIE SPECIFIQUE DE LA VUE, SANS LE HEADER ET LE FOOTER
        //ici, la fonction existe plus bas. 
        //elle permet de faire passer la vue qu'on veux afficher avec les données qu'on récupére dans cette vue
        $content = $this->generateFile($this->_file, $data);


        //TEMPLATE
        $view = $this->generateFile('views/template.php', array('t' => $this->_t,'content'=> $content));
        
        //puis on renvoie la vue au navigateur
        echo $view;
    }


    //  GENERE UN FICHIER VUE ET RENVOIE LE RESULTAT PRODUIT
    private function generateFile($file, $data)
    {
        if(file_exists($file))
        {
            //extract permet d'afficher les données dans la vue
            extract($data);
            //démarrage de la mise en tampon
            ob_start();

            //INCLUT LE FICHIER VUE
            // puis on requiere le fichier passé en parametre
            require $file;
            
            //puis on arrete la temporisation, en revoyant le tampon de sortie
            return ob_get_clean();

        }

        else
        throw new Exception('Fichier '.$file.' introuvable.');
    }
}