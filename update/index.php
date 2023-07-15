<?php 
ob_start();
session_start();?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daily Expense Tracker | Update Expense</title>
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
    <h2 class="text-center" style="margin-top:10px;">Modify Expense</h2>
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

                            if(isset($_GET['id'])){
                                $Id = $_GET['id'];
                            }

                            $sql = "SELECT * FROM daily_expenses WHERE Id=$Id";

                            $stmt = $pdo->prepare($sql);

                            $stmt->execute();

                            $data = $stmt->fetch();
                            //var_dump($data);
                    ?>
                    <form action="update_code.php" method="POST">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Item Name</label>
                        <input type="text" name="product_name"  maxlength="100" class="form-control" id="product_name" value="<?php echo $data['Product_Name']; ?>" placeholder="Write item name i.e., toothpaste, gobi etc." required>
                    </div>
                    <div class="mb-3">
                        <label for="buying_description" class="form-label">Spending/Buying Description</label>
                        <input type="text" name="buying_description" maxlength="100" class="form-control" id="buying_description" value="<?php echo $data['Buying_Description']; ?>" placeholder="Write item spending/buying description i.e., 1kg, 1 bottle etc." required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label" required>Price</label>
                        <input type="number" name="price" class="form-control" id="price" value="<?php echo $data['Price']; ?>" placeholder="Write price of the item in Rupees." required>
                    </div>
                    <div class="mb-3">
                        <label for="purchased_by" class="form-label">Spent By</label>
                        <select class="form-select" aria-label="" name="purchased_by" id="purchased_by" required>
                            <option value="">Select Spent By</option>
                            <?php ob_start(); require "../select/purchased_by_update_page.php"; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date_purchased" class="form-label">Date Spent</label>
                        <input type="date" name="date_purchased" class="form-control" id="date_purchased" value="<?php echo $data['Date_Purchased']; ?>" placeholder="Choose the date of purchase." required>
                    </div>
                    <div class="mb-3">
                        <label for="remarks" class="form-label">Additional Remarks (Optional)</label>
                        <input type="text" name="remarks" maxlength="100" class="form-control" id="remarks" value="<?php echo $data['Remarks']; ?>" placeholder="Write any additional remarks if required.">
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="row_id" value="<?php echo $data["Id"]; ?>" maxlength="100" class="form-control" id="row_id" >
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" name="update_item" class="form-control" value="Update" rows="3" onclick='return confirm("Do you want to make changes?")'> 
                        <a href="../index.php" class="btn btn-primary">Back</a>
                    </div>
                    </form>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-4">

                    </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>