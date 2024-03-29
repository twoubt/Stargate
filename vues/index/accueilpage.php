<div class="site-content">
    <div id="accueil1"><!-- Menu qui affiche des images du jeu (pas encore faisable) -->
    </div>
  <div id="presentationGenerale"><!-- Info principale du jeu -->
    <div id="infos">
      <h2 class="text-center">Qu'est-ce que Stargate Project ?</h2>
      <h3 class="text-center">Un jeu de stratégie basé sur l'univers de ogame et de Stargate.</h3>
      <p class="text-center">C'est un jeu de stratégie qui prend place dans l'espace. Vous commencez sur une planète sans infrastructures,
       vous développez vos mines, créez vos vaisseaux de combat et partez conquérir d'autre planètes seul ou avec vos amis !</p>
    </div>
  </div>
  <div id="presentation"><!-- Info essentielles du jeu à compléter -->
    <h2 class="text-center">Découvrez toutes les fonctionnalités de ce jeu innovant ;)</h2>
    <div class="presentationElement">
      <div id="menuPresentation" class="panel-group">
          <div class="panel panel-default row">
            <div class="panel-heading">
              <a data-toggle="collapse" href="#infoPlanete" data-parent="#menuPresentation">Développez votre planète</a>
            </div>
            <div id="infoPlanete" class="panel-collapse collapse">
              <img src="img/planete_accueil.jpg" class="img-rounded img-center" alt="une planète">
              <ul class="col-md-12">
                <li class="list-group-item"><p>Améliorez vos mines pour produire plus de ressources.</p></li>
                <li class="list-group-item"><p>Construisez des usines et des laboratoires pour améliorer votre technologie.</p></li>
                <li class="list-group-item"><p>Construisez des vaisseaux pour renforcer votre armada.</p></li>
                <li class="list-group-item"><p>Envoyez vos vaisseaux piller des ressources au quatre coins de la galaxie.</p></li>
                <li class="list-group-item"><p>Partez à la conquète de planètes riches en matières première.</p></li>
              </ul>
            </div>
          </div>
          <div class="panel panel-default row">
            <div class="panel-heading">
              <a data-toggle="collapse" href="#infoVaisseau" data-parent="#menuPresentation">Créez votre vaisseau personnalisé</a>
            </div>
            <div id="infoVaisseau" class="panel-collapse collapse">
              <img src="img/vaisseau_accueil.jpg" class="img-rounded img-center" alt="Un vaisseau trop swag">
              <ul class="col-md-12">
                <li class="list-group-item"><p>Envoyez votre vaisseau mère dans des aventures pour obtenir toutes sortes de butins.</p></li>
                <li class="list-group-item"><p>À chaque niveau améliorez ses caractéristiques pour qu'il devienne encore plus puissant.</p></li>
                <li class="list-group-item"><p>Attaquez d'autre joueur avec votre vaisseau mère pour décupler la puissance de votre flotte.</p></li>
              </ul>
            </div>
          </div>
          <div class="panel panel-default row">
            <div class="panel-heading">
              <a data-toggle="collapse" href="#infoObjectif" data-parent="#menuPresentation">L'objectif qu'est-ce que c'est ?</a>
            </div>
            <div id="infoObjectif" class="panel-collapse collapse">

              <ul class="list-group">
                <li class="list-group-item"><p>Tu te développes à mort.</p></li>
                <li class="list-group-item"><p>Tu te fait une big armée.</p></li>
                <li class="list-group-item"><p>Tu casse la bouche à tout le monde.</p></li>
                <li class="list-group-item"><p>Et enfin tu construit le méga batiment avec la technologie ultra pété que t'as choisit.</p></li>
              </ul>
            </div>
          </div>
        </div>
    </div>
    </div>
<!-- div inscription -->
  <div class="row m-bottom-15">
    <div class="col-md-6 col-md-offset-3">
      <a href="#inscription" data-toggle="collapse">Inscription<a>
      <div id="inscription">
        <form id="formLogin" method="post">
            <input class="form-control" name="username" id="username" placeholder="Identifiant" type="text">
            <input class="form-control" name="password" id="password" placeholder="Mot de passe" type="password">
            <input class="form-control" name="email" id="email" placeholder="e-mail" type="text">
            <select class="form-control">
              <?php for($i = 0; $i < count($donnees['galaxies']); $i++) {
                echo "<option value='".($i+1)."'>".$donnees['galaxies'][$i]."</option>";
              } ?>
            </select>
            <button type="button" id="btnLogin" class="btn col-md-3 col-md-offset-9">Inscription</button>
        </form>
      </div>
    </div>
  </div>
</div>
