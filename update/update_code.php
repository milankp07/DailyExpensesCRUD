<?php 
    session_start();


    if(!isset($_SESSION["user"])){
        header("Location:../login/");
    }


    require "../db/database.php";

    if(isset($_POST["update_item"])){
        
         $product_name=$_POST["product_name"];
         $buying_description=$_POST["buying_description"];
         $price=$_POST["price"];
         $purchased_by=$_POST["purchased_by"];
         $date_purchased=$_POST["date_purchased"];
         $remarks=$_POST["remarks"];
         $row_id = $_POST["row_id"];

    try {
            $sql = "UPDATE daily_expenses SET Product_Name=:product_name,Buying_Description=:buying_description,Price=:price,
            Purchased_By=:purchased_by,Date_Purchased=:date_purchased,Remarks=:remarks,Date_Modified=CURRENT_TIMESTAMP WHERE Id=:row_id";

            $stmt=$pdo->prepare($sql);

            $data = [
                ':product_name'=>$product_name,
                ':buying_description'=>$buying_description,
                ':price'=>$price,
                ':purchased_by'=>$purchased_by,
                ':date_purchased'=>$date_purchased,
                ':remarks'=>$remarks,
                ':row_id'=>$row_id
            ];
            
            $stmt->execute($data);

            $_SESSION["update_message"] = "Successfully updated the item. Please check and confirm.";

            header("Location:../home/");


    } catch (PDOException $e) {
        echo $e;
    }
}
?>