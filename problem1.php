<?php
// TODO: insert id, name, age, username and password to a database and show table contents.:
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
$query = "SELECT ID FROM users";
$result = $conn->query($query);

if(empty($result)) {
    $query = "CREATE TABLE users (
              id int(11) AUTO_INCREMENT,
              user_id varchar(191) NOT NULL,
              name varchar(191) NOT NULL,
              username varchar(191) NOT NULL UNIQUE,
              age int(11) NOT NULL,
              password varchar(191) NOT NULL,
              PRIMARY KEY  (ID)
              )";
    if ($conn->query($query) === TRUE) {
        echo "Table users created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

$name = isset($_POST['name'])?$_POST['name']:null;
$username = isset($_POST['username'])?$_POST['username']:null;
$age = isset($_POST['age'])?$_POST['age']:null;
$password = isset($_POST['password'])?$_POST['password']:null;
$user_id = isset($_POST['id'])?$_POST['id']:null;

$insert_query = "INSERT INTO users (user_id, username, name, age, password) VALUES ('".$user_id."', '".$username."', '".$name."', '".$age."', '".$password."')";
$result = $conn->query($insert_query);
if($result){
    echo 'Data entered by user was successfully inserted.';
    $query = "SELECT * FROM users";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["user_id"]. " - Name: " . $row["name"]. " - Username: " . $row["username"]." - Age: " .$row["age"] . " - Password: " . $row["password"]. "<br>";
        }
    }
} else {
    die('Data could not be inserted');
}

?>
