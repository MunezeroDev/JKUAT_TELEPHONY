<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/custom-logins.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="box form-box">
            <?php
            // include("php/config.php");
            include("../CONN/db_conn.php");
            if (isset($_POST['submit'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                $query = mysqli_query($conn, "SELECT * FROM telephoneadmin WHERE email='$email' AND password='$password'");

                if (mysqli_num_rows($query) > 0) {
                    // Login successful
                    echo "<div class='message'>
                            <p>Login successful!</p>
                          </div> <br>";
                    echo "<a href='../Department/index.php'><button class='btn'>Admin Privileges</button></a>";
                } else {
                    // Login failed
                    echo "<div class='message'>
                            <p>Invalid email or password. Please try again.</p>
                          </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
                }
            } else {
            ?>
                <div class="image-container">
                    <img src="img/download.JPEG" alt="" srcset="">
                </div>
                <header>Login</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" autocomplete="off" required>
                    </div>
                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" autocomplete="off" required>
                    </div>
                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Login" required>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</body>

</html>