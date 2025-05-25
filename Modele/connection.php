<?php
require_once('config.php'); 

function connexion($email,$mdp) {
    global $pdo;  
    try{
    $stmt1 = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt1->execute([$email]); 
    $user = $stmt1->fetch();
    if ($user){
       if($user['mdp'] == $mdp){
        return 0;
       }
       else{
        return 2;
       }
    }
    else{
        return 1;
    }

    }catch (PDOException $e) {
       error_log("Erreur PDO : " . $e->getMessage());
    } 
}
?>
