<?php
// --- CONFIGURATION ---

// Répertoire de destination pour les fichiers uploadés.
const UPLOAD_DIR = 'uploads/';
// Taille maximale autorisée pour les fichiers (ici, 5 Mo).
const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5MB
// Types de fichiers autorisés (types MIME).
const ALLOWED_TYPES = ['application/pdf', 'image/jpeg', 'image/png'];

// Tableau contenant les messages à afficher à l'utilisateur.
const MESSAGES = [
    // NOTE : Ce message d'erreur pour le type de fichier invalide ne correspond pas aux types définis dans ALLOWED_TYPES.
    'invalid_type' => 'Type de fichier non autorisé. Seuls les fichiers textuels (TXT, CSV, JSON, XML, HTML) sont acceptés.',
    'too_large' => 'Le fichier est trop volumineux. Taille maximale : 5MB.',
    'upload_success' => 'Fichier uploadé avec succès : ',
    'upload_error' => 'Erreur lors de l\'upload du fichier.',
    'no_file' => 'Aucun fichier sélectionné ou erreur lors de l\'upload.',
    'invalid_method' => 'Méthode non autorisée.'
];

/**
 * Valide un fichier en fonction de son type MIME et de sa taille.
 * @param array $file Le tableau de fichier ($_FILES['...']) à valider.
 * @return bool|string Retourne `true` si le fichier est valide, sinon un message d'erreur.
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
 * Gère le déplacement du fichier uploadé vers le répertoire de destination final.
 * @param array $file Le tableau de fichier ($_FILES['...']) à uploader.
 * @return string Un message indiquant le succès ou l'échec de l'opération.
 */
function uploadFile($file) {
    // Sécurise le nom du fichier en ne gardant que le nom de base.
    $fileName = basename($file['name']);
    // Crée un nom de fichier unique pour éviter d'écraser des fichiers existants.
    $newFileName = uniqid() . '_' . $fileName;
    $destPath = UPLOAD_DIR . $newFileName;

    if (move_uploaded_file($file['tmp_name'], $destPath)) {
        return MESSAGES['upload_success'] . $newFileName;
    } else {
        return MESSAGES['upload_error'];
    }
}

// --- LOGIQUE PRINCIPALE ---

// Initialisation de la variable qui contiendra le message de retour.
$message = '';

// On vérifie que la méthode de la requête est bien POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // On vérifie si un fichier a été envoyé et qu'il n'y a pas eu d'erreur lors de l'upload.
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // On valide le fichier.
        $validation = validateFile($_FILES['file']);
        if ($validation === true) {
            // Si la validation réussit, on upload le fichier.
            $message = uploadFile($_FILES['file']);
        } else {
            // Sinon, on récupère le message d'erreur de la validation.
            $message = $validation;
        }
    } else {
        // Si aucun fichier n'a été envoyé ou s'il y a eu une erreur.
        $message = MESSAGES['no_file'];
    }
} else {
    // Si la méthode de la requête n'est pas POST.
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
    <!-- Affiche le message de résultat (succès ou erreur). -->
    <!-- htmlspecialchars() est utilisé pour se protéger contre les attaques XSS. -->
    <p><?php echo htmlspecialchars($message); ?></p>
    <a href="index.php">Retour à l'upload</a>
</body>
</html>
</html>