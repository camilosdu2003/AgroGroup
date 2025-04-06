
<?php

include('./funciones_session.php');


//login
if (isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo validateLogin($email, $password);
    
}

//logout
if (isset($_POST['logout'])){
   
    logout();
}

?>


?>