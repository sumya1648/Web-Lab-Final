<?php
//TODO: Login using session
//start session
session_start();
//get user's provided username and password
$email = isset($_POST['email'])?trim(htmlspecialchars($_POST['email'])):'';
$password = isset($_POST['password'])?trim(htmlspecialchars($_POST['password'])):'';

if(empty($email)){
    $_SESSION['form_error'][] = 'Email required to login';
}
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $_SESSION['form_error'][] = 'Email is not valid.';
}
if(empty($password)){
    $_SESSION['form_error'][] = 'Password required to login';
}
if(isset($_POST['email'])){
    if (!isset($_SESSION['form_error'])){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "student";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //build query for getting user information from the credentials provided
        $sql = 'SELECT * FROM `login` WHERE `email` = \''.$email.'\'';
        $result = $conn->query($sql);
        $cred = $result->fetch_assoc();
        if($_POST['password']==$cred['password']){
            $_SESSION['user_id'] = $cred['id'];
            $_SESSION['username'] = $cred['name'];
            //TODO: echo success or redirect to home page as login is not successful
            header('Location: ./dashboard.php');
            exit;
        } else {
            //set error message
            $_SESSION['login_error'] = 'Credentials do not satisfy our records.';
            //TODO:echo message or redirect to login or index page as no user has found
            $login_error = 'Credentials do not satisfy our records.';
        }

    } else {
        //TODO: Echo error or send back to login page
        $login_error = 'Please provide valid credentials.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In Form</title>
    <style>
        .form-group{
            width: 500px;
            margin: 0 auto;
        }
        .lebel{
            display: block;
            width: 100%;
        }
        .form-control{
            height: 25px;
            width: 500px;
            margin-top: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <form action="./signin.php" method="post">
        <h1 style="text-align: center;">Sign in to Continue</h1>
        <?php
        if(isset($POST)){
            foreach($_SESSION['form_error'] as $error){
                echo '<h2 style="text-align: center;">'.$error.'</h2>';
            }
        }
        if(isset($login_error)){
            echo '<h2 style="text-align: center;">'.$login_error.'</h2>';
        }
            
        ?>
    
        <div class="form-group">
            <label class="lebel">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label class="lebel">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
    
        <div class="form-group">
           <button type="submit">Sign in</button>
        </div>
    </form>
</body>
</html>
<?php
unset($_SESSION['form_error']);
session_destroy();
?>
