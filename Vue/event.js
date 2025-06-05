function toggleMenu() {
  document.querySelector('nav ul').classList.toggle('active');
}

document.addEventListener("DOMContentLoaded", () => {
  const event = document.querySelector('.events-container');

  function observerEvents() {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, { threshold: 0.1 });

    // Observer les nouveaux éléments injectés
    document.querySelectorAll('.event-container').forEach(container => {
      observer.observe(container);
    });
  }

  function recup_data() {
    fetch('../Controlleur/event.php')
      .then(response => {
        if (!response.ok) throw new Error('Erreur réseau');
        return response.json();
      })
      .then(data => {
        console.log('Données JSON reçues :', data);

        if (Array.isArray(data.table_event)) {
          event.innerHTML = data.table_event.join('');
          observerEvents(); // ✅ Appelé après l’injection HTML
        } 
      })
      .catch(error => {
        console.error('Erreur lors de la récupération des données :', error);
      });
  }

  recup_data();
});
