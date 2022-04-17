<?php
require_once 'sessionManager.php';
require_once '../model/User.php';

if (!isset($_SESSION['connection'])){
  header('Location: '. 'userConnect.php');
}

if ($_SESSION['connection'] === true && $_SESSION['role'] === 'ADM'){
    
    // Select all users according POST crtieria 
    if (isset($_POST['from']) && $_POST['from'] === 'userSelection.php'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        // check if %  used
        if(stristr($_POST['name'], '%') === FALSE) {
            $name = "'%" . $_POST['name'] . "%'";
        }
        if(stristr($_POST['email'], '%') === FALSE) {
            $email = "'%" . $_POST['email'] . "%'";
        }
        if ($_POST['name'] === '' && $_POST['email'] === ''){
            $sql = 'SELECT * FROM users';
        }else{
            if ($_POST['name'] != '' && $_POST['email'] !=''){
                $sql = 'SELECT * FROM users WHERE name LIKE ' . $name  . ' OR email LIKE ' . $email;
            }else{
                if ($_POST['name'] === '' && $_POST['email'] !=''){
                    $sql = 'SELECT * FROM users WHERE email LIKE ' . $email;
                }else{
                    if ($_POST['name'] != '' && $_POST['email'] ===''){
                    }
                    $sql = 'SELECT * FROM users WHERE name LIKE ' . $name;
                }
            }
        }
    }
    $user = new User();
    $response =  $user->findCriteria($pdo, $sql); 
    if(isset($response) && !is_array($response)){
        $titre = 'Problème d\'accès à la liste.';
        $next = 'home.php';
        displayMessage($titre, $response, $next);
        die();
    }
    displayUsers ($response);

}
require_once '../html/footer.html';

function displayUsers ($response){
  static $lineCount = 0;
    $lignCss = '';
    $cssLine = '';
      foreach ($response as $user) {
              
        echo "<div class='row align-items-center'>";
            
            echo "<div class='col col-md-2 text-center align-middle'>";  
                echo "<div class='d-none d-sm-block' id='Ref-" .$lineCount . "'".">". $user['name']."</div>";
            echo "</div>";
            echo "<div class='col col-md-2 text-center align-middle'>";  
                echo "<div class='d-none d-sm-block' id='Sta-" .$lineCount . "'".">". $user['firstname']."</div>";
            echo "</div>";
            echo "<div class='col col-md-2 text-center align-middle'>";   
                echo "<div class='' id='Pri-" .$lineCount . "'".">". $user['email']."</div>";
            echo "</div>";
            echo "<div class='col col-md-2 text-center align-middle'>";   
                echo "<div class='' id='Pri-" .$lineCount . "'".">". $user['role']."</div>";
            echo "</div>";
            echo "<div class='col col-md-2 text-center align-middle'>";   
                echo "<form action='userRole.php' method='POST'>";
                  echo "<input type='hidden' name ='id' id='id' value=" . $user['id'] . ">";
                  echo "<input type='hidden' name ='from' id='from' value='userList.php'>";
                  echo "<button type='submit' class='btn btn-primary'>...</button>";
                echo "</form>";
            echo "</div>";
        echo "</div>";
      $lineCount++;
      }
}