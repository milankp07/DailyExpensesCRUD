<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body class="bg-secondary">
  <?php 

    if(isset($_SESSION["user"])){
      header("Location:../home/");
    }
  
  ?>
            

    
    <div class="container"> 
    
    <div class="card" style="width: 30rem; height:22.2rem; margin:100px auto;">
        <h2 class="text-center" style="margin-top:10px;">Daily Expense System Sign Up</h2>

        <div class="card-body">   
                    <div class="row">
                        <div class="col-md-12">
                            <form action="signup_code.php" method="POST" class="form-floating">
                                <div class="form-floating mb-3">
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                                    <label for="username">Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                    <label for="password">Password</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password" required>
                                    <label for="confirm_password">Confirm Password</label>
                                </div>
                                <input type="submit" name="create_user" value="Create New User" class="btn btn-primary">
                                <a href="../login" class="btn btn-primary">Log In Page</a>
                            </form>
                            <?php
                              if (isset($_SESSION['password_message'])){ 
                            ?>
                            <div class="alert alert-danger" role="alert" style="margin-top:50px;">
                                      <?php echo $_SESSION['password_message']; unset($_SESSION['password_message']); ?>
                            </div>
                            <?php
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
