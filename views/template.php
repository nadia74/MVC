<!DOCTYPE html>
<html>
<head>
      <link href="views/materialize.css" rel="stylesheet" type="text/css">
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"><meta charset = "utf-8"/>
      <title><?= $t ?></title>
</head>
<body>
<div class="">
    <nav >
      <div class="nav-wrapper">
      <a href = "<?= URL ?>" class="brand-logo">Le blog du Mont Blanc</a>
        <ul class="right hide-on-med-and-down">
<?php 
require_once('models/Session.php');

use App\Helpers\Session;
$go =Session::getInstance()->get('groupofloggeduser');
$name = Session::getInstance()->get('name');

if ($go !=""){

  echo "<li><a href=\"logout\">Logout</a></li>";
  if ($go =="admin"){
    echo "<li><a href=\"admin\">Gérer le blog</a></li>";
    echo "<li><a href=\"gestwriter\">Gérer les artciles</a></li>";

    echo "<li>Bienvenue $name.Vous êtes loggé en tant qu'administrateur </li>";
  
  }
  else if ($go =="writer"){
    echo "<li><a href=\"gestwriter\">Gérer Mes artciles</a></li>";
    echo "<li>Bienvenue $name.Vous êtes loggé en tant que rédacteur </li>";
  
  }
}

else {
  
  echo "<li><a href=\"login\">Login</a></li>";
  echo   "<li><a href=\"register\">Register</a></li>";

}


?>
        </ul>
      </div>
    </nav>
  </div>
<header>
</header>

<main >
<?= $content ?>
</main>
<footer class="page-footer">
      <p> Créé depuis mon salon</p>
      
</footer>
</body>


</html>
