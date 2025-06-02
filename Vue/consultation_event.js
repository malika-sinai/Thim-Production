function toggleMenu() {
  document.querySelector('nav ul').classList.toggle('active');
}

document.addEventListener("DOMContentLoaded", () => {
  function recup_data() {
  //Récupérer l'id dans l'URL
  const params = new URLSearchParams(window.location.search);
  const id_event = params.get("id_event");
  if (!id_event) {
    console.error("Aucun id_event dans l'URL !");
    return;
  }
  //  Envoyer l'ID via POST à consultation_event.php
  fetch('../Controlleur/consultation_event.php', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({ id_event: id_event })
}).then(response => {
      if (!response.ok) throw new Error('Erreur réseau');
      return response.json();
    }).then(data => {
      console.log('Données JSON reçues :', data);
      if (Array.isArray(data.table_event)) {
        const event = document.getElementById('event'); // Assure-toi que cet élément existe
        event.innerHTML = data.table_event.join('');
        event.querySelectorAll('.fade-in-scroll').forEach(el => el.classList.add('visible'));
      }
    }).catch(error => {
      console.error('Erreur lors de la récupération des données :', error);
    });
}
recup_data();
});

