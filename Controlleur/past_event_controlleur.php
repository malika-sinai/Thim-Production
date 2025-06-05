<?php
require("../Modele/modele_ajout_event.php");
header('Content-Type: application/json');

$titre = $_POST['titre'];
$description = $_POST['description'];
$adresse = $_POST['adresse'];
$heure = $_POST['heure'];
$date = $_POST['date'];
$flyer = $_FILES['flyer'];
$image = $_FILES['image'];
$chemin_img = [];

 if($flyer['error'] === UPLOAD_ERR_OK && isset($image) ) {
    foreach ($image['tmp_name'] as $key => $tmpName) {
     if ($image['error'][$key] === UPLOAD_ERR_OK) {
        $originalName = basename($image['name'][$key]);
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);

        // Génère un nom de fichier unique
        $newName = time() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;

        // Répertoire de destination
        $uploadDir = dirname(__DIR__) . '/uploads/image&video_past_ev/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Chemin final du fichier
        $uploadFile = rtrim($uploadDir, '/') . '/' . $newName;

        // Déplace le fichier temporaire vers le dossier final
        if (move_uploaded_file($tmpName, $uploadFile)) {
            $chemin_img[] = '/THIM-PRODUCTION/uploads/image&video_past_ev/'.$newName;
        }
     }
    }

 $tmpName = $flyer['tmp_name'];
 $name = basename($flyer['name']);
 $extension = pathinfo($name, PATHINFO_EXTENSION);
 $newName = time() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
 $uploadDir = dirname(__DIR__) . '/uploads/image&video_past_ev/';
    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $uploadFile = rtrim($uploadDir, '/') . '/' . $newName;

    if (move_uploaded_file($tmpName, $uploadFile)) {
        $flyer_url = '/THIM-PRODUCTION/uploads/image&video_past_ev/'.$newName;
        $result = ajout_past_event($titre, $description,$date,$adresse,$heure, $flyer_url ,$chemin_img);
        if ($result != -1) {
            echo json_encode(["message" => "success" , "id_event" => $result]);
        } else if ($result == -1) {
            echo json_encode(["message" => "l'évènement a déjà été ajouté"]);
        }
    } else {
        echo json_encode(["message" => "Erreur lors du déplacement du fichier"]);
    }
} 

else {
    echo json_encode(["message" => "Données manquantes"]);
}
?>
