<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/indexe.css">
    <title>Ajouter un enseignant</title>
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
            <a class="nav-link textnav" aria-current="page" href="index.php">Enseignants</a>
          </li>
          <li class="nav-item">
            <a class="nav-link textnav" href="../etudiant/index.php">Etudiants</a>
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
    <h1>Ajouter un enseignant</h1>
    </section>
    
    <div class="container">
    <form action="save.php" method="post">
        <div class="mb-4">
            <label class="form-label" for="nom" style="font-weight: bold; font-size: 1.2em;">Nom :</label>
            <input class="form-control" type="text" name="nom" required>
        </div>
        <div class="mb-4">
            <label class="form-label" for="prenom" style="font-weight: bold; font-size: 1.2em;">Prénom :</label>
            <input class="form-control" type="text" name="prenom" required>
        </div>
        <div class="mb-4">
            <label class="form-label" for="contact" style="font-weight: bold; font-size: 1.2em;">Contact :</label>
            <input class="form-control" type="text" name="contact" required>
        </div>
        <button class="btn btn-primary me-5 fw-bold" type="submit" name="action" value="add">Ajouter</button>
        <a href="index.php" class="btn btn-danger fw-bold">Annuler</a>
    </form>
</div>

    

    <script src="../../js/bootstrap.bundle.min.js"></script>
</body>
</html>
