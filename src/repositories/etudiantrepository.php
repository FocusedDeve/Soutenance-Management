<?php
include('../../entities/etudiant.php');
class EtudiantRepository
{
    private $bd;

    public function __construct(PDO $bd)
    {
        $this->bd = $bd;
    }

    // Récupère tous les étudiants
    public function getAll()
    {
        $sql = 'SELECT * FROM etudiant';
        $stmt = $this->bd->prepare($sql);
        $stmt->execute();

        $etudiants = [];
        while ($row = $stmt->fetch()) {
            $etudiants[] = new Etudiant($row);
        }

        return $etudiants;
    }

    // Récupère un étudiant par son identifiant
    public function getOne($id)
    {
        $sql = 'SELECT * FROM etudiant WHERE id = :id';
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch();

        if ($row) {
            return new Etudiant($row);
        } else {
            return null;
        }
    }


    public function getEtudiantsOfEnseignant($id)
    {
        $sql = $this->bd->prepare("SELECT * FROM etudiant WHERE enseignant_id=:id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        $result = $sql->fetchAll();

        $etudiants = [];

        foreach ($result as $row) {
            $etudiants[] = new etudiant($row); // Assurez-vous d'ajuster les colonnes selon votre base de données
        }

        return $etudiants;
    }


        public function getEtudiantWithMemoire($id)
       {
           $query = $this->bd->prepare("SELECT * FROM etudiant WHERE id IN 
           ( SELECT etudiant_id FROM memoire WHERE id = :id);");
   
           $query->bindParam(':id', $id);
           $query->execute();
   
           $result = $query->fetch(); 
           $etudiants = new etudiant($result);
   
           return $etudiants;
       }

    // INSERTION

    public function insert(Etudiant $etudiant)
    {
        $query = $this->bd->prepare('INSERT INTO etudiant (nom, prenom, enseignant_id) VALUES (:nom, :prenom, :enseignant_id)');

        $nom = $etudiant->getNom();
        $prenom = $etudiant->getPrenom();
        $enseignant_id = $etudiant->getEnseignantId()->getId();

        $query->bindParam(':nom', $nom);
        $query->bindParam(':prenom', $prenom);
        $query->bindParam(':enseignant_id', $enseignant_id);

        $query->execute();
    }

    // MISE A JOUR

    public function update(Etudiant $etudiant)
    {
        $query = $this->bd->prepare("UPDATE etudiant SET nom = :nom, prenom = :prenom, enseignant_id = :enseignant_id WHERE id = :id");

        $id = $etudiant->getId();
        $nom = $etudiant->getNom();
        $prenom = $etudiant->getPrenom();
        $enseignant_id = $etudiant->getEnseignantId();

        $query->bindParam(':id', $id);
        $query->bindParam(':nom', $nom);
        $query->bindParam(':prenom', $prenom);
        $query->bindParam(':enseignant_id', $enseignant_id);

        // Exécution de la requête
        $result = $query->execute();

        // Vérifier si la mise à jour a réussi
        if ($result) {
            echo "La modification a été effectuée avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la modification.";
        }
    }

    // SUPPRESSION
    public function delete(Etudiant $etudiant)
    {
        $query = $this->bd->prepare("DELETE FROM etudiant WHERE id = :id");
        $id = $etudiant->getId();
        $query->bindParam(':id', $id);
        // Exécution de la requête
        $result = $query->execute();
        // Vérifier si la mise à jour a réussi
        if ($result) {
            echo "La suppression a été effectuée avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la suppression.";
        }

    }
}

?>
