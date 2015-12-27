
<div class="site-content">
  <div class="container">
    <div id="accueil1"><!-- Menu qui affiche des images du jeu (pas encore faisable) -->
    </div>
  </div>
  <div class="container">
  <div id="presentationGenerale"><!-- Info principale du jeu -->
    <div id="infos">
      <h2 class="text-center">Qu'est-ce que Stargate Project ?</h2>
      <h3 class="text-center">Un jeu de stratégie basé sur l'univers de ogame et de Stargate.</h3>
      <p class="text-center">C'est un jeu de stratégie qui prend place dans l'espace. Vous commencez sur une planète sans infrastructures,
       vous développez vos mines, créez vos vaisseaux de combat et partez conquérir d'autre planètes seul ou avec vos amis !</p>
    </div>
  </div>
  </div>
  <div class="container">
  <div id="presentation"><!-- Info essentielles du jeu à compléter -->
    <h2 class="text-center">Découvrez toutes les fonctionnalités de ce jeu innovant ;)</h2>
    <div class="presentationElement">
      <div class="container">
      <div id="menuPresentation" class="panel-group">
          <div class="panel panel-default">
            <div class="panel-heading">
              <a data-toggle="collapse" href="#infoPlanete" data-parent="#menuPresentation">Développez votre planète</a>
            </div>
            <div id="infoPlanete" class="panel-collapse collapse">
              <img src="" class="img-rounded" alt="une planète">
              <ul class="list-group">
                <li class="list-group-item"><p>Améliorez vos mines pour produire plus de ressources.</p></li>
                <li class="list-group-item"><p>Construisez des usines et des laboratoires pour améliorer votre technologie.</p></li>
                <li class="list-group-item"><p>Construisez des vaisseaux pour renforcer votre armada.</p></li>
                <li class="list-group-item"><p>Envoyez vos vaisseaux piller des ressources au quatre coins de la galaxie.</p></li>
                <li class="list-group-item"><p>Partez à la conquète de planètes riches en matières première.</p></li>
              </ul>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <a data-toggle="collapse" href="#infoVaisseau" data-parent="#menuPresentation">Créez votre vaisseau personnalisé</a>
            </div>
            <div id="infoVaisseau" class="panel-collapse collapse">
              <img src="" class="img-rounded" alt="Un vaisseau trop swag">
              <ul class="list-group">
                <li class="list-group-item"><p>Envoyez votre vaisseau mère dans des aventures pour obtenir toutes sortes de butins.</p></li>
                <li class="list-group-item"><p>À chaque niveau améliorez ses caractéristiques pour qu'il devienne encore plus puissant.</p></li>
                <li class="list-group-item"><p>Attaquez d'autre joueur avec votre vaisseau mère pour décupler la puissance de votre flotte.</p></li>
              </ul>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <a data-toggle="collapse" href="#infoObjectif" data-parent="#menuPresentation">L'objectif qu'est-ce que c'est ?</a>
            </div>
            <div id="infoObjectif" class="panel-collapse collapse">

              <ul class="list-group">
                <li class="list-group-item"><p>Te te développe à mort.</p></li>
                <li class="list-group-item"><p>Tu te fait une big armée.</p></li>
                <li class="list-group-item"><p>Tu casse la bouche à tout le monde.</p></li>
                <li class="list-group-item"><p>Et enfin tu construit le méga batiment avec la technologie ultra pété que t'as choisit.</p></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
  <div class="container"><!-- div inscription -->
    <div>
      <a href="#inscription" data-toggle="collapse">Inscription<a>
    </div>
    <div id="inscription">

      <form class="navbar-form" id="formLogin" method="post">
        <div class="form-group">
          <input class="form-control" name="username" id="username" placeholder="Identifiant" type="text">
        </div>
        <div class="form-group">
          <input class="form-control" name="password" id="password" placeholder="Mot de passe" type="password">
        </div>
        <div class="form-group">
          <input class="form-control" name="email" id="email" placeholder="e-mail" type="text">
        </div>
        <select>
          <?php for($i = 0; $i < count($donnees['galaxies']); $i++) {
            echo "<option value='".($i+1)."'>".$donnees['galaxies'][$i]."</option>";
          } ?>
        </select>
        <button type="button" id="btnLogin" class="btn">Inscription2</button>
      </form>
    </div>
  </div>
</div>
