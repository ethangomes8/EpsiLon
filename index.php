<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Upload de Fichier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include 'header.php'; ?>
    <h1>Uploader un fichier</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">Parcourir ses documents :</label>
        <input type="file" name="file" id="file" required> 
        <button type="submit">Envoyer</button>
    </form>
    <h1> ETHAN GOMES </h1>
</body>
</html>