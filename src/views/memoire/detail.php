<?php
include_once('../../repositories/connectbd.php');
include_once('../../repositories/memoirerepository.php');
include_once('../../repositories/etudiantrepository.php');

$memoire = null;
$etudiantRepo = new EtudiantRepository($bd);
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $memoireRepo = new MemoireRepository($bd);
    $memoire = $memoireRepo->getOne($id);

    $id = $memoire->getId();
    $etudiant = $etudiantRepo->getEtudiantWithMemoire($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/indexe.css">
    <title>Details sur le mémoire</title>
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
        <h1>Informations sur le memoire</h1>
    </section>
    <form action="save.php" method="post">
        <p style="font-size: 1.2em;"><strong>Titre :</strong> <?= $memoire ? htmlspecialchars($memoire->getTitre()) : '' ?></p>
        <p style="font-size: 1.2em;"><strong>Résumé :</strong> <?= $memoire ? htmlspecialchars($memoire->getResume()) : '' ?></p>
        <h2 class="titreh2 text-center pt-5 pb-2">CE MEMOIRE APPARTIENT A L'ETUDIANT :</h2>
        <table class="table table-hover table-light table-striped ">
        <thead class="table-dark">
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénoms</th>
            </tr>
        </thead>
        <?php 
        if ($etudiant) :
        ?> 
        <tbody>
            <tr>
                <td><?= $etudiant->getNom() ?></td>
                <td><?= $etudiant->getPrenom() ?></td>
            </tr>
            <?php
               endif; 
            ?>
        </tbody>
            </table>

        <a href="index.php" class="btn btn-dark fw-bold">Retour</a>
    </form>
    </div>
    <script src="../../js/bootstrap.bundle.min.js"></script>
</body>
</html>
