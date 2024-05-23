<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="Viewport" content="width= device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style/accountstyle.css">
        <title>Login</title>
    </head>
    <body>
        <div class="container">
           <div class="box form-box">
          <?php
          include("php/config.php");
          if(isset($_POST['submit'])){
            $email = mysqli_real_escape_string($con,$_POST['email']);
            $password = mysqli_real_escape_string($con,$_POST['password']);

            $result = mysqli_query($con,"SELECT * FROM info WHERE Email = '$email' AND Password = '$password'");
            $row = mysqli_fetch_assoc($result);
            if(is_array($row) && !empty($row))
            {
                $_SESSION['valid'] = $row['Email'];
                $_SESSION['username'] = $row['Username'];
                $_SESSION['age'] = $row['Age'];
                $_SESSION['id'] = $row['Id'];
            }
               else
                {
                    echo "<div class='message'>
            <p>Wrong Username or Password</p>
        </div> <br>";
        echo "<a href='Login.php'><button calss = 'btn'>Go Back</button></a>";
                }
                if(isset($_SESSION['valid'])){
                    header("Location: Home.php");
                }
              
          }else{
          ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id = "email"  required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id = "password"  required>
                </div>
                <div class="field">
                    <input type="submit" name="submit" value = "login"  required>
                </div>
                <div class="links">
                    don't have an account? <a href="register.php">Sign-up</a>
                </div>
            </form>
           </div>
           <?php } ?>
        </div>
    </body>
</html>