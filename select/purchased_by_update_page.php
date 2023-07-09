<?php 

    if(!isset($_SESSION["user"])){
        header("Location:../login/");
    }

    require "../db/database.php";


    try{

    $sql= "SELECT Value,Display_Name FROM select_options WHERE Type='Purchased_By' Order By Id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $result=$stmt->fetchAll();

    foreach ($result as $row) {
        ?>
        
        <option value="<?php echo $row["Value"]; ?>" <?php if($row["Value"]==$data["Purchased_By"]){echo "selected";}?> > <?php echo $row["Display_Name"];?>  </option>

<?php
    }}
    catch(PDOException $e){
        echo $e->getMessage();
    }

?>