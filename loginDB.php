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

?>