<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Expense</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body class="bg-secondary">
    <?php
        if(!isset($_SESSION["user"])){
            header("Location:../login/");
        }
    ?>
    
    <div class="container"> 
    <div class="card" style="margin-top:15px;">
    <h2 class="text-center" style="margin-top:10px;">Enter New Expense</h2>
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
                    <form action="add_code.php" method="POST">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" name="product_name" maxlength="100" class="form-control" id="product_name" placeholder="Write product name i.e., toothpaste, gobi etc." required>
                    </div>
                    <div class="mb-3">
                        <label for="buying_description" class="form-label">Buying Description</label>
                        <input type="text" name="buying_description" maxlength="100" class="form-control" id="buying_description" placeholder="Write product buying description i.e., 1kg, 1 bottle etc." required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label" required>Price</label>
                        <input type="number" name="price" class="form-control" id="price" placeholder="Write price of the product in Rupees." required>
                    </div>
                    <div class="mb-3">
                        <label for="purchased_by" class="form-label">Purchased By</label>
                        <select class="form-select" aria-label="Default select example" name="purchased_by" id="purchased_by" required>
                            <option value="">Select Purchased By</option>
                            <?php require "../select/purchased_by.php"; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date_purchased" class="form-label">Date Puchased</label>
                        <input type="date" name="date_purchased" class="form-control" max="<?php echo date("d/m/Y"); ?>" id="date_purchased" placeholder="Choose the date of purchase." required>
                    </div>
                    <div class="mb-3">
                        <label for="remarks" class="form-label">Additional Remarks (Optional)</label>
                        <input type="text" name="remarks" maxlength="100" class="form-control" id="remarks" placeholder="Write any additional remarks if required.">
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" name="add_new_item" class="form-control" value="Add" rows="3"> 
                        <a href="../home/" class="btn btn-primary">Go Back</a>
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