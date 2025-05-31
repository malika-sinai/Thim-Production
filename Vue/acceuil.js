// Gestion du menu burger
function toggleMenu() {
  document.querySelector('nav ul').classList.toggle('active');
}

document.addEventListener("DOMContentLoaded", () => {
  const future_ev = document.querySelector('.slides');
  const past_ev = document.querySelector('.event-list')

  function recup_data() {
    fetch('../Controlleur/acceuil.php')
      .then(response => {
        if (!response.ok) throw new Error('Erreur réseau');
        return response.json();
      })
      .then(data => {
        console.log('Données JSON reçues :', data);

        if (Array.isArray(data.table_future)) {
          future_ev.innerHTML = data.table_future.join('');
          initSlider(); // Appeler ici une fois les slides ajoutées
        } 
        if (Array.isArray(data.table_past)) {
          past_ev.innerHTML = data.table_past.join('');
          handleScrollAnimation(); 
        }
        
      })
      .catch(error => {
        console.error('Erreur lors de la récupération des données :', error);
      });
  }

  recup_data();
});

function initSlider() {
  let index = 0;
  const slides = document.querySelectorAll('.slide');
  const totalSlides = slides.length;

  if (totalSlides === 0) return; // Rien à faire s’il n’y a aucune slide

  const slidesContainer = document.querySelector('.slides');
  const nextBtn = document.querySelector('.nav.next');
  const prevBtn = document.querySelector('.nav.prev');

  function updateSlidePosition() {
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

  // Démarre le défilement automatique
  setInterval(showNextSlide, 3000);
}

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
