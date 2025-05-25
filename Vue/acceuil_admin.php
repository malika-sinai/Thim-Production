<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin - Accueil</title>
  <link rel="stylesheet" href="acceuil_admin.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- optionnel -->
</head>
<body>

  <!-- Header copié depuis acceuil.html -->
  <header>
    <img src="../src/logo_TM.jpeg" alt="Logo de Thim Production" class="logo" />
    <div class="burger" onclick="toggleMenu()">
      <div></div>
      <div></div>
      <div></div>
    </div>
    <nav>
      <ul>
        <li><a href="acceuil.html">Accueil</a></li>
        <li><a href="description.html">À propos</a></li>
        <li><a href="past_event.html">Evènement passé</a></li>
        <li><a href="location_sono.html">Location sono</a></li>
        <li><a href="contact.html">Nous contacter</a></li>
      </ul>
    </nav>
  </header>

  <!-- Contenu principal de la page admin -->
  <main class="admin-content">
    <h1 class="welcome">Bienvenue !</h1>

    <section class="table-section" id="past-event">
      <h2>Événements passés</h2>
      <table id="table-past-event">
        <thead>
          <tr><th>Titre</th></tr>
        </thead>
        <tbody>
          <!-- Les événements passés seront insérés ici -->
          <tr><td>Concert de 2022 (exemple statique)</td></tr>
        </tbody>
      </table>
      <button type="button" class="add-btn" id="add-btn-past">Ajouter un événement passé</button>
    </section>

    <section class="table-section" id="future-event">
      <h2>Événements à venir</h2>
      <table id="table-future-event">
        <thead>
          <tr><th>Titre</th><th>Action</th></tr>
        </thead>
        <tbody>
          <!-- Les événements à venir seront insérés ici -->
          <tr>
            <td>Festival Urbain 2025 (exemple statique)</td>
            <td><button class="delete-btn">Supprimer</button></td>
          </tr>
        </tbody>
      </table>
      <button type="button" class="add-btn" id="add-btn-future">Ajouter un événement à venir</button>
    </section>
  </main>

  <!-- Footer copié depuis acceuil.html -->
  <footer>
    <div class="contact-info">
      📍 Paris, France <br>
      📞 +33 6 79 68 38 63 <br>
      ✉️ contact@monsite.ci
    </div>
  </footer>

  <script>
    function toggleMenu() {
      document.querySelector('nav ul').classList.toggle('active');
    }
  </script>
  <script src="acceuil_admin.js"></script>
</body>
</html>
