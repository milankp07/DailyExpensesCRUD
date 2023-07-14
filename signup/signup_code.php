<?php
session_start();
                                require "../db/database.php";

                                if(isset($_POST['create_user'])){
                                  
                                  $username=$_POST['username'];
                                  $password=$_POST['password'];
                                  $confirm_password=$_POST['confirm_password'];
                                  
                                  if($password==$confirm_password){
                                  
                                  #Check user exists.
                                  $sql_check="SELECT * FROM login_users WHERE Username=:username_check";

                                  $stmt_check=$pdo->prepare($sql_check);

                                  $data_check=[':username_check'=>$username];

                                  $stmt_check->execute($data_check);

                                  $row_count = $stmt_check->rowCount();
                                  
                                  if($row_count!=1)
                                  {

                                      $sql="INSERT INTO login_users (Username,Password,Status,Created_At) 
                                      VALUES (:username,:password,'A',CURRENT_TIMESTAMP)";
                                    
                                      $stmt = $pdo->prepare($sql);

                                      $data = [
                                        ":username"=>$username,
                                        ":password"=>md5($password)
                                      ];

                                      $stmt->execute($data);

                                      $_SESSION["user"] = $username;
                                      header("Location:../");
                                    }


                                  else {

                                    $_SESSION["password_message"]="Username already exists. Try again with a different username.";
                                    header("Location:../signup/");

                                  }

                                }
                                else {
                                    $_SESSION["password_message"]="Both passwords should match. Try again.";
                                    header("Location:../signup/");
                                }
                            
                            }
                            ?>
