<?php
require_once("../Modele/acceuil.php"); 
header('Content-Type: application/json; charset=utf-8');

$future_event = recup_future_event();
$past_event = recup_past_event();

$table_future = [];
$table_past = [];


// Construction des lignes pour les événements à venir
if (count($future_event) != 0) {
    foreach ($future_event as $value1) {
        $titre = htmlspecialchars($value1['titre']);
        $id_event = urlencode($value1['id_event']);
        $description = htmlspecialchars($value1['description']);
        $flyer = htmlspecialchars($value1['flyer']);
        $date = htmlspecialchars($value1['date']);
        $date_formatee = date("d/m/y", strtotime($date));
        $lien_billet = htmlspecialchars($value1['billetrie']);
        $table_future[] = 
        '<div class="slide active">' .
        '<img src="' . $flyer. '" alt="Evenement ' . $id_event . '">' .
        '<div class="slide-caption">' .
            '<h2>' . $titre . ' le ' . $date_formatee . '</h2>' .
            '<a href="' . $lien_billet . '" class="btn-ticket"> Acheter mon ticket </a>' .
        '</div>' .
    '</div>';
    }
} 
if(count($past_event) != 0){
    foreach ($past_event as $value2) {
        $titre = htmlspecialchars($value2['titre']);
        $id_event = urlencode($value2['id_event']);
        $description = htmlspecialchars($value2['description']);
        $date = htmlspecialchars($value2['date']);
        $date_formatee = date("d/m/y", strtotime($date));
        $flyer = htmlspecialchars($value2['flyer']);
        $table_past[] = 
        '<article class="event">
         <a href="../Vue/consultation_event.html?id_event=' . $id_event . '">
         <img src="' . $flyer . '" alt="Flyer Évènement ' . $id_event . '" />
         </a>
         <h3>' . $titre . ' le '.$date_formatee.'</h3>
        </article>';
    }
}

// Encodage JSON final
echo json_encode([
    "table_future" => $table_future , "table_past" =>$table_past
]);
