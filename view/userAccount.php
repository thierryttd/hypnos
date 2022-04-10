<?php
if (!isset($user)){
  die();
}
?>
<div class="jumbotron">
  <h1 class="display-4">Gérer votre compte !</h1>
  <p class="lead">Vous pouvez modifier vos informations personnelles.</p>
  <hr class="my-4">
  <form action="" method="POST">
    <div class="form-row">
      <div class="form-group col-md-6">
          <label for="name">Nom</label>
          <?php
              echo "<input type='text' name ='name' class='form-control' id='name'  value='" . $user->getName()."' required>";
          ?>
      </div>
      <div class="form-group col-md-6">
        <label for="name">Prénom</label>
        <?php
              echo "<input type='text' name ='firstname' class='form-control' id='firstname'  value='" . $user->getFirstname() ."' required>";
        ?>
      </div>
      <div class="form-group col-md-6">
        <label for="email">Email</label>
        <?php
              echo "<input type='email' name ='email' class='form-control' id='email'  value='" . $user->getEmail() ."' required>";
        ?>
      </div>
      
    </div>
    <input type="hidden" name ="from" id="from" value="userAccount.php">  
    <?php
    echo "<input type='hidden' name='role' id='role'  value='" . $user->getRole() ."' >";
    ?>
    <button type="submit" class="btn btn-primary" id="btnValid">Valider</button>
  </form>
  <form action="userChangePw.php" method="POST" id='formChangePw'>
      <button  class="btn btn-primary" id="btnPw">Changer mon mot de passe</button>
  </form>
  <form action="home.php" method="POST">
      <button type="submit" class="btn btn-primary" id="btnExit">Sortir</button>
  </form>
  
</div>
<?php
  require_once '../html/footer.html';
?>