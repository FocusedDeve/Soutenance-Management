<?php
include_once('../../repositories/connectbd.php');
include_once('../../repositories/memoirerepository.php');

$memoire = null;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);

    $memoireRepo = new memoireRepository($bd);
    $memoire = $memoireRepo->getOne($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/indexe.css">
    <title>Modifier un memoire</title>
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
            <a class="nav-link textnav" href="../etudiant/index.php">Etudiants</a>
          </li>
          <li class="nav-item">
            <a class="nav-link textnav" href="index.php">Memoires</a>
          </li>
          <li class="nav-item">
            <a class="nav-link textnav" href="../thematique/index.php">Thematiques</a>
          </li>
        </ul>
        
      </div>
    </div>
</nav>   

<section class="titre text-center py-5">
<h1>Mettez les informations du memoire à jour</h1>
</section>
    
<div class="container">
    <form action="save.php" method="post">
      <div class="mb-3">
      <label class="form-label" for="titre" style="font-weight: bold; font-size: 1.2em;">Titre :</label>
        <input class="form-control" type="text" name="titre" value="<?= $memoire ? $memoire->gettitre() : '' ?>" placeholder="titre de l'memoire" required>
        </div> 
        <div class="mb-3">
        <label class="form-label" for="resume" style="font-weight: bold; font-size: 1.2em;">Résumé :</label>
        <input class="form-control" type="text" name="resume" value="<?= $memoire ? $memoire->getresume() : '' ?>" placeholder="Prétitre de l'memoire" required>
        </div> 
        <div class="mb-3">
            <label class="form-label" for="etudiant_id" style="font-weight: bold; font-size: 1.2em;">etudiant :</label>
            <select class="form-select" name="etudiant_id" id="etudiant-select" required>
            
            <?php
          //  include_once('../../entities/etudiant.php');
            include '../../repositories/etudiantrepository.php';
            include '../../repositories/connectbd.php';



            $etudiantRepository = new etudiantRepository($bd);
            $etudiant = $etudiantRepository->getAll();

            foreach ($etudiant as $item):
            ?>    
            <option value="<?= $item->getId() ?>">
              <?= $item ? $item->getNom() . ' ' . $item->getPrenom() : '' ?>
            </option>
            <?php endforeach; ?>
            </select>
        </div>

        <input type="hidden" name="id" value="<?= $memoire ? $memoire->getId() : '' ?>">
        <button class="btn btn-primary me-5 fw-bold" type="submit" name="action" value="update">Enregistrer</button>
        <a href="index.php" class="btn btn-dark fw-bold">Annuler</a>
    </form>
    </div> 
    

    <script src="../../js/bootstrap.bundle.min.js"></script>
</body>
</html>