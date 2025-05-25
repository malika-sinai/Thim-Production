<?php
require_once('config.php');

function recup_past_event(){
    global $pdo; 
    $result = [];
    try {
        $sql = "SELECT * FROM past_event";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $result[] = $row;
        }
        return $result;
    }catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return "erreur_sql";
    }  

}

function recup_future_event(){
    global $pdo; 
    $result = [];
    try {
        $sql = "SELECT * FROM fiture_event";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $result[] = $row;
        }
        return $result;
    }catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return "erreur_sql";
    }  

}







?>