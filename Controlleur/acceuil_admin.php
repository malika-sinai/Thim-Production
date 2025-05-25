<?php
require_once("../Modele/acceuil_admin.php"); 
header('Content-Type: application/json; charset=utf-8');

$past_event = recup_past_event();
$future_event = recup_future_event();

$table_past = [];
$table_future = [];

// Construction des lignes pour les événements passés
if (count($past_event) != 0) {
    foreach ($past_event as $value) {
        $titre = htmlspecialchars($value['titre']);
        $table_past[] = "<tr><td>{$titre}</td></tr>";
    }
} else {
    $table_past[] = "<tr><td>Aucun évènement passé</td></tr>";
}

// Construction des lignes pour les événements à venir
if (count($future_event) != 0) {
    foreach ($future_event as $value1) {
        $titre = htmlspecialchars($value1['titre']);
        $id_event = urlencode($value1['id_event']);
        $table_future[] = "<tr><td>{$titre} <a href=\"../Controlleur/delete_event.php?id_event={$id_event}\" class=\"delete-btn\">Supprimer</a></td></tr>";
    }
} else {
    $table_future[] = "<tr><td>Aucun évènement à venir</td></tr>";
}

// Encodage JSON final
echo json_encode([
    "table_past" => $table_past,
    "table_future" => $table_future
]);
