<?php
 
  require 'classes.php';
if(isset($_POST['auteur']) AND isset($_POST['titre']) AND isset($_POST['contenu'])){
     if(!empty($_POST['auteur']) && !empty($_POST['titre']) && !empty($_POST['contenu'])) {
      $auteur = htmlspecialchars($_POST['auteur']);
      $titre = htmlspecialchars($_POST['titre']);
      $contenu = htmlspecialchars($_POST['contenu']);
  
      $add = new Ajouter($auteur, $contenu, $titre);
      $add->addNews();
     }
}else if(isset($_POST['id1']) && is_numeric($_POST['id1']) && $_POST['id1'] > 0) {
    
  $delete = new Delete($_POST['id1']);
  $row = $delete->checkIdNew();

  if($row == 1) {
    $delete->deleteNews();
  }else{
    echo "ID Error";
  }

}else if(isset($_POST['id2']) && is_numeric($_POST['id2']) && $_POST['id2'] > 0) {
    
  $afficher = new Afficher($_POST['id2']);
 
 $count = $afficher->checkNew();

 
   if($count == 1) {
    $result = $afficher->AfficherNews();

    echo "Author : " . htmlspecialchars($result['auteur']) . "<br>";
    echo "Title : " . htmlspecialchars($result['titre']) . "<br>";
    echo "News : " . htmlspecialchars($result['contenu']) . "<br>";
   }else{
     echo "ID Error";
   }

 
}



?>