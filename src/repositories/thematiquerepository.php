<?php
include('../../entities/thematique.php');

class ThematiqueRepository
{
    private $bd;

    public function __construct(PDO $bd)
    {
        $this->bd = $bd;
    }

    // RECUPERATION DE TOUS LES thematiqueS
    public function getAll()
    {
        $sql = 'SELECT * FROM thematique';
        $stmt = $this->bd->prepare($sql);
        $stmt->execute();

        $thematiques = [];
        while ($row = $stmt->fetch()) {
            $thematiques[] = new thematique($row);
        }

        return $thematiques;
    }

    // RECUPERATION D'UN thematique PAR SON ID
    public function getOne($id)
    {
        $sql = 'SELECT * FROM thematique WHERE id = :id';
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch();

        if ($row) {
            return new thematique($row);
        } else {
            return null;
        }
    }

    // INSERTION
    
    public function insert(thematique $thematique)
    {
        $query = $this->bd->prepare('INSERT INTO thematique (libelle, description) VALUES (:libelle, :description)');

        $libelle = $thematique->getLibelle();
        $description = $thematique->getDescription();

        $query->bindParam(':libelle', $libelle);
        $query->bindParam(':description', $description);

        $query->execute();
    }


    // MISE A JOUR

    public function update(thematique $thematique)
    {
        $query = $this->bd->prepare("UPDATE thematique SET libelle = :libelle, description = :description WHERE id = :id");

        $id = $thematique->getId();
        $libelle = $thematique->getLibelle();
        $description = $thematique->getDescription();

        $query->bindParam(':id', $id);
        $query->bindParam(':libelle', $libelle);
        $query->bindParam(':description', $description);

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

    public function delete(thematique $thematique)
    {
        $query = $this->bd->prepare("DELETE FROM thematique WHERE id = :id");
        $id = $thematique->getId();
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
