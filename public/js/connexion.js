$(document).ready(function(){
    //Lorsqu'on clique sur connexion
    $('#btnLogin').click(function(){
        var valid = true;

        var user = $('#username').val();
        var pcw = $('#password').val();

        if(user == ""){
          valid = false;
        }else{
          if(pcw == ""){
            valid = false;
          }
        }

        if(valid){
          $.ajax({
            url: "ajax/connexion.php", //le script php qui va gérer la connexion
            method: "POST",
            data: {username:user,password:pcw},
            success:function(resultat){
              if(resultat){
                //On redirige vers la page de jeu
              }
            }
          });
        }else{
          $('#err-connexion').text("Mauvaise combinaison pseudo/mot de passe")
        }
    });
});
