<?php
session_start();
                                require "../db/database.php";

                                if(isset($_POST['create_user'])){
                                  
                                  $username=$_POST['username'];
                                  $password=$_POST['password'];
                                  $confirm_password=$_POST['confirm_password'];
                                  
                                  if($password==$confirm_password){
                                  
                                  $sql="INSERT INTO login_users (Username,Password,Created_At) 
                                  VALUES (:username,:password,CURRENT_TIMESTAMP)";
                                
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
                                    $_SESSION["password_message"]="Both passwords should match. Try again.";
                                    header("Location:../signup/");
                                }
                            
                            }
                            ?>
