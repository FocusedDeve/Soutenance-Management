<?php
// Inclusion des fichiers nécessaires
include_once('../../repositories/connectbd.php');
include_once('../../repositories/memoirerepository.php');
include_once('../../repositories/etudiantrepository.php');





if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = htmlspecialchars($_POST['action']);

    switch ($action) {

        // INSERTION
        case 'add': 
            if (
                isset($_POST['titre']) && !empty($_POST['titre']) &&
                isset($_POST['resume']) && !empty($_POST['resume']) &&
                isset($_POST['etudiant_id']) && !empty($_POST['etudiant_id'])
            ) {
                $titre = htmlspecialchars($_POST['titre']);
                $resume = htmlspecialchars($_POST['resume']);
                $etudiant_id = htmlspecialchars($_POST['etudiant_id']);

                $data = [
                    'titre' => $titre,
                    'resume' => $resume
                ];
                $memoire = new memoire($data);

                $etudiantRepo = new etudiantRepository($bd);
                $etudiant_id = $etudiantRepo->getOne($etudiant_id);
                $memoire->setEtudiantId($etudiant_id);

                $memoireRepo = new memoireRepository($bd);
                $memoireRepo->insert($memoire);

                header('location:index.php?action=insertion');
            } else {
                echo 'Il manque le titre, le resume, ou le etudiant_id';
            }

        break;

        // MISE A JOUR

        case 'update': 
            if (
                isset($_POST['id']) && !empty($_POST['id']) &&
                isset($_POST['titre']) && !empty($_POST['titre']) &&
                isset($_POST['resume']) && !empty($_POST['resume']) &&
                isset($_POST['etudiant_id']) && !empty($_POST['etudiant_id'])
                ) {
                $id = htmlspecialchars($_POST['id']);
                $titre = htmlspecialchars($_POST['titre']);
                $resume = htmlspecialchars($_POST['resume']);
                $etudiant_id = htmlspecialchars($_POST['etudiant_id']);
    
                $memoireRepo = new memoireRepository($bd);
                $memoire = $memoireRepo->getOne($id);
    
                $memoire->setTitre($titre);
                $memoire->setResume($resume);
                $memoire->setEtudiantId($etudiant_id);
    
                $memoireRepo->update($memoire);
    
                header('location:index.php?action=update');
            } else {
                echo 'Il manque le titre, le resume, ou le etudiant_id';
            }
    
        break;

        // SUPPRESSION

        case 'delete': 
            if (
                isset($_POST['id']) && !empty($_POST['id'])
                ) {
                $id = htmlspecialchars($_POST['id']);
    
                $memoireRepo = new memoireRepository($bd);
                $memoire = $memoireRepo->getOne($id);
    
                $memoireRepo->delete($memoire);
    
                header('location:index.php?action=suppression');
            } else {
                echo 'Il manque l\'id';
            }
    
        break;
    }
}

?>