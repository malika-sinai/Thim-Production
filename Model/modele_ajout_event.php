<?php
require_once('config.php'); 

function ajout_future_event($titre,$flyer_chemin,$description,$date,$heure,$adresse,$lien) {
    global $pdo;  
    try{
    $stmt1 = $pdo->prepare("SELECT * FROM fiture_event WHERE titre = ?");
    $stmt1->execute([$titre]); 
    $event = $stmt1->fetch();
    if ($event){
        return -1;
    }
    else{
       $stmt2 = $pdo->prepare("INSERT INTO fiture_event(titre, flyer, description, date,heure,adresse,billetrie) VALUES (?, ?, ?, ?, ?,?,?)");
       $stmt2->execute([$titre, $flyer_chemin, $description, $date,$heure,$adresse,$lien]);

       $lastId = $pdo->lastInsertId();

       return $lastId;
    }

    }catch (PDOException $e) {
       error_log("Erreur PDO : " . $e->getMessage());
    } 
}

function ajout_past_event($titre,$description,$date,$adresse,$heure,$flyer_chemin , $chemin_img) {
    global $pdo;  
    try{
    $stmt1 = $pdo->prepare("SELECT * FROM past_event WHERE titre = ?");
    $stmt1->execute([$titre]); 
    $event = $stmt1->fetch();
    if ($event){
        return -1;
    }
    else{
       $stmt2 = $pdo->prepare("INSERT INTO past_event (titre,description,date,adresse,heure,flyer) VALUES (?, ?, ?,?,?,?)");
       $stmt2->execute([$titre,$description,$date,$adresse,$heure,$flyer_chemin]);
       $lastId = $pdo->lastInsertId();

       foreach($chemin_img as $img){
        $stmt3 = $pdo->prepare("INSERT INTO photos (id_event , chemin) VALUES (?, ?)");
        $stmt3->execute([$lastId , $img]);
       }
       return $lastId;
   
    }

    }catch (PDOException $e) {
       error_log("Erreur PDO : " . $e->getMessage());
    } 
}
?>
