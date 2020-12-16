<?php
session_start();
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
$name = isset($_POST['name'])?trim($_POST['name']):null;
$email = isset($_POST['email'])?trim($_POST['email']):null;
$password = isset($_POST['password'])?trim($_POST['password']):null;
$password_confirmation = isset($_POST['password_confirmation'])?trim($_POST['password_confirmation']):null;

if(empty($name)){
    $_SESSION['form_error'][] = 'Name required to register';
}
if(empty($email)){
    $_SESSION['form_error'][] = 'Email required to register';
}
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $_SESSION['form_error'][] = 'Email is not valid.';
}
if(empty($password)){
    $_SESSION['form_error'][] = 'Password required to register';
}
if($password != $password_confirmation){
    $_SESSION['form_error'][] = 'Password and password confirmation did not match.';
}
if(!isset($_SESSION['form_error'])){
    $insert_query = "INSERT INTO login (name, email, password) VALUES ('".$name."', '".$email."', '".$password."')";
    $result = $conn->query($insert_query);
    $success = 'Registration was successfully done. Please login now.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
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
    <form action="./problem11.php" method="post">
        <h1 style="text-align: center;">Register to Continue</h1>
        <?php
        if(isset($POST)){
            foreach($_SESSION['form_error'] as $error){
                echo '<h2 style="text-align: center;">'.$error.'</h2>';
            }
        }
        if(isset($success)){
            echo '<h2 style="text-align: center;">'.$success.'</h2>';
        }
            
        ?>
        <div class="form-group">
            <label class="lebel">Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label class="lebel">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label class="lebel">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="form-group">
            <label class="lebel">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" required>
        </div>
        <div class="form-group">
           <button type="submit">Register</button>
        </div>
    </form>
</body>
</html>
<?php
unset($_SESSION['form_error']);
session_destroy();
            
?>