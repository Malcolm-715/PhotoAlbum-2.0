<?php
session_start();
$conn = mysqli_connect('localhost', 'root','');
mysqli_select_db($conn,'album_photo');
if(!$conn){
    echo "Connection failed!";
    exit();
}else{
    if(isset($_POST['btn-submit'])){
        $name = $_POST['user_name'];
        $email = $_POST['user_email'];
        $password = $_POST['user_password'];
        $image = $_FILES['user_image']['name'];

        $allowed_extension = array('jpg','jpeg','png','gif');
        $filename = $_FILES["user_image"]["name"];
        $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
        if(!in_array($file_extension, $allowed_extension)){
            $_SESSION['status'] = "ONLY jpg,jpeg,png,gif Files Allowed!";
            header('Location: login.php');
        }else{
            if(file_exists("uploads/".$_FILES["user_image"]["name"])){
                $filename = $_FILES["user_image"]["name"];
                $_SESSION['status'] = "Image Already Exists! ".$filename;
                header('Location: login.php');
            }else{
                $query = "INSERT INTO register(user_name, user_email, user_password, user_image) VALUES('$name',' $email',' $password',' $image')";
                $query_run = mysqli_query($conn, $query);
                
                if($query_run){
                    move_uploaded_file($_FILES["user_image"]["tmp_name"], "uploads/".$_FILES["user_image"]["name"]);
                    $_SESSION['status'] = "Image Successfully Uploaded!";
                    header('Location: login.php');
                }else{
                    $_SESSION['status'] = "Image Not Uploaded!";
                    header('Location: login.php');
                }
            }
        }
    }
}

?>