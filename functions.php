<?php

function addNumbers(int $num1, int $num2) {
    return $num1 + $num2;
}

function returnCars(): array {
    return ['bentley', 'audi'];
}
function dd(...$data){
   echo  "<pre>";
   var_dump($data);
   echo  "</pre>";
   die();
}