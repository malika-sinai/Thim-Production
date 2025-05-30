// Sélection des boutons
const nextBtn = document.querySelector('.nav.next');
const prevBtn = document.querySelector('.nav.prev');

// Gestion du menu burger
function toggleMenu() {
  document.querySelector('nav ul').classList.toggle('active');
}

// Slider
let index = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;

function updateSlidePosition() {
  const slidesContainer = document.querySelector('.slides');
  slidesContainer.style.transform = `translateX(-${index * 100}%)`;
}

function showNextSlide() {
  index = (index + 1) % totalSlides;
  updateSlidePosition();
}

function showPrevSlide() {
  index = (index - 1 + totalSlides) % totalSlides;
  updateSlidePosition();
}

nextBtn.addEventListener('click', showNextSlide);
prevBtn.addEventListener('click', showPrevSlide);

// Auto défilement toutes les 3 secondes
setInterval(showNextSlide, 3000);

// Animation au scroll
function isInViewport(element) {
  const rect = element.getBoundingClientRect();
  return rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.9;
}

function handleScrollAnimation() {
  const events = document.querySelectorAll('.event');
  events.forEach(event => {
    if (isInViewport(event)) {
      event.classList.add('visible');
    }
  });
}

window.addEventListener('scroll', handleScrollAnimation);
window.addEventListener('load', handleScrollAnimation);

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
    window.location.href = '../Vue/ajout_past_event.html';
  });

document.getElementById('add-btn-future').addEventListener('click', () => {
    window.location.href = '../Vue/ajout_ev_a_venir.html';
  });

});
