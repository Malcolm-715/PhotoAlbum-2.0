<?php
echo $id = $_GET['id'];
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="login.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Edit Page</title>
  </head>
  <body>
      <div class="container mt-4">
          <div class="row">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-header bg-warning">
                          <h4>EDIT Images & Data</h4>
                      </div>
                      <div class="card-body">
                            <?php
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
                                // $conn = mysqli_connect('localhost', 'root','');
                                // mysqli_select_db($conn, 'album_photo');
                                $id = $_GET['id'];
                                $query = "select * from register where user_id = '$id'";
                                $query_run = mysqli_query($conn, $query);

                                if(mysqli_num_rows($query_run) > 0){
                                    foreach($query_run as $row){
                                        ?>
                                            <form action="edit.php" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="">Full Name</label>
                                                    <input type="text" name="user_name" value="<?php echo $row['user_name']?>" class="form-control" placeholder="Enter Name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="text" name="user_email" value="<?php echo $row['user_email']?>" class="form-control" placeholder="Email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Password</label>
                                                    <input type="password" name="user_password" value="<?php echo $row['user_password']?>" class="form-control" placeholder="Password" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Image</label>
                                                    <input type="file" name="user_image" class="form-control" required>
                                                    <input type="hidden" name="user_image_old" value="<?php echo $row['user_image']?>"">
                                                </div>
                                                <img src="<?php echo "uploads/".$row['user_image'];?>" width="100px">
                                                <div class="form-group">
                                                    <button type="submit" name="update_user_image" class="btn btn-primary">UPDATE</button>
                                                </div>
                                            </form>   
                                        <?php
                                        }
                                }else{
                                    echo "No Record Available!";
                                }
                            ?>
                      </div>
                      <a href="index.php" class="btn btn-warning">BACK</a> 
                  </div>
              </div>
          </div>
      </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    
  </body>
</html>