document.addEventListener("DOMContentLoaded", () => {

  const tablePastBody = document.querySelector('#table-past-event tbody');
  const tableFutureBody = document.querySelector('#table-future-event tbody');

  // Fonction pour charger les données via AJAX/fetch
  function recup_data() {
    fetch('../Controlleur/acceuil_admin.php')
      .then(response => {
        if (!response.ok) throw new Error('Erreur réseau');
        return response.json();
      })
      .then(data => {
        console.log('Données JSON reçues :', data);

        // data.table_past et data.table_future doivent être des arrays de chaînes HTML <tr>...</tr>
        if (Array.isArray(data.table_past)) {
          tablePastBody.innerHTML = data.table_past.join('');
        } else {
          tablePastBody.innerHTML = '<tr><td>Aucun événement passé</td></tr>';
        }

        if (Array.isArray(data.table_future)) {
          tableFutureBody.innerHTML = data.table_future.join('');
        } else {
          tableFutureBody.innerHTML = '<tr><td colspan="2">Aucun événement à venir</td></tr>';
        }
      })
      .catch(error => {
        console.error('Erreur lors de la récupération des données :', error);
        tablePastBody.innerHTML = '<tr><td>Erreur lors du chargement des événements passés</td></tr>';
        tableFutureBody.innerHTML = '<tr><td colspan="2">Erreur lors du chargement des événements à venir</td></tr>';
      });
  }

recup_data();
document.getElementById('add-btn-past').addEventListener('click', () => {
    window.location.href = 'ajout_past_event.html';
  });

document.getElementById('future-event').addEventListener('click', () => {
    window.location.href = 'ajout_ev_a_venir.html';
  });

});
