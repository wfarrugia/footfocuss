<?php

session_start();
require '\xampp\htdocs\Registration\private\autoload.php';


if(isset($_SESSION['url_address']))
{
    unset($_SESSION['url_address']);
}

header("location: index.php");
die;
?>