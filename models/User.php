<?php

//ce fichier est l'orm
//on hydrate les données, elles seront toutes privées
//la classe porte le nom du parametre passé dans la fonction de ArticleManager.php
class User
{
    //on passe toutes les données qu'on recupere en données privées
    // il faut que les noms des attributs privés correspondent aux titres de la table
    private $_id;
    private $_username;
    private $_password;
    private $_email;
    private $_group;
    private $_banned;
    private $_accountactivation;
    private $_creationdate;
    private $_modificationdate;
    private $_db;

    // le constructeur est appellé en premier et automatiquement quand on cree une instance de la class article, la variable data en parametre sont les données récupérées
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }
    public function hydrate(array $data)
    {
        //la fonction renvoie aux setters, setters car l'on va mettre a jour les données que l'on récupere sur les attributs privates, mais sous certaines conditions, il y a des vérifications à faire
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            //ensuite on vérifie si la méthode existe
            if(method_exists($this, $method))
            //si lle existe, il reste juste a la lancer
            $this->$method($value);
        }

    }
  
    //pour récupérer les données : setters et getters

    //setters
    public function setId($id)
    {
        $id = (int) $id;
        if($id > 0)
        $this->_id = $id;
    }
    public function setUsername($username)
    {
        if(is_string($username))
        $this->_username = $username;
    }

    public function setPassword($password)
    {
        if(is_string($password))
        $this->_password = $password;
    }
    public function setEmail($email)
    {
        if(is_string($email))
        $this->_email = $email;
    }
    public function setGroup($group)
    {
        if(is_string($group))
        $this->_group = $group;
    }

    public function setBanned($banned)
    {
        if(is_string($banned))
        $this->_banned = $banned;
    }

    public function setAccountActivation($accountactivation)
    {
        if(is_string($accountactivation))
        $this->_accountactivation = $accountactivation;
    }
    public function setCreationdate($creationdate)
    {
        if(is_string($creationdate))
        $this->_creationdate = $creationdate;
    }
    public function setModificationdate($modificationdate)
    {
        if(is_string($modificationdate))
        $this->_modificationdate = $modificationdate;
    }


    //getters --> accès au données
    public function id(){
        return $this->_id;
    }
    public function username(){
        return $this->_username;
    }
    public function password(){
        return $this->_password;
    }
    public function email(){
        return $this->_email;
    }
    
    public function group(){
        return $this->_group;
    }
    public function banned(){
        return $this->_banned;
    }
    public function accountactivation(){
        return $this->_accountactivation;
    }
    public function creationdate(){
        return $this->_creationdate;
    }
    public function modificationdate(){
        return $this->_modificationdate;
    }

    public function validateRegistration($username, $email, $password, $passwordVerify)
  {
    $err = '';


// Si le username ne respecte la norme imposée (ou vide) alors je renvois uniquement "Invalid username"
if (empty($this->username) || strlen($this->username < 3) || strlen($this->username > 10)) 
    {
      $err = $err . "Invalid username.<br>";
    }
// Si le mail est vide ou ne respecte pas la norme imposée alors je renvois "invalid email"
    if (empty($this->email) OR preg_match('#^[a-zA-Z0-9]+@[a-zA-Z]{2,}\.[a-z]{2,4}$#', $this->email) != 1) 
    {
      $err = $err . "Invalid email.<br>";
    }
//Si le password ne respecte pas la norme imposée alors je renvois "Invalid password"
    if (strlen($this->password) < 8 or strlen($this->password) > 20) 
    {
        $err = $err . "Invalid password.<br>";
    }

//si la variable password est vide alors j'affiche Invalid password
    if (empty($this->password)) 
    {
      $err = $err . "Invalid password.<br>";
    }

    // si j'ai une différence entre le password et le password verify
    if (empty($this->passwordVerify) OR ($this->passwordVerify !== $this->password))
    {
      $err = $err. "Invalid password.<br>";
    }

    return $err;
  }

  //Besoin d'aide 
  // Creation du user dans la BDD.


 public function register($u_username, $u_email, $u_password){
    ///chiffrage du mot de passe, insertion dans la base de données
    //var_dump('toto');
    $u_h_pwd = password_hash($u_password, PASSWORD_DEFAULT);
    $date = date("Y-m-d");
    $insert_sql = 'INSERT INTO users (username, email, password, creationdate) VALUES ("'.$u_username.'", "'.$u_email.'", "'.$u_h_pwd.'", "'.$date.'")';
    var_dump($this->_db);
    $count = $this->_db->insert($insert_sql);
    return $count;
}



// GESTION DE LA CONNEXION POUR UN UTILISATEUR EXISTANT AVEC ERRORS 



public function login($email)
{
    $sql = 'SELECT * FROM users WHERE  email =:email';
    $reqUsers = $this->db->prepare($sql);
    $reqUsers->bindParam(':email', $email);
    $result = $reqUsers->execute();
    var_dump($reqUsers->fetchAll());
}


public function errorlogin($email, $password)
{

    $err = '';
  
    if ((empty($this->$email)) OR (preg_match('#^[a-zA-Z0-9]+@[a-zA-Z]{2,}\.[a-z]{2,4}$#', $this->$email) != 1))
    {
        $err = "Invalid email or password.<br>";
    }
    else if (empty($this->$password))
    {
        $err = "Invalid email or password.<br>";
    }
    else if (strlen($this->$password) < 8 OR (strlen($this->$password) > 20))
    {
        $err = "Invalid email or password.<br>";
    }
    return $err;
  }

}