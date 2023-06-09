<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/custom.css">
    <title>Register</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">

            <?php 
            
            // include("php/config.php");
            include("../CONN/db_conn.php");
            if(isset($_POST['submit'])){
                $email= $_POST['email'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $secretWord = $_POST['secretWord'];

            //verifying the unique email
            $verify_query = mysqli_query($conn,"SELECT email FROM telephoneadmin WHERE email='$email'");

            if(mysqli_num_rows($verify_query) !=0 ){
                echo "<div class='message'>
                        <p>This email is used, Try another One Please!</p>
                    </div> <br>";
                echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
            }
            else{

                mysqli_query($conn,"INSERT INTO telephoneadmin(email,username,password,secretWord) VALUES('$email','$username','$password', '$secretWord')") or die("Erroe Occured");

                echo "<div class='message'>
                        <p>Registration successfully!</p>
                    </div> <br>";
                echo "<a href='login.php'><button class='btn'>Login Now</button>";
            

            }

            }else{
            
            ?>
           
            <div class="image-container">
                <img src="img/download.JPEG" alt="" srcset="">
            </div>

            <header>Register</header>
            
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="secretWord">Secretword</label>
                    <input type="text" name="secretWord" id="secretWord" autocomplete="off" required>
                </div>

                <div class="field">

                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="login.php">Login In</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>