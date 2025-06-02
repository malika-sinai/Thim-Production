<?php
require_once('config.php');

function recup_event($id_event) {
    global $pdo; 
    try {
        $sql = "SELECT * FROM fiture_event WHERE id_event = ?"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_event]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            $sql = "SELECT * FROM past_event WHERE id_event = ?"; 
            $stmt1 = $pdo->prepare($sql);
            $stmt1->execute([$id_event]);
            $result = $stmt1->fetch(PDO::FETCH_ASSOC); 
        }

        return $result;
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return false;  // Retourne false en cas d'erreur
    }
}

function recup_photos($id_event) {
    global $pdo; 
    try {
        $sql = "SELECT * FROM photos WHERE id_event = ?"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_event]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  
        return $result;
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return false;
    }
}


?>