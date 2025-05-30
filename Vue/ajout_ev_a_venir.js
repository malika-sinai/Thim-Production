function toggleMenu() {
      document.querySelector('nav ul').classList.toggle('active');
}


document.addEventListener("DOMContentLoaded", function () {
    var inputTitre = document.getElementById('titre');
    var inputDescription = document.getElementById('description');
    var inputDate = document.getElementById('date');
    var inputLien = document.getElementById('lien');
    var inputFile = document.querySelector('input[type="file"]');
    var feedback = document.getElementById('message');
function traitement_ajout() {
    var errors = false; 
    // Vérification des champs vides
    if (
        inputTitre.value === "" ||
        inputDescription.value === "" ||
        inputDate.value === "" ||
        inputLien.value === ""||
        inputFile.files.length === 0
    ) {
        errors = true;
        feedback.querySelector("p").innerText = "Remplissez tous les champs";
        feedback.style.display = "block";
        feedback.style.color = "red";

        if (inputTitre.value === "") inputTitre.classList.add("input-error");
        if (inputDescription.value === "") inputDescription.classList.add("input-error");
        if (inputDate.value === "") inputDate.classList.add("input-error");
        if (inputLien.value === "") inputLien.classList.add("input-error");
        if (inputFile.files.length === 0) inputFile.classList.add("input-error");
        setTimeout(() => {
            feedback.style.display = "none";
            inputTitre.classList.remove("input-error");
            inputDescription.classList.remove("input-error");
            inputDate.classList.remove("input-error");
            inputLien.classList.remove("input-error");
            inputFile.classList.remove("input-error");
        }, 3000);
    }

    if (errors) {
        return; // Empêche l'envoi si erreur
    }

    // Préparation FormData
    var formData = new FormData();
    formData.append("titre", inputTitre.value);
    formData.append("description", inputDescription.value);
    formData.append("date", inputDate.value);
    formData.append("lien", inputLien.value);
    formData.append("flyer", inputFile.files[0]); // fichier image

    // Envoi AJAX avec FormData
    $.ajax({
        method: "POST",
        url: "../Controlleur/controller_ajout_event_à_venir.php",
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
