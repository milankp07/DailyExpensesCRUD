<?php
    ob_start();
    if(isset($_SESSION["user"])){
        header("Location:home/");}
    else{
        header("Location:login/");
    }

?>