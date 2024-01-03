<?php
include_once('../../repositories/connectbd.php');
// include_once('../../entities/etudiant.php');
include_once('../../repositories/etudiantrepository.php');

$etudiant = null;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);

    $etudiantRepo = new EtudiantRepository($bd);
    $etudiant = $etudiantRepo->getOne($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/indexe.css">
    <title>Modifier un etudiant</title>
</head>
<body>

    <nav class="barre navbar navbar-expand-lg">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link textnav" aria-current="page" href="../enseignant/index.php">Enseignants</a>
          </li>
          <li class="nav-item">
            <a class="nav-link textnav" href="index.php">Etudiants</a>
          </li>
          <li class="nav-item">
            <a class="nav-link textnav" href="../memoire/index.php">Memoires</a>
          </li>
          <li class="nav-item">
            <a class="nav-link textnav" href="../thematique/index.php">Thematiques</a>
          </li>
        </ul>
       
      </div>
    </div>
</nav>   

<section class="titre text-center py-5">
<h1>Mise à jour des informations de l'etudiant</h1>
</section>
    
<div class="container">
    <form action="save.php" method="post">
      <div class="mb-3">
      <label class="form-label" for="nom" style="font-weight: bold; font-size: 1.2em;">Nom :</label>
        <input class="form-control" type="text" name="nom" value="<?= $etudiant ? $etudiant->getNom() : '' ?>" placeholder="Nom de l'etudiant" required>
        </div> 
        <div class="mb-3">
        <label class="form-label" for="prenom" style="font-weight: bold; font-size: 1.2em;">Prénom :</label>
        <input class="form-control" type="text" name="prenom" value="<?= $etudiant ? $etudiant->getPrenom() : '' ?>" placeholder="Prénom de l'etudiant" required>
        </div> 
        <div class="mb-3">
            <label class="form-label" for="enseignant_id" style="font-weight: bold; font-size: 1.2em;">Enseignant :</label>
            <select class="form-select" name="enseignant_id" id="enseignant-select" required>
            
            <?php
            //include_once('../../entities/enseignant.php');
            include '../../repositories/enseignantrepository.php';
            include '../../repositories/connectbd.php';

            $enseignantRepository = new enseignantRepository($bd);
            $enseignant = $enseignantRepository->getAll();
            foreach ($enseignant as $item):
            ?>    
            <option value="<?= $item->getId() ?>">
              <?= $item ? $item->getNom() . ' ' . $item->getPrenom() : '' ?>
            </option>
            <?php endforeach; ?>
            </select>
        </div>

        <input type="hidden" name="id" value="<?= $etudiant ? $etudiant->getId() : '' ?>">
        <button class="btn btn-primary me-5 fw-bold" type="submit" name="action" value="update">Enregistrer</button>
        <a href="index.php" class="btn btn-danger fw-bold">Annuler</a>
    </form>
    </div> 
    

    <script src="../../js/bootstrap.bundle.min.js"></script>
</body>
</html>
