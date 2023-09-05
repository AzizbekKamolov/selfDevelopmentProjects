<?php
require 'functions.php';
$url = parse_url($_SERVER['REQUEST_URI']);
$path = $url['path'];
$query = $url['query'];
$routes = [
  '/' => 'pages/index.php',
  '/contact' => 'pages/contact.php',
  '/about' => 'pages/about.php',
];
if (array_key_exists($path, $routes)){
    require "pages/{$path}.php";
}else{
    http_response_code(404);
    require "pages/error.php";
}

