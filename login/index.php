<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
  <?php 

    if(isset($_SESSION["user"])){
      header("Location:../home/");
    }
  
  ?>
            

    
    <div class="container"> 
    
    <div class="card" style="width: 30rem; height:20rem; margin:100px auto;">
        <h2 class="text-center" style="margin-top:10px;">Daily Expense System Login</h2>

        <div class="card-body">   
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" required>
                                </div>
                                <input type="submit" name="login" value="Login" class="btn btn-primary">
                            </form>

                            <?php
                                require "../db/database.php";

                                if(isset($_POST['login'])){
                                  
                                  $username=$_POST['username'];
                                  $password=$_POST['password'];

                                  $sql="SELECT * FROM login_users WHERE username=:username AND password=:password";
                                
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
