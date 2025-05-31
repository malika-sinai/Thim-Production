<?php
require("../Modele/modele_ajout_event.php");
header('Content-Type: application/json');

$titre = $_POST['titre'];
$description = $_POST['description'];
$date = $_POST['date'];
$lien = $_POST['lien'];
$adresse = $_POST['adresse'];
$heure = $_POST['heure'];

$flyer = $_FILES['flyer'];

 if($flyer['error'] === UPLOAD_ERR_OK) {
    $tmpName = $flyer['tmp_name'];
    $name = basename($flyer['name']);
    $extension = pathinfo($name, PATHINFO_EXTENSION);
    $newName = time() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;

    $uploadDir = dirname(__DIR__) . '/uploads/image_future_ev/';
    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $uploadFile = rtrim($uploadDir, '/') . '/' . $newName;

    if (move_uploaded_file($tmpName, $uploadFile)) {
        $flyer_url = '/THIM-PRODUCTION/uploads/image_future_ev/' . $newName;
        $result = ajout_future_event($titre,$flyer_url, $description,$date,$heure,$adresse,$lien);
        if ($result != -1) {
            echo json_encode(["message" => "success" , "id_event" => $result]);
        } else if ($result == -1) {
            echo json_encode(["message" => "l'évènement a déjà été ajouté"]);
        }
    } else {
        echo json_encode(["message" => "Erreur lors du déplacement du fichier"]);
    }
} else {
    echo json_encode(["message" => "Données manquantes"]);
}
?>
