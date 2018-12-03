<?php
function includeFiles(){
  ?>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/Model.css">
  <link rel="stylesheet" href="../css/Sidenav.css">
  <script src="../js/jqeury-3.3.1.slim.min.js"></script>
  <script src="../js/jqeury.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <?php
}

/* Modal login Content
Dit is de login modal pagina
*/
function ModalLogin () {
  ?>
  <div id="login" class="modal">
      <span onclick="document.getElementById('login').style.display = 'none'" class="close-model" title="Close Modal login">&times;</span>
    <form class="modal-border modal-content animate" action="/action_page.php">
        <div class="imgcontainer">
            <img src="../IMG/avatar.png" alt="Avatar" class="avatar">
        </div>

        <div class="container-login">
            <label for="uname"><b>Gebruikersnaam</b></label>
            <input class="login" type="text" placeholder="Gebruikersnaam of Email" name="uname" required>

            <label for="psw"><b>Wachtwoord</b></label>
            <input class="login" type="password" placeholder="Wachtwoord" name="psw" required>

            <button class="btn btn-success loginbtn" type="submit">Inloggen</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Onthouden
            </label>
        </div>

        <div class="container-login" style="background-color:#f1f1f1">
            <button type="button" class="btn btn-danger" onclick="document.getElementById('login').style.display = 'none'">Annuleren</button>
            <span class="psw"><a href="#">Wachtwoord vergeten?</a></span>
        </div>
    </form>
</div>
<?php
}

/* Modal signup Content
Dit is de registratie modal pagina
*/
function ModalSignup() {
  ?>
  <div id="signup" class="modal">
      <span onclick="document.getElementById('signup').style.display = 'none'" class="close-model" title="Close Modal signup">&times;</span>

           <form class="modal-content model-border animate form-horizontal" method="get" action="#">
          <div class="container-login">
              <h1>Registeren</h1>
              <p>Please fill in this form to create an account.</p>
              <hr>
              <div class="form-group">
                <label for="gebruikersnaam"><b>Gebruikersnaam</b></label>
                <input class="form-control" type="text" id="gebruikersnaam" placeholder="Gebruikersnaam  *" name="gebruikersnaam" required>
              </div>
              <div class="form-group">
                <label for="email"><b>Email</b></label>
                <input class="form-control" type="email" id="email" placeholder="Email *" name="email" required>
              </div>
              <div class="form-group">
                <label for="wachtwoord"><b>Wachtwoord</b></label>
                <input class="form-control" type="password" id="Wachtwoord" placeholder="Wachtwoord  *" name="wachtwoord" required>
              </div>
              <div class="form-group">
                <label for="wachtwoord-repeat"><b>Herhaal Wachtwoord</b></label>
                <input class="form-control" type="password" id="herhaal-Wachtwoord" placeholder="Herhaal Wachtwoord *" name="Wachtwoord-repeat" required>
              </div>
              <label for="Naam"><b>Naam</b></label>
              <div class="form-row">
                <div class="form-group col-md-8">
                  <input type="text" class="form-control" id="voornaam" name="voornaam" placeholder="Voornaam *" required>
                </div>
                <div class="form-group col-md-4">
                  <input type="text" class="form-control" id="tussenvoegsel" name="tussenvoegsel" placeholder="Tussenvoegsel">
                </div>
              </div>
              <div class="form-group">
                  <input type="text" class="form-control" id="achternaam" name="achternaam" placeholder="Achternaam *" required>
              </div>
              <div class="form-group">
                <label for="telefoonnr"><b>Telefoon nummer:</b></label>
                <input type="tel" class="form-control" id="telefoonnr" name="telefoonnr" placeholder="Telefoon nummer">
              </div>
              <div>
                <label><b>Adress:</b></strong></label>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postcode *" required>
                </div>
                <div class="form-group col-md-3">
                  <input type="text" class="form-control" id="huisnummer" name="huisnummer" placeholder="Huisnummer *" required>
                </div>
                <div class="form-group col-md-3">
                  <input type="text" class="form-control" id="toevoeging" name="toevoeging" placeholder="Toevoeging">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="adres" name="adres" placeholder="Adres *" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="plaats" name="plaats" placeholder="Plaats *" required>
                </div>
              </div>
              <label>
                  <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Onthouden
              </label>

              <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

              <div class="btn-group">
                  <button class="btn btn-danger" type="button" onclick="document.getElementById('signup').style.display = 'none'">Annuleren</button>
                  <button class="btn btn-success" type="submit">Registreren</button>
              </div>
          </div>
      </form>
  </div>
  <?php
}

/* Layout voor de footer */
function Footer() {
  ?>
  <footer class="text-light bg-dark">
      <div class="container">
          <div class="row">
              <div class="col-md-3 col-lg-4 col-xl-3">
                  <h5>Info</h5>
                  <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                  <p class="mb-0">
                      Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression.
                  </p>
              </div>

              <div class="col-md-2 col-lg-2 col-xl-2 mx-auto">
                  <h5>Informations</h5>
                  <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                  <ul class="list-unstyled">
                      <li><a href="">Link 1</a></li>
                      <li><a href="">Link 2</a></li>
                      <li><a href="">Link 3</a></li>
                      <li><a href="">Link 4</a></li>
                  </ul>
              </div>

              <div class="col-md-3 col-lg-2 col-xl-2 mx-auto">
                  <h5>Others links</h5>
                  <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                  <ul class="list-unstyled">
                      <li><a href="">Link 1</a></li>
                      <li><a href="">Link 2</a></li>
                      <li><a href="">Link 3</a></li>
                      <li><a href="">Link 4</a></li>
                  </ul>
              </div>

              <div class="col-md-4 col-lg-3 col-xl-3">
                  <h5>Contact</h5>
                  <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                  <ul class="list-unstyled">
                      <li><i class="fa fa-home mr-2"></i> Wide World Importers</li>
                      <li><i class="fa fa-envelope mr-2"></i> email@wideworldimporters.com</li>
                      <li><i class="fa fa-phone mr-2"></i> + 33 12 14 15 16</li>
                      <li><i class="fa fa-print mr-2"></i> + 33 12 14 15 16</li>
                  </ul>
              </div>
          </div>
      </div>
  </footer>
  <?php
}
