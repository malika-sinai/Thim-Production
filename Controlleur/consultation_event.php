<?php
require_once("../Modele/consultation_event.php");
header('Content-Type: application/json; charset=utf-8');

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$id_event = isset($data['id_event']) ? $data['id_event'] : null;

$resultat = recup_event($id_event);
$photos   = recup_photos($id_event);   // doit renvoyer [] s’il n’y a pas de photos
$table_event = [];

if ($resultat && is_array($resultat)) {
    $titre            = htmlspecialchars($resultat['titre']);
    $id_event_encoded = urlencode($resultat['id_event']);
    $description      = htmlspecialchars($resultat['description']);
    $flyer            = htmlspecialchars($resultat['flyer']);
    $date             = htmlspecialchars($resultat['date']);
    $date_formatee    = date("d/m/y", strtotime($date));
    $heure            = htmlspecialchars($resultat['heure']);
    $adresse          = htmlspecialchars($resultat['adresse']);
    $lien_billet      = !empty($resultat['billetrie']) ? htmlspecialchars($resultat['billetrie']) : null;

    /* -------- bloc principal -------- */
    $event_html = '
    <div class="event-container">
        <div class="flyer-section fade-in-scroll">
            <img src="'.$flyer.'" alt="Flyer evenement '.$id_event_encoded.'">
            <div class="info-block">
                <div class="info-item"><span class="info-label">Date :</span> '.$date_formatee.'</div>
                <div class="info-item"><span class="info-label">Heure :</span> '.$heure.'</div>
                <div class="info-item" style="margin-top:1rem;"><span class="info-label">Lieu :</span> PARIS</div>
                <div class="info-item"><span class="info-label">Adresse :</span> '.$adresse.'</div>
            </div>
        </div>

        <div class="event-details fade-in-scroll">
            <div class="header-artist">
                <img src="../src/logo_TM.jpeg" alt="Logo entreprise" class="company-logo">
                <h2 class="artist-name">'.$titre.'</h2>
            </div>
            <p class="event-description">'.$description.'</p>';

    /* bouton billetterie s’il existe */
    if ($lien_billet) {
        $event_html .= '<a href="'.$lien_billet.'" class="buy-button">Acheter mon ticket</a>';
    }

    $event_html .= '
        </div>
    </div>';   // <- fin event-container

    /* -------- galerie photos UNIQUEMENT si pas de billetterie -------- */
    if (!$lien_billet && !empty($photos)) {
        $event_html .= '
    <section class="event-photos-section fade-in-scroll">
        <h3 class="section-title">LES MOMENTS CLÉS</h3>
        <div class="photos-gallery">';
        foreach ($photos as $value) {
            $chemin = htmlspecialchars($value["chemin"]);
            $alt    = "Moment clé ".htmlspecialchars($value["id_photo"]);
            $event_html .= '<img src="'.$chemin.'" alt="'.$alt.'" class="photo-item">';
        }
        $event_html .= '
        </div>
    </section>';
    }

    $table_event[] = $event_html;
}

echo json_encode([
    "table_event" => $table_event
]);
