<?php
    require '\xampp\htdocs\Registration\private\autoload.php'; //getting required resources
    $error = "";
    $email = "";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {

        $email = $_POST['email'];
        if(!preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/", $email)) //secondary email validation verification from bckend.
        {
         $error = "Please enter a valid email";
        }

        $date = date("Y-m-d H:i:s");
        $url_address = get_random_string(60);
        $password = addslashes($_POST['password']); //using esc function to prevent sql injection

        //email check
        $arr = false;
        $arr['email'] =$email;
        $query = "SELECT * FROM users WHERE email = :email limit 1";
        $stm = $connection->prepare($query);
        $check = $stm->execute($arr);

        if($check) {

            $data = $stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($data) && count($data)>0)
            {
                $error = "Email is already taken";
            }
        }

        if($error == ""){

        $arr['url_address'] = $url_address;
        $arr['date'] = $date;
        $arr['password'] = $password;
        $arr['email'] = $email;

        //prepared statement
        $query = "INSERT INTO users(email,password,url_address,date) values (:email,:password,:url_address,:date)";
        $stm = $connection->prepare($query);
        $stm->execute($arr);

        header("location: login.php");
        die;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link type="text/css" rel="stylesheet" href="style.css">
    <title>signup</title>
</head>

<body>
    <form class="Sign-up-Form" method="post">
        <div><?php
            if(isset($error) && $error != ""){
                echo $error;
            }
        ?></div>
        <div class="Sign-up-Title">Signup</div>
        <input type="email" name="email" placeholder="Email" value="<?=$email?>" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" name="signup">
    </form>
</body>
</html>
