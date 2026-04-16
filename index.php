<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Upload de Fichier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Uploader un fichier</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">Parcourir ses documents :</label>
        <input type="file" name="file" id="file" required>
        <br><br>
        <button type="submit">Envoyer</button>
    </form>
    <!-- Chats qui tournent -->
    <div class="floating-cat cat1"><img src="image.png" alt="Chat 1"></div>
    <div class="floating-cat cat2"><img src="IMG_2720.JPG" alt="Chat 2"></div>
    <div class="floating-cat cat3"><img src="image.png" alt="Chat 3"></div>
    <div class="floating-cat cat4"><img src="IMG_2720.JPG" alt="Chat 4"></div>
    <!-- Ping Pong Game -->
    <div class="ping-pong">
        <div class="paddle left-paddle">🏓</div>
        <div class="paddle right-paddle">🏓</div>
        <div class="ball">⚪</div>
    </div>
</body>
</html>