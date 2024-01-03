<?php
// Inclusion des fichiers nécessaires
include_once('../../repositories/connectbd.php');
// include_once('../../entities/etudiant.php');
include_once('../../repositories/etudiantrepository.php');
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
                isset($_POST['enseignant_id']) && !empty($_POST['enseignant_id'])
            ) {
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $enseignant_id = htmlspecialchars($_POST['enseignant_id']);

                $data = [
                    'nom' => $nom,
                    'prenom' => $prenom
                ];
                $etudiant = new Etudiant($data);

                $enseignantRepo = new EnseignantRepository($bd);
                $enseignant_id = $enseignantRepo->getOne($enseignant_id);
                $etudiant->setEnseignantId($enseignant_id);

                $etudiantRepo = new EtudiantRepository($bd);
                $etudiantRepo->insert($etudiant);

                header('location:index.php?action=insertion');
            } else {
                echo 'Il manque le nom, le prenom, ou le enseignant_id';
            }

        break;

        // MISE A JOUR

        case 'update': 
            if (
                isset($_POST['id']) && !empty($_POST['id']) &&
                isset($_POST['nom']) && !empty($_POST['nom']) &&
                isset($_POST['prenom']) && !empty($_POST['prenom']) &&
                isset($_POST['enseignant_id']) && !empty($_POST['enseignant_id'])
                ) {
                $id = htmlspecialchars($_POST['id']);
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $enseignant_id = htmlspecialchars($_POST['enseignant_id']);
    
                $etudiantRepo = new EtudiantRepository($bd);
                $etudiant = $etudiantRepo->getOne($id);
    
                $etudiant->setNom($nom);
                $etudiant->setPrenom($prenom);
                $etudiant->setEnseignantId($enseignant_id);
    
                $etudiantRepo->update($etudiant);
    
                header('location:index.php?action=update');
            } else {
                echo 'Il manque le nom, le prenom, ou le enseignant_id';
            }
    
        break;

        // SUPPRESSION

        case 'delete': 
            if (
                isset($_POST['id']) && !empty($_POST['id'])
                ) {
                $id = htmlspecialchars($_POST['id']);
    
                $etudiantRepo = new etudiantRepository($bd);
                $etudiant = $etudiantRepo->getOne($id);
    
                $etudiantRepo->delete($etudiant);
    
                header('location:index.php?action=suppression');
            } else {
                echo 'Il manque l\'id';
            }
    
        break;
    }
}

?>