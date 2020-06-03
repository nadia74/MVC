<?php
//manager (ici, les fonctions) de tout ce aura un rapport avec les articles, les ajouter, les supprimer etc...
//il faut que la class aie le meme nom que le  fichier, pour que l'autoload puisse retrouver le fichier.php par rapport au nom de la classe
class UserManager extends Model
{
    public function getUser()
    {

        //ici on appelle la connection a la bdd
        $this->getBdd();

        //la ligne suivante permet de tout récuperer dans une table
        //Article va etre un objet (cf Model.php)
        return $this->getAll('users', 'User');
    }


    public function update($id, $banned, $act, $group){


        $req = $this->getBdd()->prepare('UPDATE users SET `group`= :group, banned = :bannedvalue, accountactivation =  :accountactvalue, modificationdate = Now() WHERE id = :idvalue');
       $req->execute(['bannedvalue'=>$banned , 'idvalue'=>$id , 'accountactvalue'=>$act, 'group'=>$group]);
        
        //requete sql update
    }

    public function delete($id){

        $req = $this->getBdd()->prepare('DELETE FROM users WHERE id = :id');
       $req->execute(['id'=>$id]);

       

    }

    public function createuserviaadmin($username,$email,$password, $group){
        $passhash = md5($password);

        $req = $this->getBdd()->prepare('INSERT INTO users ( username, password, email, `group`, banned, accountactivation, creationdate, modificationdate) VALUES (:username, :password, :email, :group, FALSE, TRUE, now(), now())');
        $req->execute(['username'=>$username, 'email'=>$email, 'password'=>$passhash, 'group'=>$group]);
 

    }

    public function createuserviaregist($username,$email,$password){
        $passhash = md5($password);

        $req = $this->getBdd()->prepare('INSERT INTO users ( username, password, email, `group`, banned, accountactivation, creationdate, modificationdate) VALUES (:username, :password, :email, "reader", FALSE, TRUE, now(), now())');
        $req->execute(['username'=>$username, 'email'=>$email, 'password'=>$passhash]);
 

    }

    public function login ($email, $password){

        $passhash = md5($password);
        $req = $this->getBdd()->prepare('SELECT * from users  where email = :email and password = :password and banned =false');
        $req->execute([ 'email'=>$email, 'password'=>$passhash]);
        return $req->fetch();



    }

}