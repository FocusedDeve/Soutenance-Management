<?php
// Inclusion des fichiers nécessaires
include_once('../../repositories/connectbd.php');
// include_once('../../entities/enseignant.php');
include_once('../../repositories/enseignantrepository.php');


if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = htmlspecialchars($_POST['action']);

    switch ($action) {

        // INSERTION
        case 'add': 
            if (
                isset($_POST['nom']) && !empty($_POST['nom']) &&
                isset($_POST['prenom']) && !empty($_POST['prenom']) &&
                isset($_POST['contact']) && !empty($_POST['contact'])
            ) {
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $contact = htmlspecialchars($_POST['contact']);

                $data = [
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'contact' => $contact
                ];
                $enseignant = new Enseignant($data);
                $enseignantRepo = new EnseignantRepository($bd);
                $enseignantRepo->insert($enseignant);

                header('location:index.php?action=insertion');
            } else {
                echo 'Il manque le nom, le prenom, ou le contact';
            }

        break;

        // MISE A JOUR

        case 'update': 
            if (
                isset($_POST['id']) && !empty($_POST['id']) &&
                isset($_POST['nom']) && !empty($_POST['nom']) &&
                isset($_POST['prenom']) && !empty($_POST['prenom']) &&
                isset($_POST['contact']) && !empty($_POST['contact'])
                ) {
                $id = htmlspecialchars($_POST['id']);
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $contact = htmlspecialchars($_POST['contact']);
    
                $enseignantRepo = new EnseignantRepository($bd);
                $enseignant = $enseignantRepo->getOne($id);
    
                $enseignant->setNom($nom);
                $enseignant->setPrenom($prenom);
                $enseignant->setContact($contact);
    
                $enseignantRepo->update($enseignant);
    
                header('location:index.php?action=update');
            } else {
                echo 'Il manque le nom, le prenom, ou le contact';
            }
    
        break;

        // SUPPRESSION

        case 'delete': 
            if (
                isset($_POST['id']) && !empty($_POST['id'])
                ) {
                $id = htmlspecialchars($_POST['id']);
    
                $enseignantRepo = new EnseignantRepository($bd);
                $enseignant = $enseignantRepo->getOne($id);
    
                $enseignantRepo->delete($enseignant);
    
                header('location:index.php?action=suppression');
            } else {
                echo 'Il manque l\'id';
            }
    
        break;
    }
}

?>