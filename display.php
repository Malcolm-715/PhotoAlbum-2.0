<?php 
include('loginDB.php');
;?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="display.css">
    <title>Display</title>
</head>
<body>
    <a href="index.php">BACK</a>
    <?php
        $sql = "select user_image from register";
        $res = mysqli_query($conn, $sql);

        if(mysqli_num_rows($res) > 0){
            while($image = mysqli_fetch_assoc($res)){ ?>
                <div class="alb">
                    <img src="<?php echo "uploads/".$row['user_image']?>">
                </div>
    <?php } }?>
</body>    
</html>