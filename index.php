<?php

include('Builder.php');

class Student extends QueryBuilder
{
    protected $table = 'students';
}

$student = new Student();

$data = $student->select([
    'id',
    'first_name',
    'last_name',
    'middle_name',
    'created_at',
    'deleted_at'
])->where('id', '>=', 3)->limit(10,5)->get();
echo($data);