<?php

use SelfDevelopmentProjects\Box;
use SelfDevelopmentProjects\User;

require_once('vendor/autoload.php');
require 'functions.php';


echo addNumbers(45, 486);
echo "\n";

$box = new Box(['liner', 'life', 'Bottle']);
$box->takeOne();
print_r($box->startsWith('l'));

echo "\n";
$user = new User(45, 'Salim');
echo $user->tellName();