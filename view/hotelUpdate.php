<?php
if (!isset($hotel)){
  die();
}
?>
<div class="jumbotron">
    <h1 class="display-4">Formulaire de mise à jour d'hôtel !</h1>
    <p class="lead">Seules les informations générales sont modifiables.</p>
    <hr class="my-4">
    <form action="" method="POST">
        <div class="form-row">
          <div class="form-group col-md-6">
              <label for="name">Nom</label>
              <?php
                    echo "<input type='text' name ='name' class='form-control' id='name'  value='" . $hotel->getName() ."' required>";
                ?>
          </div>
          <div class="form-group col-md-6">
              <label for="city">Ville</label>
              <?php
                    echo "<input type='text' name ='city' class='form-control' id='city'  value='" .  $hotel->getCity() ."' required>";
                ?>
          </div>
          <div class="form-group col-md-6">
            <label for="zipcode">Code Postal</label>
            <?php
                    echo "<input type='text' name ='zipcode' class='form-control' id='zipcode'  value='" .  $hotel->getZipcode() ."' required>";
                ?>
          </div>
          <div class="form-group col-md-6">
            <label for="street">Rue</label>
            <?php
                    echo "<input type='text' name ='street' class='form-control' id='street'  value='" .  $hotel->getStreet() ."' required>";
                ?>
          </div>
          <div class="form-group col-md-6">
            <label for="streetnumber">Numéro dans la rue</label>
            <?php
                    echo "<input type='text' name ='streetnumber' class='form-control' id='streetnumber'  value='" .  $hotel->getStreetnumber() ."' required>";
                ?>
          </div>
          <div class="form-group col-md-6">
            <label for="description">Description</label>
            <?php
                    echo "<input type='text' name ='description' class='form-control' id='description'  value='" .  $hotel->getDescription() ."' required>";
                ?>
          </div>
          <div class="form-group col-md-6">
            <label for="manager">Email du manager</label>
            <?php
                    echo "<input type='text' name ='emailmanager' class='form-control' id='emailmanager'  value='" . $user->getEmail() ."' required>";
                ?>
          </div>
          
        </div>
        <?php
          echo "<input type='hidden' name ='idUpdate' id='idUpdate' value=' " .  $hotel->getId() . "'>";
          echo "<input type='hidden' name ='manager' id='manager' value=' " .  $hotel->getManager() . "'>";
        ?>
          <button type="submit" class="btn btn-primary" id="btnValid" >Modifier</button>
      </form>
      <form action="hotelDelete.php" method="POST">
        <?php
        echo "<input type='hidden' name ='hotelDelete' id='hotelDelete' value=' " .  $hotel->getId() . "'>";
        echo "<button type='submit' class='btn btn-primary' id='btnDelete' " . $disabled . " >Supprimer</button>";
        ?>
        
      </form>
      <form action="home.php" method="POST">
        <button type='submit' class='btn btn-primary' id='btnExit' >Sortir</button>
      </form>
  </div>
  <?php
    require_once '../html/footer.html';
  ?>