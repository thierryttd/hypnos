<?php
if (!isset($suite)){
  die();
}
?>
<div class="jumbotron">
  <h1 class="display-4">Formulaire de modification de suite !</h1>
  <p class="lead"></p>
  <hr class="my-4">
  <form action="" method="POST">
    <div class="form-row">
      <div class="form-group col-md-6">
          <label for="name">Titre</label>
          <?php
          echo "<input type='text' name ='title' class='form-control' id='title' value='" . $suite->getTitle() . "' required>";
          ?>
      </div>
      <div class="form-group col-md-6">
        <label for="description">Description</label>
        <?php
        echo "<input type='text' name ='description' class='form-control' id='description' value='" . $suite->getDescription() . "' required>";
        ?>
      </div>
      <div class="form-group col-md-6">
        <label for="linkbooking">Lien booking</label>
        <?php
        echo "<input type='text' name='linkbooking' class='form-control' id='linkbooking' value='" . $suite->getLinkbooking() . "' required>";
        ?>
      </div>
      <div class="form-group col-md-6">
        <label for="fadeprice">Prix nuité</label>
        <input type="number" name="fadeprice" class="form-control" id="fadeprice" value="500" disabled>
        <input type="hidden" name="price" class="form-control" id="price" value="500">
      </div>
      <div class="form-group col-md-6">
        <label for="hotel">Hotel</label>
        <?php
          echo "<input type='hidden' name ='hotel' class='form-control' id='hotel'  value='" . $suite->getHotel() . "'>";
          echo "<input type='text' name ='fadehotel' class='form-control' id='fadehotel'  value='" . $suite->getHotel() . "' disabled>";
        ?>
      </div>
      <div class="form-group col-md-6">
          <label for="featured">Image promo</label>
          <?php
          echo "<input type='text' name ='fadefeatured' class='form-control' id='fadefeatured' value='" . $suite->getFeatured() . "' disabled>";
          echo "<input type='hidden' name ='featured' class='form-control' id='featured' value='" . $suite->getFeatured() . " '>";
          echo "<img src='" . $suite->getFeatured() . "' class='mr-3 img-fluid' width='100' height='100' ";
          ?>
      </div>
      
    </div>
    <input type="hidden" name ="from" id="from" value="suiteUpdate.php">
    <?php
    echo "<input type='hidden' name ='suite' class='form-control' id='suite' value='" . $suite->getId() . " '>";
    ?>
    <button type="submit" class="btn btn-primary" id="btnValid">Modifier</button>
  </form>
  <?php
  echo "<form action='suiteDelete.php' method='POST'>";
    echo "<input type='hidden' name ='suiteDelete' class='form-control' id='suiteDelete' value='" . $suite->getId() . " '>";
    echo "<button type='submit' class='btn btn-primary' id='btnDelete'>Supprimer</button>";
  echo "</form>";
  echo "<form action='hotelDisplay.php' method='POST'>";
    echo "<input type='hidden' name ='hotel' id='hotel' value='" . $suite->getHotel() . " '>";
    echo "<button type='submit' class='btn btn-primary' id='btnSortir'>Sortir</button>";
  echo "</form>";
echo "</div>";
