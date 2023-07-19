<?php 
    session_start();


    if(!isset($_SESSION["user"])){
        header("Location:../login/");
    }


    require "../db/database.php";

    if(isset($_POST["add_new_item"])){
        
         $product_name=$_POST["product_name"];
         $buying_description=$_POST["buying_description"];
         $price=$_POST["price"];
         $purchased_by=$_POST["purchased_by"];
         $date_purchased=$_POST["date_purchased"];
         $remarks=$_POST["remarks"];

    try {
            $sql = "INSERT INTO daily_expenses(Product_Name,Buying_Description,Price,Purchased_By,Date_Purchased,Remarks,Action_,Created_By,Date_Created) VALUES (:product_name,:buying_description,:price,:purchased_by,:date_purchased,:remarks,:action_,:created_by,CURRENT_TIMESTAMP)";
            
            $stmt=$pdo->prepare($sql);

            $data = [
                ':product_name'=>$product_name,
                ':buying_description'=>$buying_description,
                ':price'=>$price,
                ':purchased_by'=>$purchased_by,
                ':date_purchased'=>$date_purchased,
                ':remarks'=>$remarks,
                ':created_by'=>$_SESSION['user'],
                ':action_'=>'N'
            ];
            
            $stmt->execute($data);
            
            $_SESSION["add_message"] = "Successfully added the item. Please check and confirm.";

            header("Location:../home/");


    } catch (PDOException $e) {
        echo $e;
    }

    

}
?>