<?php 
ob_start();
session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daily Expense Tracker | Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body background="../img/background_image.jpg">
  <?php 

    if(isset($_SESSION["user"])){
      header("Location:../home/");
    }
  
  ?>
            

    
    <div class="container"> 
    
    <div class="card" style="width:22.5rem; height:18rem; margin:100px auto;">
        <h2 class="text-center" style="margin-top:10px;">Daily Expense Tracker</h2>

        <div class="card-body">   
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="POST" class="form-floating">
                                <div class="form-floating mb-3">
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                                    <label for="username">Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                    <label for="password">Password</label>
                                </div>
                                <input type="submit" name="login" value="Log In" class="btn btn-primary">
                                <a href="../signup/" class="btn btn-primary">Sign Up</a>
                                <a href="../change_password/" class="btn btn-primary">Change Password</a>
                            </form>

                            <?php
                                require "../db/database.php";

                                if(isset($_POST['login'])){
                                  
                                  $username=$_POST['username'];
                                  $password=md5($_POST['password']);

                                  $sql="SELECT * FROM login_users WHERE username=:username AND password=:password AND status='A'";
                                
                                  $stmt = $pdo->prepare($sql);

                                  $data = [
                                    ":username"=>$username,
                                    ":password"=>$password
                                  ];

                                  $stmt->execute($data);

                                  $result = $stmt->rowCount();
                                  
                                  if($result==1){
                                      $_SESSION["user"]=$username;
                                      header("Location:../home/");
                                  }
                                  else {
                                    ?>
                                    <div class="alert alert-danger" role="alert" style="margin-top:50px;">
                                      Username or password is invalid. Try again.
                                    </div>

                                  <?php
                
                                  }
                                  
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
