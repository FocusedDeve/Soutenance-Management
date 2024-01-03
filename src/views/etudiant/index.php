<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/indexe.css">
    <title>Liste des etudiants</title>
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
<h1>Liste des etudiants</h1>
</section>
    <?php
    // Afficher la liste des étudiants depuis la base de données
    include '../../repositories/etudiantrepository.php';
    // Récupérer la connexion à la base de données
    include '../../repositories/connectbd.php';

    $etudiantRepository = new etudiantRepository($bd);

    $etudiant = $etudiantRepository->getAll();
    ?>
    <div class="container" style="width:100%;">
    <table class="table table-hover table-bordered border-primary  ">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénoms</th>
                <th scope="col" style="text-align: right; padding-right: 70px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
                foreach ($etudiant as $item) :
            ?>
            <tr>
                <th scope="row"><?= $i ?></td>
                <td><?= $item->getNom() ?></td>
                <td><?= $item->getPrenom() ?></td>
                <td style="text-align: right;">
                    <a href="detail.php?id=<?= $item->getId() ?>" class="btn btn-outline-success btn-sm">Details</a>
                    <a href="update.php?id=<?= $item->getId() ?>" class="btn btn-outline-primary btn-sm">Modifier</a>
                    <a href="delete.php?id=<?= $item->getId() ?>" class="btn btn-outline-danger btn-sm">Supprimer</a>
                </td>
            </tr>
            <?php
                $i++;
                endforeach;
            ?>
        </tbody>
    </table>

    <a href="add.php" class="btn btn-primary fw-bold">Nouveau etudiant</a>
    </div>
    <script src="../../js/bootstrap.bundle.min.js"></script>
</body>
</html>
