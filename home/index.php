<?php 
ob_start();
session_start();?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daily Expense Tracker | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body background="../img/background_image.jpg">
    <?php
        if(!isset($_SESSION["user"])){
            header("Location:../login/");
        }
    ?>
    
    <div class="container"> 

    <div class="card" style="margin-top:15px;">
        <h2 class="text-center" style="margin-top:10px;">Daily Expenses Tracker</h2> 
        
        <div class="card-body"> 
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-3">
                        <h4><span class="badge rounded-pill text-bg-light"><?php if(isset($_SESSION["user"])){echo $_SESSION["user"];}?></span>
                        <a href="../logout/" class="btn btn-secondary">Logout</a>
                        </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <?php 
                            require "../db/database.php";
                            
                            $sql="SELECT * FROM daily_expenses";

                            $stmt = $pdo->prepare($sql);

                            $stmt->execute();

                            $result = $stmt->rowCount();

                            if($result>0){
                            ?>
                                    <div style="overflow-x:auto;">
                                    <table class="table table-striped table-responsive" style="width:2000px;">
                                                <thead class="table-dark">
                                                    <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Item Name</th>
                                                    <th scope="col">Spending Description</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Spent By</th>
                                                    <th scope="col">Date Spent</th>
                                                    <th scope="col">Remarks</th>
                                                    <th scope="col">Added By</th>
                                                    <th scope="col">Date Added</th>
                                                    <th scope="col">Modifed By</th>
                                                    <th scope="col">Date Modifed</th>
                                                    <th scope="col">Edit/Delete Record</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            <?php 
                                                        require "../db/database.php";
                                                        
                                                        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
                                                        try {

                                                            $sql = "SELECT Id,Product_Name,Buying_Description,Price,Purchased_By,Date_Purchased,
                                                            Remarks,Created_By,Date_Created,Modified_By,Date_Modified,ROW_NUMBER() OVER (ORDER BY Id DESC) Row_Num 
                                                            FROM daily_expenses LIMIT 10";

                                                            $stmt = $pdo->prepare($sql);

                                                            $stmt->execute();
                                                    
                                                            $result = $stmt->fetchAll();

                                                            foreach ($result as $row) {

                                                                ?>
                                                                    <tr>
                                                                    <th scope="row"><?php echo $row["Row_Num"]; ?></th>
                                                                    <td><?php echo $row["Product_Name"]; ?></td>
                                                                    <td><?php echo $row["Buying_Description"]; ?></td>
                                                                    <td><?php echo $row["Price"]; ?></td>
                                                                    <td><?php echo $row["Purchased_By"]; ?></td>
                                                                    <td><?php echo date("d/m/Y", strtotime($row["Date_Purchased"])); ?></td>
                                                                    <td><?php echo $row["Remarks"]; ?></td>
                                                                    <td><?php echo $row["Created_By"]; ?></td>
                                                                    <td><?php echo date("d/m/Y", strtotime($row["Date_Created"])); ?></td>
                                                                    <td><?php echo $row["Modified_By"]; ?></td>
                                                                    <td><?php if($row["Date_Modified"]!=''){ echo date("d/m/Y", strtotime($row["Date_Modified"])); } ?></td>
                                                                    <td><a href="../update/?id=<?php echo $row["Id"];?>" class="btn btn-primary">Edit</a> <a href="../delete/delete_code.php?id=<?php echo $row["Id"];?>" class="btn btn-primary" onclick="return confirm('Are you sure?')">Delete</a></td>
                                                                    </tr>
                                                <?php
                                                            }       
                                                        } 
                                                        catch (PDOException $e) {
                                                            echo $e->getMessage();
                                                        }

                                                                ?>
                                                </tbody>
                                        </table>
                                        </div>
                        <?php        

                        }
                        else {
                            ?>
                            <h4 class="text-centre">No records found. Please add one by clicking "Add Expense" button.</h4>
                        <?php
                        }

                        ?>
                    
                        
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                            <div class="col-md-4">
                                <a href="../add/" class="btn btn-primary">Add Expense</a>
                                <a href="../report/" class="btn btn-primary">Generate Report</a>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-centre">
                        <?php if(isset($_SESSION["update_message"])){
                                ?>
                                    <div class="alert alert-success" role="alert" style="margin-top:10px;">
                                        <?php echo $_SESSION["update_message"]; ?>
                                    </div>
                        <?php        
                                unset($_SESSION["update_message"]);
                            }
                        elseif(isset($_SESSION["add_message"])){
                        ?>
                        
                        <div class="alert alert-success" role="alert" style="margin-top:10px;">
                                        <?php echo $_SESSION["add_message"]; ?>
                        </div>

                        <?php
                            unset($_SESSION["add_message"]);
                        }
                        elseif(isset($_SESSION["delete_message"])){
                            ?>
                            
                            <div class="alert alert-success" role="alert" style="margin-top:10px;">
                                            <?php echo $_SESSION["delete_message"]; ?>
                            </div>
    
                            <?php
                                unset($_SESSION["delete_message"]);
                            }
                        ?>
                        </div>
                    </div>
                                        </div>
                                        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>