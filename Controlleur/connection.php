<?php
ob_start();  
require_once("../Modele/connection.php"); 
ob_clean();
header('Content-Type: application/json'); // Pour que la réponse soit bien interprétée en JSON par JS

$email = $_POST['email'] ;
$mot_de_passe = $_POST['mot_de_passe'] ;

$result = connexion($email, $mot_de_passe);
if ($result == 0) {
    $response = ["message" => "success"]; 
    echo(json_encode($response));
} else if($result == 1){
    $response = ["message" => "Email incorrect"];
    echo(json_encode($response));
} else if($result == 2){
   $response = ["message" => "Mot de passe incorrect"];
   echo(json_encode($response));
}
?>
