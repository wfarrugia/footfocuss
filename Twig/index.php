<?php

require "vendor/autoload.php";



$loader = new \Twig\Loader\FilesystemLoader('views');
$twig = new \Twig\Environment($loader);

echo $twig ->render('index.html', array(
   'name' => 'John',
   'age' => 76
));

echo $twig->render('loginPage.twig');