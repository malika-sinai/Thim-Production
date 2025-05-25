document.addEventListener("DOMContentLoaded", function () {
    var inputPassword = document.getElementById('password');
    var inputEmail = document.getElementById('email');
    var feedback = document.getElementById('message');
    function traitement_connexion() {
        var errors = false; 
        // Vérification des champs vides
        if (
            inputEmail.value === "" ||
            inputPassword.value === "" 
        ) {
            errors = true;
            feedback.querySelector("p").innerText = "Remplissez tous les champs";
            feedback.style.display = "block";
            feedback.style.color = "red";

        if (inputEmail.value === "") inputEmail.classList.add("input-error");
        if (inputPassword.value === "") inputPassword.classList.add("input-error");
            setTimeout(() => {
                feedback.style.display = "none";
                inputEmail.classList.remove("input-error");
                inputPassword.classList.remove("input-error");
            }, 3000);
        }
        // Si des erreurs sont détectées, empêcher l'envoi du formulaire
        if (errors) {
            return; // Empêche le formulaire de se soumettre
        }
        
    //envoie des données via AJAX
    var user = {"email": inputEmail.value,"mot_de_passe": inputPassword.value };
    console.log(user);
    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../Controlleur/connection.php",
        data:{
            "email": user.email,
            "mot_de_passe": user.mot_de_passe
        }
    }).done(function(reponse){
        //console.log(reponse);
        console.log(reponse.message);
        if(reponse.message == "success"){
            window.location.href = "acceuil_admin.php";
        }else{
        feedback.querySelector("p").innerText = reponse.message;
        feedback.style.display="block";
        feedback.style.color = "red";
        setTimeout(() =>(
            feedback.style.display = "none"
        ),4000);
        return
        }
    }).fail(function(xhr, status, error) {
            console.log("Erreur AJAX : ", error); // Si une erreur se produit
        });

    }

    // Ajout d'un événement sur le bouton d'connexion
    var inscrire = document.getElementById("se_connecter");
    inscrire.addEventListener('click', traitement_connexion);
});
