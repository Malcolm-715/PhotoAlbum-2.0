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
                                $conn = mysqli_connect('localhost', 'root','');
                                mysqli_select_db($conn, 'album_photo');
                                $id = $_GET['id'];
                                $query = "select * from register where user_id = '$id'";
                                $query_run = mysqli_query($conn, $query);

                                if(mysqli_num_rows($query_run) > 0){
                                    foreach($query_run as $row){
                                        ?>
                                        <form action="loginDB.php" method="post" enctype="multipart/form-data">
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
                                            <div class="form-group">
                                                <button type="submit" name="btn-submit" class="btn btn-primary">UPDATE</button>
                                            </div>
                                        </form>   
                                        <?php
                                        }
                                }else{
                                    echo "No Record Available!";
                                }
                            ?>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    
  </body>
</html>