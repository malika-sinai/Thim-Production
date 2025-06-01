<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$name = $data['name'] ?? '';
$email = $data['email'] ?? '';
$message = $data['message'] ?? '';

$destinataire = "thimprodution22@gmail.com";

if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    echo json_encode(["message" => "Tous les champs sont obligatoires."]);
    exit;
}

$sujet = "Nouveau message de $name via le formulaire de contact";

$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=utf-8\r\n";

if (mail($destinataire, $sujet, $message, $headers)) {
    http_response_code(200);
    echo json_encode(["message" => "Message envoyé avec succès."]);
} else {
    http_response_code(500);
    echo json_encode(["message" => "Erreur lors de l'envoi de l'email."]);
}
?>
