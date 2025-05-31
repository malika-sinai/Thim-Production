<?php
require_once('config.php');

function recup_future_event() {
    global $pdo; 
    try {
        $sql = "SELECT * FROM fiture_event ORDER BY date ASC"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return false;  // Retourne false en cas d'erreur
    }
}

function recup_past_event() {
    global $pdo; 
    try {
        $sql = "SELECT * FROM past_event"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return false;  // Retourne false en cas d'erreur
    }
}

?>
