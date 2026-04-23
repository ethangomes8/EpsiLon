<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Upload de Fichier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php // Inclusion de l'en-tête de la page
    include 'header.php'; ?>
    <h1>Uploader un fichier</h1>
    <!-- Formulaire d'upload de fichier qui envoie les données à upload.php via POST -->
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">Parcourir ses documents :</label>
        <input type="file" name="file" id="file" required> <!-- Champ de sélection de fichier, obligatoire -->
        <br><br>
        <button type="submit">Envoyer</button>
    </form>
    <h1> ETHAN GOMES </h1>
</body>
</html>