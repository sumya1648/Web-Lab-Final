<?php
//TODO: Login using session
//start session
session_start();
//get user's provided username and password
$email = trim(htmlspecialchars($_POST['email']));
$password = trim(htmlspecialchars($_POST['password']));

if(empty($email)){
    $_SESSION['form_error'][] = 'Email required to login';
}
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $_SESSION['form_error'][] = 'Email is not valid.';
}
if(empty($password)){
    $_SESSION['form_error'][] = 'Password required to login';
}
if (isset($_SESSION['form_error'])){
    if (count($_SESSION['form_error'])<=0) {
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
        $sql = 'SELECT * FROM `users` WHERE `email` = \''.$email.'\'';
        $result = $conn->query($sql);
        $cred = $result->fetch_assoc();
        if($password==$cred['password']){
            $_SESSION['user_id'] = $cred['id'];
            $_SESSION['username'] = $cred['username'];
            //TODO: echo success or redirect to home page as login is not successful
            echo 'You are successfully logged in.';
        } else {
            //set error message
            $_SESSION['login_error'] = 'Credentials do not satisfy our records.';
            //TODO:echo message or redirect to login or index page as no user has found
            echo 'Invalid credentials';
        }

    } else {
        //TODO: Echo error or send back to login page
        echo 'Please provide valid credentials.';
        exit();
    }
}

