<?php
session_start();
if(isset($_GET['signout'])){
    session_unset();
}
if(!isset($_SESSION['user_id'])){
    header('Location: ./signin.php');
}
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
if(isset($_POST['name']) && isset($_POST['email'])){
    $query = 'UPDATE login SET name=\''.$_POST['name'].'\', email=\''.$_POST['email'].'\' WHERE id='.$_POST['user_id'];
    $result = $conn->query($query);
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
          <div class="col-2" style="float: right;"><a href="./dashboard.php?signout=true">Sign out</a></div>
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
                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?php echo $row['id'] ?>">Edit</a>
                                    <a href="./dashboard.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                                    <form action="./problem5.php" method="post">
                                    <div class="modal fade" id="editModal<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $row['id'] ?>" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel<?php echo $row['id'] ?>">Edit info of <?php echo $row['name'] ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                           <input type="hidden" name="user_id" value="<?php echo $row['id'] ?>">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" class="form-control" value="<?php echo $row['name'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control" value="<?php echo $row['email'] ?>">
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    </form>

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