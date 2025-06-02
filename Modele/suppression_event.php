<?php
// Inclure ton fichier de configuration
require_once(__DIR__ . '/../config.php'); // adapte le chemin selon ton arborescence

try {
    // On suppose que la connexion $pdo est déjà définie dans config.php
    // Supprime les événements dont la date est antérieure à aujourd'hui
    $sql = "DELETE FROM fiture_event WHERE date < CURDATE()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    echo "Événements expirés supprimés : " . $stmt->rowCount() . " événement(s).\n";

} catch (PDOException $e) {
    echo "Erreur lors de la suppression : " . $e->getMessage() . "\n";
    exit(1);
}
?>
