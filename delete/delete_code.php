<?php 

session_start();

if(!isset($_SESSION["user"])){
            header("Location:../login/");
        }


if(isset($_GET['id'])){
    
    $Id=$_GET['id'];

    require "../db/database.php";

    $sql = "DELETE FROM daily_expenses WHERE id=:id";

    $stmt=$pdo->prepare($sql);

    $data = [
        ':id'=>$Id
    ];

    $stmt->execute($data);

    $_SESSION["add_message"] = "Successfully deleted the item. Please check and confirm.";

    header("Location:../home/");

}

?>