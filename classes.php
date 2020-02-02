<?php
// classfor Database connection
abstract class POO {
    public function dbConnect() {
        try {
            $db = new PDO('mysql:host=127.0.0.1;dbname=news;charset=utf8', 'root', '');
        }catch(Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $db;
    }
    
}

// class for adding a new Book 

class Ajouter extends POO{
    // atributs for our book
    private $auteur;
    private $contenu;
    private $titre;
     public function __construct($auteur, $contenu, $titre) {
         $this->setAuteur($auteur);
         $this->setContenu($contenu);
         $this->setTitre($titre);

     }
     // setters
    public function setAuteur($auteur) {
        if(is_string($auteur)) {
            $this->auteur = $auteur;
        }

    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }
    public function setTitre($titre) {
        $this->titre = $titre;
    }
    // getters

    public function auteur() {return $this->auteur;}
    public function contenu() {return $this->contenu;}
    public function titre() {return $this->titre;}

    public function addNews() {
        $q = $this->dbConnect()->prepare('INSERT INTO new(auteur, titre, contenu) VALUES(:auteur, :titre, :contenu)');
        $q->execute(array(
            'auteur' => $this->auteur(),
            'titre' => $this->titre(),
            'contenu' => $this->contenu()
        ));

        echo "The Book had been Added :)";
    }
 
}

// class for deleting a book using ID
class Delete extends POO {
    private $id;

    public function __construct($id) {
        $this->setId($id);
    }
    // setters
    public function setId($id) {
        if(is_numeric($id) && $id > 0)  {
            $this->id = $id;
        }
    }
    //getters
    public function id() {return $this->id;}


    public function deleteNews() {
        $q = $this->dbConnect()->prepare('DELETE FROM new WHERE id = :id');
        $q->execute(array(
            'id' => $this->id()
        ));

        echo "The Book had been deleted :)";
       
    }
     // a function the check if the ID is existed
    public function checkIdNew() {
        $q = $this->dbConnect()->prepare('SELECT id FROM new WHERE id = :id');
        $q->execute(array(
            'id' => $this->id()
        ));
        $row = $q->rowCount();

         return $row;
    }

}
// class for showing a book using ID
class Afficher extends POO {
    private $id;
    
    public function __construct($id) {
        $this->setId($id);


    }
    // getters
    public function id() {
        return $this->id;
    }
    //setters
    public function setId($id) {
       
           if($id > 0 && is_numeric($id)) {
            $this->id = $id;
           }
     
    }
    public function AfficherNews() {
        $q = $this->dbConnect()->prepare('SELECT auteur, titre, contenu FROM new WHERE id = :id');
        $q->execute(array(
            'id' => $this->id()
        ));

        $result = $q->fetch();
            
       return $result;
    }

    public function checkNew() {
        $q = $this->dbConnect()->prepare('SELECT auteur, titre, contenu FROM new WHERE id = :id');
        $q->execute(array(
            'id' => $this->id()
        ));
        $count = $q->rowCount();

          return $count;
    }
}