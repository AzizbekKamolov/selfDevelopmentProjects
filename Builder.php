<?php

interface Builder
{
    public function select(array $fields);

    public function where(string $column, string $operator, string $variable);

    public function limit(int $limit, int $offset);

    public function get();
}

function camelCaseToSnakeCase(string $string)
{
    $var = '';
    $first = true;
    foreach (str_split($string) as $item) {
        $ord = ord($item);
        if ($ord < 96) {
            if ($first) {
                $item = chr($ord + 32);
                $first = false;
            } else {
                $item = '_' . chr($ord + 32);
            }
        }
        $var .= $item;
    }
    if (substr($var, -1) == 'y') {
        $var = substr($var, 0, strlen($var) - 2) . 'ie';
    };
    return $var . 's';
}

class QueryBuilder implements Builder
{

    protected $table = 'table';
    protected $query;

    public function __construct()
    {
//         $this->table = camelCaseToSnakeCase(get_class($this));
        $this->query = new stdClass();
    }

    public function select(array $fields = ['*'])
    {
        $this->query->base = 'SELECT ' . implode(', ', $fields) . " FROM $this->table";
        return $this;
    }

    public function where(string $column, string $operator = '=', string $variable = '')
    {
        if (empty($variable)) {
            $variable = $operator;
            $operator = '=';
        }
        if ($this->query->wheres && count($this->query->wheres) > 0) {
            foreach ($this->query->wheres as $item => $where) {
                if (explode(' ', $where)[0] == $column) {
                    if (!is_numeric($variable)) {
                        $this->query->wheres[$item] = "$column $operator '$variable'";
                    } else {
                        $this->query->wheres[$item] = "$column '$operator' $variable";
                    }
                }
            }
        }
        if (!is_numeric($variable)) {
            $this->query->wheres[] = "$column $operator '$variable'";
        } else {
            $this->query->wheres[] = "$column $operator $variable";
        }
        return $this;
    }

    public function get()
    {
        if (!empty($this->query->wheres)) {
            $str = " where " . implode(' AND ', $this->query->wheres);
        }
        if (!empty($this->query->limit)) {
            $str .= " " . $this->query->limit;
        }
        return $this->query->base . " $str";

    }

    public function limit(int $start, int $offset = 0)
    {
        if ($offset == 0) {
            $this->query->limit = "LIMIT $start";
        } elseif($offset > 0 && $start > 0) {
            $this->query->limit = "LIMIT $start OFFSET $offset";
        }
        return $this;
    }
}

class MyCategory extends QueryBuilder
{
    protected $table = 'my_categories';

}

class User extends QueryBuilder
{
    protected $table = 'users';
}

$category = new MyCategory();
$model = new User();
//$a = $model->select()->where('id', 3)
//    ->where('first_name', 'like', '%m%')
//    ->where('last_name', 'like', '%bek')->limit(25, 25)->get();
//
//var_dump($a);





