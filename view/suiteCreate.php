<?php
if (!isset($hotel)){
  die();
}
?>
<div class="jumbotron">
    <h1 class="display-4">Formulaire de création de suite !</h1>
    <p class="lead"></p>
    <hr class="my-4">
    <form action="" method="POST">
      <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Titre</label>
            <input type="text" name ="title" class="form-control" id="title" required>
        </div>
        <div class="form-group col-md-6">
          <label for="description">Description</label>
          <input type="text" name ="description" class="form-control" id="description" required>
        </div>
        <div class="form-group col-md-6">
          <label for="linkbooking">Lien booking</label>
          <input type="text" name="linkbooking" class="form-control" id="linkbooking" required>
        </div>
        <div class="form-group col-md-6">
          <label for="price">Prix nuité</label>
          <input type="number" name="fadeprice" class="form-control" id="fadeprice" value="500" disabled>
          <input type="hidden" name="price" class="form-control" id="price" value="500">
        </div>
        <div class="form-group col-md-6">
          <label for="id">Hotel</label>
          <?php
            echo "<input type='hidden' name ='Hotel' class='form-control' id='Hotel'  value='" . $hotel->getId() . "'>";
            echo "<input type='text' name ='fadehotel' class='form-control' id='fadehotel'  value='" . $hotel->getName() . "' disabled>";
          ?>
        </div>
        <div class="form-group col-md-6">
            <label for="featured">Image par défaut de la suite</label>
            <input type="text" name ="featured" class="form-control" id="featured" placeholder="Valider la création, vous pourrez ensuite choisir une image" disabled>
        </div>
        
      </div>
      <button type="submit" class="btn btn-primary" id="btnValid">Valider</button>
    </form>
  </div>
