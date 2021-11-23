<?php 
//Get Heroku ClearDB connection information
$cleardb_url = 'mysql://bdf84a0fd9249c:d392f6cf@eu-cdbr-west-01.cleardb.com/heroku_f2ccda8ea4368a8';
$cleardb_server = 'eu-cdbr-west-01.cleardb.co';
$cleardb_username = 'bdf84a0fd9249c';
$cleardb_password = 'd392f6cf';
$cleardb_db = 'heroku_f2ccda8ea4368a8';
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password);
mysqli_select_db($conn,$cleardb_db); 
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Home Page</title>
  </head>
  <body>
      <div class="container mt-5">
          <div class="row">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-header bg-info">
                            <h4 class="text-white">DISPLAY IMAGES</h4>
                      </div>
                      <div class="card-body">
                            <?php
                                if(isset($_SESSION['status']) && $_SESSION != ''){
                                    ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>YO!</strong> <?php echo $_SESSION['status'];?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php
                                    unset($_SESSION['status']);
                                }
                            ?>
                            <?php
                                $conn = mysqli_connect('localhost', 'root','');
                                mysqli_select_db($conn, 'album_photo');
                                $query = "select user_id, user_name, user_email, user_image from register ";
                                $query_run = mysqli_query($conn, $query);

                            ?>
                          <table class="table">
                              <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>USER NAME</th>
                                        <th>IMAGE</th>
                                        <th>EMAIL</th>
                                        <th>EDIT</th>
                                        <th>DELETE</th>
                                    </tr>        
                              </thead>
                              <tbody>
                                    <?php
                                        if(mysqli_num_rows($query_run) > 0){
                                            foreach($query_run as $row){
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['user_id'];?></td>
                                                        <td><?php echo $row['user_name'];?></td>
                                                        <td>
                                                            <img src="<?php echo "uploads/".$row['user_image'];?>" width="430px" alt="Image">
                                                        </td>
                                                        <td><?php echo $row['user_email'];?></td>
                                                        
                                                        <td>
                                                            <a href="edit.php?id=<?php echo $row['user_id'];?>" class="btn btn-info">EDIT</a>
                                                        </td>
                                                        <td>
                                                            <!-- <a href="" class="btn btn-danger">DELETE</a> -->
                                                            <form action="index.php" method="POST">
                                                                <input type="hidden" name="delete_id" value="<?php echo $row['user_id'];?>">
                                                                <input type="hidden" name="delete_image" value="<?php echo $row['user_image'];?>">
                                                                <button type="submit" name="delete_user_image" class="btn btn-danger">DELETE</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                        }else{
                                            ?>
                                                <tr>
                                                    <td>No Record Available</td>
                                                </tr>
                                            <?php
                                        }
                                    ?>                                  
                              </tbody>
                          </table> 
                          <a href="display.php" class="btn btn-warning">GALLERY</a> 
                      </div>
                  </div>
              </div>

          </div>
      </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    
  </body>
</html>