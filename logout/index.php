<?php 
    session_start();
    echo $_SESSION["user"];    
    if(isset($_SESSION["user"])){
        session_destroy();
        header("Location:../login/");
    }

?>