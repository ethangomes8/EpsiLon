<?php
const UPLOAD_DIR = 'uploads/';

const MAX_FILE_SIZE = 5 * 1024 * 1024; 

const ALLOWED_TYPES = ['application/pdf', 'image/jpeg', 'image/png'];

const MESSAGES = [
    'invalid_type' => 'Type de fichier non autorisé. Seuls les fichiers textuels (TXT, CSV, JSON, XML, HTML) sont acceptés.',
    'too_large' => 'Le fichier est trop volumineux. Taille maximale : 5MB.',
    'upload_success' => 'Fichier uploadé avec succès : ',
    'upload_error' => 'Erreur lors de l\'upload du fichier.',
    'no_file' => 'Aucun fichier sélectionné ou erreur lors de l\'upload.',
    'invalid_method' => 'Méthode non autorisée.'
];

/**
 * @param array
 * @return bool|string
 */
function validateFile($file) {
    $fileType = $file['type'];
    $fileSize = $file['size'];

    if (!in_array($fileType, ALLOWED_TYPES)) {
        return MESSAGES['invalid_type'];
    }
    if ($fileSize > MAX_FILE_SIZE) {
        return MESSAGES['too_large'];
    }
    return true; 
}

/**
 * @param array
 * @return string
 */
function uploadFile($file) {

    $fileName = basename($file['name']);

    $newFileName = uniqid() . '_' . $fileName;
    $destPath = UPLOAD_DIR . $newFileName;

    if (move_uploaded_file($file['tmp_name'], $destPath)) {
        return MESSAGES['upload_success'] . $newFileName;
    } else {
        return MESSAGES['upload_error'];
    }
}


$message = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {

        $validation = validateFile($_FILES['file']);
        if ($validation === true) {

            $message = uploadFile($_FILES['file']);
        } else {

            $message = $validation;
        }
    } else {

        $message = MESSAGES['no_file'];
    }
} else {

    $message = MESSAGES['invalid_method'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat de l'Upload</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Résultat</h1>

    <p><?php echo htmlspecialchars($message); ?></p>
    <a href="index.php">Retour à l'upload</a>
</body>
</html>
</html>