<header>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header"><!-- Logo du jeu + menu hamburger -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="#" class="navbar-brand">Logo</a>
      </div>
      <div><!-- Menu Principal quand c'est trop petit on a un menu déroulant -->
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="#presentationGenerale">Aperçu</a></li>
            <li><a href="#presentation">Le jeu</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#inscription">Inscription</a></li>
            <li class="dropdown" id="menuLogin">
              <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">Connexion</a>
              <div class="dropdown-menu" style="padding:17px;"><!-- Menu de connexion qui apparaît quand on clique sur connexion -->
                <form class="navbar-form" id="formLogin" method="post">
                  <div class="form-group">
                    <input class="form-control" name="username" id="username" placeholder="Identifiant" type="text">
                  </div>
                  <div class="form-group">
                    <input class="form-control" name="password" id="password" placeholder="Mot de passe" type="password">
                  </div>
                  <div class="form-group">
                    <label><input type="checkbox"> Se souvenir de moi</label>
                    <span class="error" id="err-connexion"></span>
                  </div>
                  <button type="button" id="btnLogin" class="btn">Connexion</button>
                </form>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>
