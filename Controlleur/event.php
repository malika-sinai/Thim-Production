<?php
require_once("../Modele/event.php"); 
header('Content-Type: application/json; charset=utf-8');

$event_future = recup_future_event();
$event_past = recup_past_event();

$table_event = [];
// Construction des lignes pour les événements 
if (count($event_future) != 0) {
    foreach ($event_future as $value1) {
        $titre = htmlspecialchars($value1['titre']);
        $id_event = urlencode($value1['id_event']);
        $description = htmlspecialchars($value1['description']);
        $flyer = htmlspecialchars($value1['flyer']);
        $date = htmlspecialchars($value1['date']);
        $date_formatee = date("d/m/y", strtotime($date));
        $lien_billet = htmlspecialchars($value1['billetrie']);
        $adresse = htmlspecialchars($value1['adresse']);
        $heure = htmlspecialchars($value1['heure']);
        $table_event[] = 
        '<div class="event-container">
         <div class="event-content">
            <div class="event-header">
                <div class="day">'.$date_formatee.'</div>
                <div class="date">'.$date_formatee.' '.$heure.'</div>
            </div>
            <div class="event-title">'.$titre.'</div>
            <div class="event-location">'.$adresse.'</div>
            <div class="event-highlight">'.$description.'</div>
            <div class="event-details">
                <p><strong>'.$titre.'</strong></p>
                <p>'.$description.'</p>
                <p> rendez-vous le '.$date_formatee.'</p>
            </div>
        </div>
        <div class="event-flyer">
            <a href="../Vue/consultation_event.html?id_event=' . $id_event . '">
            <img src="'.$flyer.'" alt="Flyer'.$id_event.'">
            </a>
        </div>
    </div>';

    }
} 
if (count($event_past) != 0) {
    foreach ($event_past as $value1) {
        $titre = htmlspecialchars($value1['titre']);
        $id_event = urlencode($value1['id_event']);
        $description = htmlspecialchars($value1['description']);
        $flyer = htmlspecialchars($value1['flyer']);
        $date = htmlspecialchars($value1['date']);
        $date_formatee = date("d/m/y", strtotime($date));
        $adresse = htmlspecialchars($value1['adresse']);
        $heure = htmlspecialchars($value1['heure']);
        $table_event[] = 
        '<div class="event-container">
        <div class="event-content">
            <div class="event-header">
                <div class="day">'.$date_formatee.'</div>
                <div class="date">'.$date_formatee.' '.$heure.'</div>
            </div>
            <div class="event-title">'.$titre.'</div>
            <div class="event-location">'.$adresse.'</div>
            <div class="event-highlight">'.$description.'</div>
            <div class="event-details">
                <p><strong>'.$titre.'</strong></p>
                <p>'.$description.'</p>
                <p> le '.$date_formatee.'</p>
            </div>
        </div>
        <div class="event-flyer">
            <a href="../Vue/consultation_event.html?id_event=' . $id_event . '">
            <img src="'.$flyer.'" alt="Flyer'.$id_event.'">
            </a>
        </div>
    </div>';
        
    }
} 

// Encodage JSON final
echo json_encode([
    "table_event" => $table_event
]);

?>