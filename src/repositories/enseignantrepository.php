<?php
include('../../entities/enseignant.php');
class EnseignantRepository
{
    private $bd;

    public function __construct(PDO $bd)
    {
        $this->bd = $bd;
    }

    // RECUPERATION DE TOUS LES ENSEIGNANTS
    public function getAll()
    {
        $sql = 'SELECT * FROM enseignant';
        $stmt = $this->bd->prepare($sql);
        $stmt->execute();

        $enseignants = [];
        while ($row = $stmt->fetch()) {
            $enseignants[] = new Enseignant($row);
        }

        return $enseignants;
    }

    // RECUPERATION D'UN ENSEIGNANT PAR SON ID
    public function getOne($id)
    {
        $sql = 'SELECT * FROM enseignant WHERE id = :id';
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch();

        if ($row) {
            return new Enseignant($row);
        } else {
            return null;
        }
    }

    public function getEnseignantWithEtudiant($id)
    {
        $query = $this->bd->prepare("SELECT * FROM enseignant WHERE id IN 
        ( SELECT enseignant_id FROM etudiant WHERE id = :id);");

        $query->bindParam(':id', $id);
        $query->execute();

        $result = $query->fetch(); 
        $enseignants = new Enseignant($result);

        return $enseignants;
    }

    // INSERTION
    
    public function insert(Enseignant $enseignant)
    {
        $query = $this->bd->prepare('INSERT INTO enseignant (nom, prenom, contact) VALUES (:nom, :prenom, :contact)');

        $nom = $enseignant->getNom();
        $prenom = $enseignant->getPrenom();
        $contact = $enseignant->getContact();

        $query->bindParam(':nom', $nom);
        $query->bindParam(':prenom', $prenom);
        $query->bindParam(':contact', $contact);

        $query->execute();
    }


    // MISE A JOUR

    public function update(Enseignant $enseignant)
    {
        $query = $this->bd->prepare("UPDATE enseignant SET nom = :nom, prenom = :prenom, contact = :contact WHERE id = :id");

        $id = $enseignant->getId();
        $nom = $enseignant->getNom();
        $prenom = $enseignant->getPrenom();
        $contact = $enseignant->getContact();

        $query->bindParam(':id', $id);
        $query->bindParam(':nom', $nom);
        $query->bindParam(':prenom', $prenom);
        $query->bindParam(':contact', $contact);

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

    public function delete(Enseignant $enseignant)
    {
        $query = $this->bd->prepare("DELETE FROM enseignant WHERE id = :id");
        $id = $enseignant->getId();
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
