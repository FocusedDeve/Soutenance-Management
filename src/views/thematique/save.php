<?php
include_once('../../repositories/connectbd.php');
include_once('../../repositories/thematiquerepository.php');

if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = htmlspecialchars($_POST['action']);

    switch ($action) {
        case 'add': // On veut faire l'insertion
            if (
                isset($_POST['libelle']) && !empty($_POST['libelle']) &&
                isset($_POST['description']) && !empty($_POST['description'])
            ) {
                $libelle = htmlspecialchars($_POST['libelle']);
                $description = htmlspecialchars($_POST['description']);

                $thematique = new Thematique([
                    'libelle' => $libelle,
                    'description' => $description
                ]);

                $thematiqueRepository = new ThematiqueRepository($bd);

                $thematiqueRepository->insert($thematique);

                header('location:index.php?action=insertion');
            } else {
                echo 'Il manque le libelle ou la description';
            }

            break;
        case 'update': // On veut faire la mise à jour
            if (
                isset($_POST['id']) && !empty($_POST['id']) &&
                isset($_POST['libelle']) && !empty($_POST['libelle']) &&
                isset($_POST['description']) && !empty($_POST['description'])
            ) {
                $id = htmlspecialchars($_POST['id']);
                $libelle = htmlspecialchars($_POST['libelle']);
                $description = htmlspecialchars($_POST['description']);

                $thematiqueRepository = new ThematiqueRepository($bd);

                $thematique = $thematiqueRepository->getOne($id);

                $thematique->setLibelle($libelle);
                $thematique->setDescription($description);

                $thematiqueRepository->update($thematique);

                header('location:index.php?action=update');
            } else {
                echo 'Il manque l\'id, le libelle, ou la description';
            }

            break;
        case 'delete': // On veut faire la suppression
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = htmlspecialchars($_POST['id']);

                $thematiqueRepository = new ThematiqueRepository($bd);
                $thematique = $thematiqueRepository->getOne($id);
                $thematiqueRepository->delete($thematique);

                header('location:index.php?action=suppression');
            } else {
                echo 'Il manque l\'id';
            }

            break;
        default: // Aucune action
            echo 'Aucune action';
    }
}
