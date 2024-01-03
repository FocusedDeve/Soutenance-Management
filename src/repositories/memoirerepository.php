<?php
include('../../entities/memoire.php');

class MemoireRepository
{
    private $bd;

    public function __construct(PDO $bd)
    {
        $this->bd = $bd;
    }

    // Récupère tous les memoires
    public function getAll()
    {
        $sql = 'SELECT * FROM memoire';
        $stmt = $this->bd->prepare($sql);
        $stmt->execute();

        $memoires = [];
        while ($row = $stmt->fetch()) {
            $memoires[] = new memoire($row);
        }

        return $memoires;
    }

    // Récupère un memoire par son identifiant
    public function getOne($id)
    {
        $sql = 'SELECT * FROM memoire WHERE id = :id';
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch();

        if ($row) {
            return new memoire($row);
        } else {
            return null;
        }
    }

    // public function getMemoireWithEtudiant($id)
    // {
    //     $sql = $this->bd->prepare("SELECT * FROM memoire WHERE etudiant_id=:id");
    //     $sql->bindParam(':id', $id);
    //     $sql->execute();

    //     $result = $sql->fetch();
    //     $etudiants = new etudiant($result); 

    //     return $etudiants;
    // }


    
    public function getMemoireWithEtudiant($id)
    {
        $sql = $this->bd->prepare("SELECT * FROM memoire WHERE etudiant_id=:id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        $result = $sql->fetchAll();

        $memoires = [];

        foreach ($result as $row) {
            $memoires[] = new memoire($row);
        }

        return $memoires;
    }

    // INSERTION

    public function insert(memoire $memoire)
    {
        $query = $this->bd->prepare('INSERT INTO memoire (titre, resume, etudiant_id) VALUES (:titre, :resume, :etudiant_id)');

        $titre = $memoire->getTitre();
        $resume = $memoire->getResume();
        $etudiant_id = $memoire->getEtudiantId()->getId();

        $query->bindParam(':titre', $titre);
        $query->bindParam(':resume', $resume);
        $query->bindParam(':etudiant_id', $etudiant_id);

        $query->execute();
    }

    // MISE A JOUR

    public function update(memoire $memoire)
    {
        $query = $this->bd->prepare("UPDATE memoire SET titre = :titre, resume = :resume, etudiant_id = :etudiant_id WHERE id = :id");

        $id = $memoire->getId();
        $titre = $memoire->getTitre();
        $resume = $memoire->getResume();
        $etudiant_id = $memoire->getEtudiantId();

        $query->bindParam(':id', $id);
        $query->bindParam(':titre', $titre);
        $query->bindParam(':resume', $resume);
        $query->bindParam(':etudiant_id', $etudiant_id);

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
    public function delete(memoire $memoire)
    {
        $query = $this->bd->prepare("DELETE FROM memoire WHERE id = :id");
        $id = $memoire->getId();
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
