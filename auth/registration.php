<?php
require_once("../config/database.php");

//Initialize username and password as empty variables
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Validate Username
    if(empty(trim($_POST["username"]))){
        $username_err =  "Please enter a username";
    }else{
        $usrname = trim($_POST["username"]);
        $sql = "SELECT * FROM users WHERE name = '$usrname' ";
        $check_username = mysqli_query($conn,$sql);
        if(!$check_username){
            $username_err = "Oops something went wrong try again later";
        }else{
            if(mysqli_num_rows($check_username) >= 1){
                $username_err = "The username is already taken";
            }else{
                $username = trim($_POST["username"]);
            }
        }
    }

    // Validate Password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password";
    }elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Password must have at least 8 characters";
    }else{
        $password = trim($_POST["password"]);
    }

    //Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password";
    }else{
        $confirm_password = trim($_POST["confirm_password"]);

        if(empty($confirm_password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Passwords do not match";
        }
    }

    //Check for input errors
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (name, password)
        VALUES ('$param_username', '$param_password')";
        $result = mysqli_query($conn, $query);
        if($result){
            header("location: login.php");
        }else{
            echo mysqli_error($conn);
        }
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>