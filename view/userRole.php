<?php
if (!isset($user)){
  die();
}
?>
<div class="jumbotron">
    <h1 class="display-4">Modification du rôle utilisateur !</h1>
    <p class="lead">Seule la donnée rôle est modifiable.</p>
    <hr class="my-4">
    <form action="" method="POST">
        <div class="form-row">
          <div class="form-group col-md-6">
              <label for="name">Nom</label>
                <?php
                    echo "<input type='text' name ='name' class='form-control' id='name'  value='" . $user->getName() ."' disabled>";
                ?>
          </div>
          <div class="form-group col-md-6">
              <label for="name">Prénom</label>
              <?php
                    echo "<input type='text' name ='firstname' class='form-control' id='firstname'  value='" . $user->getFirstname() ."' disabled>";
                ?>
          </div>
          <div class="form-group col-md-6">
            <label for="email">Email</label>
            <?php
                    echo "<input type='text' name ='email' class='form-control' id='email'  value='" . $user->getEmail() ."' disabled>";
                ?>
          </div>
          <div class="form-group col-md-6">
            <label for="email">Rôle actuel</label>
            <?php
                    echo "<input type='text' name ='fadeRole' class='form-control' id='fadeRole'  value='" . $user->getRole() ."' disabled>";
                    echo "<input type='hidden' name ='role' id='role'  value='" . $user->getRole() ."'>";
            ?>
          </div>
          <div class="form-group col-md-6">
            <label for="role">Nouveau Rôle</label>
            <!-- <label class="mr-sm-2 sr-only" for="role">role</label> -->
            <?php
                echo "<select class='custom-select mr-sm-2' id='newRole' name='newRole' required>";
                    echo "<option value='1'>   </option>";
                    echo "<option value='2'>MNG</option>";
                    echo "<option value='3'>ADM</option>";
                echo "</select>";
            ?>
          </div>
        </div>
        <?php
            echo "<input type='hidden' name ='id' id='id' value='" . $user->getId() . "'>";
        ?>
          <button type="submit" class="btn btn-primary" id="btnValid">Modifier</button>
    </form>
    <form action="home.php" method="POST">
        <button type="submit" class="btn btn-primary" id="btnExit">Sortir</button>
    </form>
</div>