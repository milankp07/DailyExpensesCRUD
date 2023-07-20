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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
                                    <table class="table table-striped table-responsive" style="width:auto;">
                                                <thead class="table-dark">
                                                    <tr>
                                                    <th scope="col" colspan="4">The last 10 expenses. (On mobile, please scroll down if not completely visible.)</th>
                                                    </tr>
                                                    <tr>
                                                    <th scope="col">Item Name</th>
                                                    <th scope="col">Added By</th>
                                                    <th scope="col">See/Edit/Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            <?php 
                                                        require "../db/database.php";
                                                        
                                                        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
                                                        try {

                                                            $sql = "SELECT Id,Product_Name,Buying_Description,Price,Purchased_By,Date_Purchased,
                                                            Remarks,Created_By,Date_Created,Modified_By,Date_Modified,ROW_NUMBER() OVER (ORDER BY Id DESC) Row_Num 
                                                            FROM daily_expenses WHERE Action_ != 'D'  LIMIT 10";

                                                            $stmt = $pdo->prepare($sql);

                                                            $stmt->execute();
                                                    
                                                            $result = $stmt->fetchAll();

                                                            foreach ($result as $row) {

                                                                ?>
                                                                    <tr>
                                                                    <td><?php echo substr($row["Product_Name"],0,10).".."; ?></td>
                                                                    <td><?php echo substr($row["Created_By"],0,10).".."; ?></td>
                                                                    <td>
                                                                    
                                                                                <i class="bi bi-eye-fill" data-bs-toggle="modal" data-bs-target="<?php echo "#myModal".$row["Id"]; ?>" style="cursor:pointer;">
                                                                                </i>                                                              
            


            <!-- The Modal -->
            <div class="modal" id="<?php echo "myModal".$row["Id"]; ?>">
            <div class="modal-dialog">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Expense Details</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    
                <form action="update_code.php" method="POST">
                                <div class="mb-3">
                                    <label for="product_name" class="form-label">Item Name</label>
                                    <input type="text" name="product_name"  maxlength="100" class="form-control" id="product_name" value="<?php echo $row['Product_Name']; ?>" placeholder="Write item name i.e., toothpaste, gobi etc." readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="buying_description" class="form-label">Spending/Buying Description</label>
                                    <input type="text" name="buying_description" maxlength="100" class="form-control" id="buying_description" value="<?php echo $row['Buying_Description']; ?>" placeholder="Write item spending/buying description i.e., 1kg, 1 bottle etc." readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" name="price" class="form-control" id="price" value="<?php echo $row['Price']; ?>" placeholder="Write price of the item in Rupees." readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="purchased_by" class="form-label">Spent By</label>
                                    <select class="form-select" aria-label="" name="purchased_by" id="purchased_by" disabled>
                                        <option value="">Select Spent By</option>
                                        <option value="<?php echo $row["Purchased_By"]?>" selected><?php echo $row["Purchased_By"]?></option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="date_purchased" class="form-label">Date Spent</label>
                                    <input type="date" name="date_purchased" class="form-control" id="date_purchased" value="<?php echo $row['Date_Purchased']; ?>" placeholder="Choose the date of purchase." readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="remarks" class="form-label">Additional Remarks (Optional)</label>
                                    <input type="text" name="remarks" maxlength="100" class="form-control" id="remarks" value="<?php echo $row['Remarks']; ?>" placeholder="Write any additional remarks if required." readonly>
                                </div>
                
                                </form>                                                      

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

                </div>
            </div>
            </div>

                <a href="../update/?id=<?php echo $row["Id"];?>" class="text-secondary" style="margin-left:25px;"><i class="bi bi-pen"></i></a>
                <a href="../delete/delete_code.php?id=<?php echo $row["Id"];?>" class="text-danger" onclick="return confirm('Are you sure?')" style="margin-left:25px;"><i class="bi bi-trash3-fill"></i></a>


                                                                </td>




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