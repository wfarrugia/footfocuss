<?php

require 'C:\xampp\htdocs\private\autoload.php';

$error = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = $_POST['email'];
    if(!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $email)) {
        $error = "Invalid email format";
    }

    $password = $_POST['password'];

    $arr['password'] = $password;
    $arr['email'] = $email;

    if($error == "") {
        $query = "SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1";
        $stmt = $connection->prepare($query);
        $check = $stmt->execute($arr);
    }

    if($check) {
       
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        if(is_array($data) && count($data>0)) {
            $data = $data[0];
            $_SESSION['url_address'] = $data->url_address;

            header("Location: index.php");
            die;
        }
    }
    else {
        $error = "Something went wrong!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="css/style.css">
        <meta charset="UTF-8">
        <title>Log in</title>
    </head>

    <body>
        <form class="Log in Form" method="post">
            <div>
                <?php
                if($error != "") {
                    echo $error;
                }
                ?>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Enter your email address" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <div>
                <button type="submit">Log in</button>
            </div>
        </form>
    </body>
</html>

            
            
    
    
    
    </body>

</html>

