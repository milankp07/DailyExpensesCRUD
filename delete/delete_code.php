<?php 

session_start();

if(!isset($_SESSION["user"])){
            header("Location:../login/");
        }


if(isset($_GET['id'])){
    
    $Id=$_GET['id'];

    require "../db/database.php";

    $sql = "UPDATE daily_expenses SET Action_=:action_,Date_Modified=CURRENT_TIMESTAMP,Modified_By=:modified_by WHERE id=:id";

    $stmt=$pdo->prepare($sql);

    $data = [
        ':id'=>$Id,
        ':action_'=>'D',
        ':modified_by'=>$_SESSION['user']

    ];

    $stmt->execute($data);

    $_SESSION["add_message"] = "Successfully deleted the item. Please check and confirm.";

    header("Location:../home/");

}

?>