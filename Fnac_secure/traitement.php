<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="fnac.png" type="image/png">
    <title>Fnac front</title>
  </head>
  <body>
  <div class="container">
  <h1>Fnac: recherche dans le catalogue</h1>
<?php

require 'sqlconnect.php';

$str = $_REQUEST["carac"];
$selection =$_REQUEST["choix"];


if($_REQUEST["choix"] == "Titre"){
    $requete =$connection->prepare( "SELECT * FROM books WHERE title LIKE :titre");
    $titre = '%' . $str . '%';
    $requete->bindParam(':titre', $titre, PDO::PARAM_STR);
    $requete->execute();
    $count = $requete->rowCount();
    echo '<h4>Nombre d\'éléments trouvés : ' . $count . '</h4><br>';
while($ligne = $requete->fetch()) {
    
    echo "<p class=gras>Titre = ".$ligne['title']."</p></br>";
    echo "<p>Auteur = ".$ligne['author']."</p></br>";
    echo "<p>ISBN = ".$ligne['isbn']."</p></br>";
    echo "<p>Prix = ".$ligne['price']."</p></br>";

}
}
elseif ($_REQUEST["choix"] == "ISBN") {
    $requete = $connection->prepare("SELECT * FROM books WHERE ISBN LIKE :isbn");
    $isbn = '%' . $str . '%';
    $requete->bindParam(':isbn', $isbn, PDO::PARAM_STR);
    $requete->execute();
    
    $count = $requete->rowCount();
    echo '<h4>Nombre d\'éléments trouvés : ' . $count . '</h4><br>';
while($ligne = $requete->fetch()) {
   
    echo "<p>Titre = ".$ligne['title']."</p></br>";
    echo "<p>Auteur = ".$ligne['author']."</p></br>";
    echo "<p class=gras>ISBN = ".$ligne['isbn']."</p></br>";
    echo "<p>Prix = ".$ligne['price']."</p></br>";
}
}
elseif ($_REQUEST["choix"] == "Auteur") {
    $requete = $connection->prepare("SELECT * FROM books WHERE author LIKE :auteur");
$auteur = '%' . $str . '%';
$requete->bindParam(':auteur', $auteur, PDO::PARAM_STR);
$requete->execute();
 
    $count = $requete->rowCount();
    echo '<h4>Nombre d\'éléments trouvés : ' . $count . '</h4><br>';
while($ligne = $requete->fetch()) {
    
    echo "<p>Titre = ".$ligne['title']."</p></br>";
    echo "<p class=gras>Auteur = ".$ligne['author']."</p></br>";
    echo "<p>ISBN = ".$ligne['isbn']."</p></br>";
    echo "<p>Prix = ".$ligne['price']."</p></br>";
}
}
$requete->closeCursor();

?>
</div>
</body>
</html>

