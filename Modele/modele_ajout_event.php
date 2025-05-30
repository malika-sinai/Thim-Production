<?php
require_once('config.php'); 

function ajout_future_event($titre,$description,$date,$lien, $flyer_chemin) {
    global $pdo;  
    try{
    $stmt1 = $pdo->prepare("SELECT * FROM fiture_event WHERE titre = ?");
    $stmt1->execute([$titre]); 
    $event = $stmt1->fetch();
    if ($event){
        return -1;
    }
    else{
       $stmt2 = $pdo->prepare("INSERT INTO fiture_event (titre, flyer, description, date, billetrie) VALUES (?, ?, ?, ?, ?)");
       $stmt2->execute([$titre, $flyer_chemin, $description, $date, $lien]);

       $lastId = $pdo->lastInsertId();

       return $lastId;
    }

    }catch (PDOException $e) {
       error_log("Erreur PDO : " . $e->getMessage());
    } 
}
?>
