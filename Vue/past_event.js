function toggleMenu() {
      document.querySelector('nav ul').classList.toggle('active');
}

document.addEventListener("DOMContentLoaded", function () {
    var inputTitre = document.getElementById('titre');
    var inputDescription = document.getElementById('description');
    var inputAdresse = document.getElementById('adresse');
    var inputHeure = document.getElementById('heure');
    var inputDate= document.getElementById('date');
    var inputFlyer = document.querySelector('#flyer');
    var inputImage = document.querySelector('#image');
    var feedback = document.getElementById('message');

function traitement_ajout() {
    var errors = false; 
    // Vérification des champs vides
    if (
        inputTitre.value === "" ||
        inputDescription.value === "" ||
        inputAdresse.value === "" ||
        inputHeure.value === "" ||
        inputDate.value === "" ||
        inputFlyer.files.length === 0 ||
        inputImage.files.length === 0
    ) {
        errors = true;
        feedback.querySelector("p").innerText = "Remplissez tous les champs";
        feedback.style.display = "block";
        feedback.style.color = "red";

        if (inputTitre.value === "") inputTitre.classList.add("input-error");
        if (inputDescription.value === "") inputDescription.classList.add("input-error");
        if (inputAdresse.value === "") inputAdresse.classList.add("input-error");
        if (inputHeure.value === "") inputHeure.classList.add("input-error");
        if (inputDate.value === "") inputDate.classList.add("input-error");
        if (inputFlyer.files.length === 0) inputFlyer.classList.add("input-error");
        if (inputImage.files.length === 0) inputImage.classList.add("input-error");
        setTimeout(() => {
            feedback.style.display = "none";
            inputTitre.classList.remove("input-error");
            inputDescription.classList.remove("input-error");
            inputAdresse.classList.remove("input-error");
            inputHeure.classList.remove("input-error");
            inputDate.classList.remove("input-error");
            inputFlyer.classList.remove("input-error");
            inputImage.classList.remove("input-error");
        }, 3000);
    }

    if (errors) {
        return; // Empêche l'envoi si erreur
    }

    // Préparation FormData
    var formData = new FormData();
    formData.append("titre", inputTitre.value);
    formData.append("description", inputDescription.value);
    formData.append("adresse", inputAdresse.value);
    formData.append("heure", inputHeure.value);
    formData.append("date", inputDate.value);
    formData.append("flyer", inputFlyer.files[0]); 
    for (let i = 0; i < inputImage.files.length; i++) {
    formData.append("image[]", inputImage.files[i]);
}

    // Envoi AJAX avec FormData
    $.ajax({
        method: "POST",
        url: "../Controlleur/past_event_controlleur.php",
        data: formData,
        processData: false,  // IMPORTANT : pour que jQuery ne transforme pas les données en string
        contentType: false,  // IMPORTANT : pour que jQuery ne mette pas Content-Type (le laisse gérer par le navigateur)
        dataType: "json",
    }).done(function(reponse) {
        console.log(reponse.message);
        //console.log(reponse.nom_fichier);
        console.log(reponse.id_event);
        if (reponse.message === "success") {
            window.location.href = "acceuil_admin.php";
        } else {
            feedback.querySelector("p").innerText = reponse.message;
            feedback.style.display = "block";
            feedback.style.color = "red";
            setTimeout(() => {
                feedback.style.display = "none";
            }, 4000);
        }
    }).fail(function(xhr, status, error) {
        console.log("Erreur AJAX : ", error); 
    });
}
 // Ajout d'un événement sur le bouton d'connexion
    var inscrire = document.getElementById("ajout");
    inscrire.addEventListener('click', traitement_ajout);
});
