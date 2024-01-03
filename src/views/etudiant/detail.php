<?php
include_once('../../repositories/connectbd.php');
include_once('../../repositories/etudiantrepository.php');
include_once('../../repositories/enseignantrepository.php');
include_once('../../repositories/memoirerepository.php');

    
$enseignantRepo = new EnseignantRepository($bd);
$memoireRepo = new MemoireRepository($bd);
$etudiant = null;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $etudiantRepo = new EtudiantRepository($bd);
    $etudiant = $etudiantRepo->getOne($id);

    $id = $etudiant->getId();
    $enseignant = $enseignantRepo->getEnseignantWithEtudiant($id);
    $id = $etudiant->getId();
    $memoire = $memoireRepo->getMemoireWithEtudiant($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/indexe.css">
    <title>Details sur l'etudiant</title>
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
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <svg id="searchIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" type="submit">
                        <path d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748Z"></path>
                    </svg>            
                </form>
            </div>
        </div>  
    </nav>   

    <div class="container" style="width:60%;">
    <section class="titr text-center py-5">
        <h1>Details sur l'etudiant</h1>
    </section>
    <form action="save.php" method="post">
        <p style="font-size: 1.2em;"><strong>Nom :</strong> <?= $etudiant ? htmlspecialchars($etudiant->getNom()) : '' ?></p>
        <p style="font-size: 1.2em;"><strong>Prénom :</strong> <?= $etudiant ? htmlspecialchars($etudiant->getPrenom()) : '' ?></p>
        <h2 class="titreh2 text-center pt-5 pb-2">CET ETUDIANT EST DIRIGE PAR L'ENSEIGNANT :</h2>
        <table class="table table-hover table-light table-striped ">
        <thead class="table-dark">
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénoms</th>
                <th scope="col">Contact</th>
            </tr>
        </thead>
        <?php 
        if ($enseignant) :
        ?> 
        <tbody>
            <tr>
                <td><?= $enseignant->getNom() ?></td>
                <td><?= $enseignant->getPrenom() ?></td>
                <td><?= $enseignant->getContact() ?></td>
            </tr>
        </tbody>
            </table>
            <?php else : ?>
            <h2 class="titreh2 text-center pt-5 pb-2">Aucun memoire attribue a cet etudiant.</h2>
        <?php endif; ?>


        <a href="index.php" class="btn btn-dark fw-bold">Retour</a>
    </form>
    </div>
    <script src="../../js/bootstrap.bundle.min.js"></script>
</body>
</html>