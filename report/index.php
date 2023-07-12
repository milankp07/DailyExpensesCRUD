<?php session_start();?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report Generation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body class="bg-secondary">
    <?php
        if(!isset($_SESSION["user"])){
            header("Location:../login/");
        }
    ?>
    
    <div class="container-fluid"> 

    <div class="card" style="margin-top:15px;">
        <h2 class="text-center" style="margin-top:10px;">Daily Expenses Tracking System Report Generation</h2> 
        
        <div class="card-body"> 
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                        <h4><span class="badge rounded-pill text-bg-light"><?php if(isset($_SESSION["user"])){echo $_SESSION["user"];}?></span>
                        <a href="../logout/" class="btn btn-secondary">Logout</a>
                        </h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                            <form class="row g-3" action="" method="POST">
                                <div class="col-auto">
                                    <label for="from_date" class="" style="margin-top:6px;">From Date</label>
                                </div>
                                <div class="col-auto">
                                    <input type="date" class="form-control" name="from_date" id="from_date" placeholder="Enter From Date" required>
                                </div>
                                <div class="col-auto">
                                    <label for="to_date" class="" style="margin-top:6px;">To Date</label>
                                </div>
                                <div class="col-auto">
                                    <input type="date" class="form-control" name="to_date" id="to_date" placeholder="Enter To Date" required>
                                </div>
                                <div class="col-auto">
                                    <input type="submit" name="generate_report" value="Generate" class="btn btn-primary mb-3">
                                </div>
                                <div class="col-auto">
                                    <a id="exporttable" class="btn btn-primary">Export To Excel</a>
                                </div>
                                <div class="col-auto">
                                    <a href="../index.php" class="btn btn-primary">Go Back</a>
                                </div>

                            </form>

                            
                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                        <?php 
                            if(isset($_POST['generate_report'])){

                                $from_date = $_POST['from_date'];
                                $to_date = $_POST['to_date'];
                            ?>
                        
                                    <table id="htmltable" class="table">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Buying Description</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Purchased By</th>
                                                    <th scope="col">Date Purchased</th>
                                                    <th scope="col">Remarks</th>
                                                    <th scope="col">Date Added</th>
                                                    <th scope="col">Date Modifed</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            <?php 
                                                        require "../db/database.php";
                                                        
                                                        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
                                                        try {

                                                            $sql = "SELECT Id,Product_Name,Buying_Description,Price,Purchased_By,Date_Purchased,
                                                            Remarks,Date_Created,Date_Modified,ROW_NUMBER() OVER (ORDER BY Id) Row_Num FROM daily_expenses
                                                            WHERE Date_Created >= '$from_date' AND Date_Created <= '$to_date' ";

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
                                                                    <td><?php echo date("d/m/Y", strtotime($row["Date_Created"])); ?></td>
                                                                    <td><?php if($row["Date_Modified"]!=''){ echo date("d/m/Y", strtotime($row["Date_Modified"])); } ?></td>
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
                        <?php        

                        }
                        else {
                            ?>
                        <?php
                        }

                        ?>
                    
                        
                        </div>
                    </div>            
                                        </div>
                                        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.table2excel.min.js"></script>
    <script src="../js/export.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>