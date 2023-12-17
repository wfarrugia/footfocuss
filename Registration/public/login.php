<?php
    require '\xampp\htdocs\Registration\private\autoload.php'; //getting required resources
    $error = "";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {

        $email = $_POST['email'];
        if (!preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/", $email)) //secondary email validation verification from bckend.
        {
            $error = "Please enter a valid email";
        }
        $password = ($_POST['password']);

        $arr['password'] = $password;
        $arr['email'] = $email;

        //prepared statement
        $query = "SELECT * FROM users WHERE email = :email && password = :password limit 1";
        $stm = $connection->prepare($query);
        $check = $stm->execute($arr);

        if($check) {

            $data = $stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($data) && count($data)>0)
            {
                $data = $data[0];
            $_SESSION['url_address'] = $data->$url_address;

            header("location: index.php");
            die;
            }
        }
    }
    $error = "Incorrect email or password";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link type="text/css" rel="stylesheet" href="style.css">
    <title>signup</title>
</head>

<body>
<form class="Log-in-Form" method="post">
    <div>
        <?php
            if(isset($error) && $error != "")
            {
            echo $error;
            }
        ?>
    </div>
    <div class="Sign-up-Title">Login</div>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="submit" name="Login">
</form>
</body>
</html>
