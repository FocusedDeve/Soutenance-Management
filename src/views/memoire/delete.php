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
    <title>Supprimer un memoire</title>
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

    <div class="container" style="width:60%;">
    <section class="titr text-center py-5">
        <h1>Vous etes sur le point de supprimer un memoire !</h1>
    </section>
    <form action="save.php" method="post">
        <p style="font-size: 1.2em;"><strong>Titre :</strong> <?= $memoire ? htmlspecialchars($memoire->getTitre()) : '' ?></p>
        <p style="font-size: 1.2em;"><strong>Résumé :</strong> <?= $memoire ? htmlspecialchars($memoire->getResume()) : '' ?></p>
        <input type="hidden" name="id" value="<?= $memoire ? $memoire->getId() : '' ?>">
        <button class="btn btn-danger me-5 fw-bold" name="action" value="delete">Supprimer</button>
        <a href="index.php" class="btn btn-primary fw-bold">Annuler</a>
    </form>
    </div>
    <script src="../../js/bootstrap.bundle.min.js"></script>
</body>
</html>
