<?php
require '\xampp\htdocs\Registration\private\autoload.php';

$user_data = check_login($connection);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link type="text/css" rel="stylesheet" href="style.css">
    <title>signup</title>
</head>
<body>
    <div>
        <?php
            if(isset($error) && $error != "")
            {
            echo $error;
            }
        ?>
    </div>
    <div id="header">
<div class="Sign-up-Title">Welcome <?php echo $user_data->email; ?></div>
<div>HI <? =$_SESSION['email']?></div>
<a href="logout.php">Logout</a>
</body>
</html>

