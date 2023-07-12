<?php
session_start();
                                require "../db/database.php";

                                if(isset($_POST['change_password'])){
                                    
                                    $username=$_POST['username'];
                                    $old_password=$_POST['old_password'];
                                    $new_password=$_POST['new_password'];
                                    $new_confirm_password=$_POST['new_confirm_password'];
                                    
                                    $sql="SELECT * FROM login_users WHERE username=:username AND password=:password";
                                    
                                        $stmt = $pdo->prepare($sql);
    
                                        $data = [
                                        ":username"=>$username,
                                        ":password"=>md5($old_password)
                                        ];
    
                                        $stmt->execute($data);
    
                                        $result = $stmt->rowCount();
                                        
                                        if($result==1 && $new_password==$new_confirm_password){

                                            $sql="UPDATE login_users SET Password=:password,Modified_At=CURRENT_TIMESTAMP WHERE username=:username";
                                    
                                            $stmt = $pdo->prepare($sql);
    
                                            $data = [
                                            ":username"=>$username,
                                            ":password"=>md5($new_password)
                                            ];
    
                                            $stmt->execute($data);

                                            $_SESSION["successful_message"]="Password modified successfully. Please check.";
                                            header("Location:../change_password/");
                                        }

                                        elseif($result==0 && $new_password==$new_confirm_password) {
                                
                                            $_SESSION["password_message"] = "Username or password is incorrect. Try again.";
                                            header("Location:../change_password/");

                                        }

                                        elseif($result==1 && $new_password!=$new_confirm_password) {
                                    
                                            $_SESSION["password_message"] = "New passwords should match. Try again.";
                                            header("Location:../change_password/");

                                        }

                                        elseif($result==0 && $new_password!=$new_confirm_password) {
                                    
                                            $_SESSION["password_message"] = "Username or password is incorrect and new passwords should match. Try again.";
                                            header("Location:../change_password/");

                                        }

                                }
                            ?>
