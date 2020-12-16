<?php
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
if(isset($_GET['delete'])){
    $query = "DELETE FROM login WHERE id = '".htmlspecialchars(trim($_GET['delete']))."';";
    $result = $conn->query($query);
}
$query = "SELECT * FROM login";
$result = $conn->query($query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User info</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
   <div class="container">
       <div class="row">
           <div class="col-12">
               <h1 class="text-center">User registration info.</h1>
               <table class="table table-bordered table-striped">
                   <thead>
                       <tr>
                           <th class="text-center">#</th>
                           <th class="text-center">Name</th>
                           <th class="text-center">Email</th>
                           <th class="text-center">Action</th>
                       </tr>
                   </thead>
                   <?php
                        if ($result->num_rows > 0) {
                            ?>
                            <tbody>
                                <?php
                            $i=1;
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr><td>".$i++."</td><td>".$row['name']."</td><td>".$row['email']."</td>";
                                ?>
                                <td>
                                    <a href="./problem4.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                                </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <?php
                        }
                   
                   ?>
               </table>
           </div>
       </div>
   </div>
   
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
</body>
</html>